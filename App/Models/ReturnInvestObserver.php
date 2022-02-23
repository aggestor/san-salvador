<?php

namespace Root\App\Models;

use DateTime;
use Generator;
use React\EventLoop\Loop;
use Root\App\Models\Objects\ReturnInvest;
use Root\App\Models\Objects\User;
use Root\Core\GenerateId;

/**
 * @author Esaie MUHASA
 * ------------------------------------------
 * Surveille l'heure et envoie le bonus de chaque User chaque 18h.
 * Cette classe est loin d'etre pafaite.
 * ==============
 * Pour s'assurer que l'instance de cette classe est inique, peut importe le context d'execution de PHP,
 * nous creeons un petit fichier tmp lors de l'instatiation, et lors de la destruction on le supprime
 * Ainsi dans la methode isRunning on verifie uniquement si ce petit fichier tmp exist
 */
class ReturnInvestObserver {
    const HOURE = 60 * 60 * 2;//60 secondes * 60  * 2 = 2 heure
    const LOGG_PREFIX_FILE_NAME = __DIR__.DIRECTORY_SEPARATOR."logg".DIRECTORY_SEPARATOR;
    const SIGLE_INSTANCE_TMP_FILE = self::LOGG_PREFIX_FILE_NAME.'running-bonus.txt';
    /**
     * Le dernier heure a laquel le bonus a ete envoyer
     * @var \DateTime
     */
    private $lastTime;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var ReturnInvestModel
     */
    private $returnInvestModel;

    /**
     * @var ReturnInvestObserver
     */
    private static $instance;

    /**
     * lors de l'instatiation on cree un petit fichier pour eviter d'avoir deux intance different 
     * de l'observateur des bonus journaliere.
     */
    private function __construct()
    {
        $this->userModel = ModelFactory::getInstance()->getModel("User");
        $this->returnInvestModel = ModelFactory::getInstance()->getModel("ReturnInvest");

        if (!is_dir(self::LOGG_PREFIX_FILE_NAME)) {//si le dossier n'existe pas on le cree
            @mkdir(self::LOGG_PREFIX_FILE_NAME, 0777, true);
        }

        $file = @fopen(self::SIGLE_INSTANCE_TMP_FILE, 'w');
        $now = new \DateTime();
        fwrite($file, "Started at {$now->format('d-m-Y H:i:s')}");
        fclose($file);
    }

    //lors de la destruction de l'instance
    //le prombe qui s pose est que si php s'arrete prusquement, le destructeur est dans la bar de touche 
    //et donc le fichier reste sur le serveur, et il devien compriquer de redemarer l'observateur de bonus
    public function __destruct()
    {
        if(file_exists(self::SIGLE_INSTANCE_TMP_FILE)) {//suppression du petit fichier
            @unlink(self::SIGLE_INSTANCE_TMP_FILE);
        }
    }

    /**
     * permet de verifier si le distributeur des bonus journliere est deja demarrer
     * @return boolean
     */
    public static function isRunning () : bool {
        if(file_exists(self::SIGLE_INSTANCE_TMP_FILE)) {
            return true;
        }
        return static::$instance != null;
    }

    /**
     * Pour demarrer le distributeur des bonus
     * l'evennement sera lancer chaque une heure
     */
    public static function run () : void {

        if(static::isRunning()) {
            return;
        }

        $instance = new self();
        static::$instance = $instance;

        $loop = Loop::get();
        $period = self::HOURE;

        $loop->addPeriodicTimer($period, function () use (&$instance){//on passe la reference de l'instance du distributeur de
            $now  = new DateTime();
            $day = intval($now->format('w'), 10);

            if(intval($now->format('H'), 10) >= 18  && $instance->hasLastTime() && $instance->getLastTime()->format('w') != $now->format('w') && $day != 0 && $day != 6) {
                //s'il fait deja 18 heure,
                //le jour est different du dimenche et du samedi
                //pour le jour actuel, n'ou n'avont pas encore envoyer le bonus
                //Dans la sequance de generation de bonus, on essais de sauvegarder certains informations dans un fichier XML car des exceptions peuvent survenir dans la sequance
                //et logg peut etre utile pour en savoir plus
                $instance->lastTime = $now;

                $filename = self::LOGG_PREFIX_FILE_NAME."bonus-{$now->format('d-m-Y-\a\t-H-i-s')}.xml";
                if (!is_dir(self::LOGG_PREFIX_FILE_NAME)) {//si le dossier n'existe pas on le cree
                    @mkdir(self::LOGG_PREFIX_FILE_NAME, 0777, true);
                }

                $file = @fopen($filename, 'w');

                $xml = new  \XMLWriter();
                $xml->openMemory();
                $xml->startDocument('1.0');
                $xml->startElement('bonus');
                $xml->writeAttribute('date', $now->format('d-m-Y\TH:i:s'));

                try {
                    $count = $instance->userModel->countByLockState();//comptage pour que nous chargons les coptes par goupe de 50
                    $steep = 50;
                    
                    if($count <= $steep) {
                        $instance->dispatch($instance->userModel->findByLockState(), $xml, $now);
                    } else {
                        for ($i=0; $i <= $count; $i += $steep) { //on envoie par block de 50 users
                            $instance->dispatch($instance->userModel->findByLockState(false, $steep, $i), $xml, $now);
                        }
                    }
                } catch (\Exception $e) {
                    $xml->startElement('error');
                    $time = new \DateTime();
                    $xml->writeAttribute('code', $e->getCode());
                    $xml->writeAttribute('className', get_class($e));
                    $xml->writeAttribute('time', $time->format('H:i:s'));
                    $previous = $e->getPrevious()!=null? "{$e->getPrevious()->getMessage()}. CODE: {$e->getPrevious()->getCode()}. LINE: {$e->getPrevious()->getLine()}. FILE: {$e->getPrevious()->getFile()}":"";
                    $xml->text("{$e->getMessage()}. CODE: {$e->getCode()}. LINE: {$e->getLine()}\n Previous: {$previous}");
                    
                    $xml->startElement('stacktrace');
                    $xml->text($e->getTraceAsString());
                    $xml->endElement();

                    $xml->endElement();
                }
                $xml->endElement();
                $xml->endDocument();
                $logg = $xml->outputMemory();

                @fwrite($file, $logg);
                @fclose($file);
            }

        });
    }

    /**
     * Renvoie le dernier instant auquel le bonus a ete envoyer
     * @return \DateTime
     */
    public function getLastTime () : DateTime {
        return $this->lastTime;
    }

    /**
     * Le bonus as-il deja ete envoyer aumoin une fois depuis le lancement de l'oservateur???
     * @return boolean
     */
    public function hasLastTime () : bool {
        return $this->lastTime !== null;
    }

    /**
     * Envoie du bonus journalier aux utilisateurs
     * Le XML n'a rien a avoir avec le bonus en sois.
     * on essais juste des sauvegarder quelques informations de la sequance de generation des bonus
     * @param \XMLWriter $xml
     * @param \DateTime $date la date du jours
     * @param User[] $users
     */
    private function dispatch ($users, \XMLWriter $xml, \DateTime $date) : void {
        $bonus = [];
        foreach ($users as $user) {
            if ($user->getParent() == null) {//pour le compte racine, pas de bonus journalier
                continue;
            }

            $user = $this->userModel->load($user);

            $return = new ReturnInvest();

            $amount = $user->getPack()->getAcurracy() * ($user->getCapital($date) / 100);

            if(($amount+$user->getSold()) >= $user->getMaxBonus()) {
                $surplus = $user->getMaxBonus() - ($amount + $user->getSold());
                $amount = $amount-$surplus;
                $user->setLocked(true);
                $return->setSurplus($surplus);
            }
            $amount = round($amount, 2, PHP_ROUND_HALF_DOWN);//arrondissement par defaut, 2 chiffre apres la virgule

            $return->setAmount($amount);
            $return->setUser($user);
            $return->setRecordDate($this->date);
            $return->setTimeRecord($this->date);
            $bonus[] = $return;

        }
        $this->returnInvestModel->createAll($bonus);

        $xml->startElement('group');
        foreach ($bonus as $bn) {
            $xml->startElement('user');
            $xml->writeAttribute('id', $bn->getUser()->getId());
            $xml->writeAttribute('capital', $bn->getUser()->getCapital($date));
            $xml->writeAttribute('bonusId', $bn->getId());
            $xml->writeAttribute('bonusAmount', $bn->getAmount());
            $xml->writeAttribute('bonusSurplus', $bn->getSurplus());
            $xml->endElement();
        }
        $xml->endElement();
    }
}
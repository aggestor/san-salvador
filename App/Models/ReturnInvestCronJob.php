<?php

namespace Root\App\Models;

use DateTime;
use Root\App\Models\Objects\ReturnInvest;
use Root\App\Models\Objects\User;

/**
 * @author Esaie MUHASA
 * ------------------------------------------
 * Cette classe est l'alternative de la classe ResturnInvestObserver.
 * peut etre executer via le cron job du cpanel, ou quelque chose du genre.
 */
class ReturnInvestCronJob {
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
    }


    /**
     * Pour demarrer le distributeur des bonus
     * l'evennement sera lancer chaque une heure
     */
    public static function run () : void {

        $instance = new self();
        static::$instance = $instance;

        $now  = new DateTime();        
        $instance->lastTime = $now;

        $filename = self::LOGG_PREFIX_FILE_NAME."bonus-{$now->format('d-m-Y-\a\t-H-i-s')}.xml";
        if (!is_dir(self::LOGG_PREFIX_FILE_NAME)) {//si le dossier n'existe pas on le cree
            @mkdir(self::LOGG_PREFIX_FILE_NAME, 0777, true);
        }

        $file = @fopen($filename, 'w');//ouverture du journal

        $xml = new  \XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0');
        $xml->startElement('bonus');
        $xml->writeAttribute('date', $now->format('d-m-Y\TH:i:s'));
        
        try {
            $count = $instance->userModel->countByLockState();//comptage pour que nous chargons les comptes par groupe de 50
            $steep = 50;
            $xml->writeAttribute('count', "{$count}");
            
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
        $xml->startElement('group');

        foreach ($users as $user) {
            $user = $this->userModel->load($user);
            
            if ($user->getParent() == null || !$user->hasPack()) {//pour le compte racine, pas de bonus journalier
                $xml->startElement('skiped');
                $xml->writeAttribute('userId', "{$user->getId()}");
                $xml->endElement();
                continue;
            }


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
            $return->setRecordDate($date);
            $return->setTimeRecord($date);
            $bonus[] = $return;

        }
        $this->returnInvestModel->createAll($bonus);

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
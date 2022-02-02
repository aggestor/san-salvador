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
 */
class ReturnInvestObserver {
    const HOURE = 60 * 60 * 2;//60 secondes * 60  * 2 = 2 heure

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

    private function __construct()
    {
        $this->userModel = ModelFactory::getInstance()->getModel("User");
        $this->returnInvestModel = ModelFactory::getInstance()->getModel("ReturnInvest");
    }

    /**
     * permet de verifier si le distributeur des bonus journliere est deja demarrer
     * @return boolean
     */
    public static function isRunning () : bool {
        return static::$instance != null;
    }

    /**
     * Pour demarrer le distributeur des bonus
     * l'evennement sera lancer chaque une heure
     */
    public static function run () : void {

        if(!static::isRunning()) {
            return;
        }

        $instance = new self();
        static::$instance = $instance;

        Loop::addPeriodicTimer(self::HOURE, function () use (&$instance){//on passe la reference de l'instance du distributeur de
            $now  = new DateTime();
            $day = intval($now->format('w'), 10);

            if(intval($now->format('H'), 10) >= 18  && $instance->hasLastTime() && $instance->getLastTime()->format('w') != $now->format('w') && $day != 0 && $day != 6) {
                //s'il fait deja 18 heure,
                //le jour est different du dimenche et du samedi
                //pour le jour actuel, n'ou n'avont pas encore envoyer le bonus
                $instance->lastTime = $now;

                $count = $instance->userModel->countByLockState();//comptage pour que nous chargons les coptes par goupe de 50
                $steep = 50;

                if($count <= $steep) {
                    $instance->dispatch($instance->userModel->findByLockState());
                } else {
                    for ($i=0; $i <= $count; $i += $steep) { 
                        if ($instance->userModel->checkByLockState(false, $steep, $i)) {
                            $instance->dispatch($instance->userModel->findByLockState());
                        }
                    }
                }
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
     * @param User[] $users
     */
    private function dispatch ($users) : void {
        $bonus = [];
        foreach ($users as $user) {
            $user = $this->userModel->load($user);

            $return = new ReturnInvest();

            $amount = $user->getPack()->getAcurracy() * ($user->getCapital() / 100);

            if(($amount+$user->getSold()) >= $user->getMaxBonus()) {
                $surplus = $user->getMaxBonus() - ($amount + $user->getSold());
                $amount = $amount-$surplus;
                $user->setLocked(true);
                $return->setSurplus($surplus);
            }

            $return->setAmount($amount);
            $return->setUser($user);
            $return->setRecordDate($this->lastTime);
            $return->setTimeRecord($this->lastTime);
            $bonus[] = $return;

        }
        $this->returnInvestModel->createAll($bonus);
    }
}
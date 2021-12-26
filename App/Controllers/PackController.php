<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\PackValidation;
use Root\App\Models\InscriptionModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\PackModel;

class PackController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var PackModel
     */
    private $packModel;

    /**
     * Undocumented variable
     *
     * @var InscriptionModel
     */
    private $inscriptionModel;
    public function __construct()
    {
        $this->packModel = ModelFactory::getInstance()->getModel('Pack');
        $this->inscriptionModel = ModelFactory::getInstance()->getModel('Inscription');
    }

    /**
     * Pour l'ajout du pack dans la base des donnees
     *
     * @return void
     */
    public function addPack()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new PackValidation();
            $pack = $validator->createAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != "") {
                $errors = $validator->getErrors();
                return $this->view("pages.packages.dashboard", "layout_admin", ['pack' => $pack, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            }
        }
        return $this->view('pages.packages.dashboard', 'layout_admin');
    }

    /**
     * L'inscription a un pack
     */
    public function sucribeOnPack()
    {
        if (Controller::sessionExist($_SESSION[self::SESSION_USERS])) {
            $id = $_SESSION[self::SESSION_USERS]->getId();
            if (!$this->inscriptionModel->checkIfExistInActivePack($id)) {
                if ($this->packModel->checkById($_GET['pack'])) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $validator = new PackValidation();
                        $suscribe = $validator->sucribePackAfterValidation();

                        if ($validator->hasError() || $validator->getMessage() != "") {
                            $errors = $validator->getErrors();
                            return $this->view("pages.packages.dashboard", "layout_admin", ['pack' => $suscribe, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                        }
                    }
                    return $this->view('pages.packages.subscribe');
                } else {
                    return $this->view('pages.static.404');
                }
            } else {
                Controller::redirect('/user/dashboard');
            }
        } else {
            Controller::redirect('/login');
        }
    }

    /**
     * upgrade packages
     *
     * @return void
     */
    public function upgradePackages()
    {
        
    }
    /**
     * Affichages de touts les pack
     */
    public function packages()
    {
        $package = $this->packModel->findAll();
        return $this->view('pages.packages.packs', 'layouts', ['pack' => $package]);
    }
}

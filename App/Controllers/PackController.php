<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\PackValidation;
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
    public function __construct()
    {
        $this->packModel = ModelFactory::getInstance()->getModel('Pack');
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
                return $this->view("pages.packages.dashboard", "layout_admin", ['admin' => $pack, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            }
        }
        return $this->view('pages.packages.dashboard', 'layout_admin');
    }

    public function sucribeOnPack()
    {
        
    }
}

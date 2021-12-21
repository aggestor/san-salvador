<?php

namespace Root\App\Controllers;

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

    public function addPack()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
        }
        return $this->view('pages.admin.packs.create', 'layout_admin');
    }
}

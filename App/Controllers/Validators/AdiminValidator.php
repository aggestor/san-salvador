<?php

namespace Root\Controllers\Validators;

use Root\Models\AdminModel;
use Root\Models\ModelFactory;
use RuntimeException;

class AdiminValidator extends AbstractMemberValidator
{
    /**
     * Undocumented variable
     *
     * @var AdminModel
     */
    private $adminModel;


    public function __construct()
    {
        $this->adminModel = ModelFactory::getInstance()->getModel('Admin');
    }

    public function createAfterValidation()
    {
    }

    public function deleteAfterValidation()
    {
    }

    public function updateAfterValidation()
    {
    }
    public function loginProcess()
    {
    }
    public function changeStatusAfterValidation()
    {
    }
}

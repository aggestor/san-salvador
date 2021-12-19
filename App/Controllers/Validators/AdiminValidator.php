<?php

namespace Root\App\Controllers\Validators;

use Root\App\Controllers\Controller;
use Root\App\Models\ModelFactory as ModelsModelFactory;
use Root\App\Models\AdminModel;
use Root\App\Models\ModelException;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Admin;
use RuntimeException;

class AdiminValidator extends AbstractMemberValidator
{
    const FIELD_PASSWORD_CONFIRM = 'confirmPassword';
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
    /**
     * Creation d'un administratreur apres validation
     *
     * @return Admin
     */
    public function createAfterValidation()
    {
        $admin = new Admin();
        $id = Controller::generate(11, "1234567890ABCDEFabcdef");
        $token = Controller::generate(60, "QWERTYUIOPASDFGHJKLZXCVBNMqweryuiopasdfghjklzxcvbnm1234567890");
        $mail = $_POST[self::FIELD_EMAIL];
        $this->processingId($admin, $id, true);
        $this->processingEmail($admin, $mail);
        $this->processingToken($token, $admin);

        if (!$this->hasError()) {
            $admin->setRecordDate(new \DateTime());
            $admin->setRecordTime(new \DateTime());
            //enregistrement du token cfr model
            try {
                $this->adminModel->create($admin);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        return $admin;
    }
    /**
     * Activation du compte admin apres validation
     *
     * @return Admin
     */
    public function activeAccountAfterValidation()
    {
        $admin = new Admin();
        $id = $_GET[self::FIELD_ID];
        $token = $_GET[self::FIELD_TOKEN];
        $password = $_POST[self::FIELD_PASSWORD];
        $password_confirm = $_POST[self::FIELD_PASSWORD_CONFIRM];

        $pass_hash = $this->processingPassword($admin, $password, true, $password_confirm, true);
        $this->processingAccount($token, $id, $admin, true);
        if (!$this->hasError()) {
            try {
                //update password and validation
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }

        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        return $admin;
    }

    public function deleteAfterValidation()
    {
    }

    public function updateAfterValidation()
    {
    }
    /**
     * Connexion de l'adminiistrateur apres validation
     *
     * @return Admin
     */
    public function loginProcess()
    {
        $admin = new Admin();
        $mail = $_POST[self::FIELD_EMAIL];
        $password = $_POST[self::FIELD_PASSWORD];
        if (!$this->hasError()) {
            try {
                $this->processingEmail($admin, $mail, true);
                $this->processingPassword($admin, $password);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec de la connexion" : "Connexion faite avec success";
        return $admin;
    }
    public function changeStatusAfterValidation()
    {
    }
    public function resetPassword()
    {
    }
}

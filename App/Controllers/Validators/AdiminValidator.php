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
    const FIELD_PASSWORD_CONFIRM = 'confirm_password';
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
        $name = $_POST[self::FIELD_NAME];
        $this->processingId($admin, $id, true);
        $this->processingEmail($admin, $mail);
        $this->processingToken($token, $admin);
        $this->processingName($admin, $name);

        if (!$this->hasError()) {
            $admin->setRecordDate(new \DateTime());
            $admin->settimeRecord(new \DateTime());
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
        $admins = $this->adminModel->findById($id);
        $password = $_POST[self::FIELD_PASSWORD];
        $password_confirm = $_POST[self::FIELD_PASSWORD_CONFIRM];

        $pass_hash = $this->processingPassword($admin, $password, true, $password_confirm, true);
        $this->processingAccount($token, $id, $admin);
        if (!$this->hasError()) {
            try {
                $this->adminModel->updatePassword($id, $pass_hash);
                $this->adminModel->updateToken(null, $id);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }

        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        return $admins;
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
        $this->processingEmail($admin, $mail, true);
        $this->processingPassword($admin, $password);
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec de la connexion" : "Connexion faite avec success";
        $admin = !empty($mail) ? $this->adminModel->findByMail($mail) : null;
        return $admin;
    }
    public function changeStatusAfterValidation()
    {
    }
    public function resetPassword()
    {
    }
}

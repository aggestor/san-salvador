<?php

namespace Root\App\Controllers\Validators;

use Root\App\Controllers\Controller;
use Root\App\Models\ModelFactory as ModelsModelFactory;
use Root\App\Models\AdminModel;
use Root\App\Models\ModelException;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Admin;
use Root\Core\GenerateId;
use RuntimeException;

class AdiminValidator extends AbstractMemberValidator
{
    const FIELD_PASSWORD_CONFIRM = 'confirm_password';
    const FIELD_REF_CASHOUT = 'ref';
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
        $id = GenerateId::generate(11, "1234567890ABCDEFabcdef");
        $token = GenerateId::generate(60, "QWERTYUIOPASDFGHJKLZXCVBNMqweryuiopasdfghjklzxcvbnm1234567890");
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
        $admin = !empty($mail) && $this->adminModel->checkByMail($mail) ? $this->adminModel->findByMail($mail) : null;
        return $admin;
    }
    public function changeStatusAfterValidation()
    {
    }

    /**
     * Resend mail
     *
     * @return Admin
     */
    public function resendMail()
    {
        $admin = new Admin();
        $mail = $_POST[self::FIELD_EMAIL];
        $token = GenerateId::generate(60, "AZERTYUIOPQSDFGHJKLWXCVBNMazertyuiopqsdfghjklwxcvbnm1234567890");
        $this->processingToken($token, $admin);
        $this->processingEmail($admin, $mail, true);
        if (!$this->hasError()) {
            $userInSystem = $this->adminModel->findByMail($mail);
            $userInSystem->setToken($token);
            try {
                $this->adminModel->updateToken($admin->getToken(), $userInSystem->getId());
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
            $admin = $userInSystem;
        }
        return $admin;
    }
    /**
     * Reset password on send mail
     *
     * @return Admin
     */
    public function resetPassword()
    {
        $admin = new Admin();
        $mail = $_POST[self::FIELD_EMAIL];
        $token = GenerateId::generate(60, "AZERTYUIOPQSDFGHJKLWXCVBNMazertyuiopqsdfghjklwxcvbnm1234567890");
        $this->processingToken($token, $admin);
        $this->processingEmail($admin, $mail, true);
        if (!$this->hasError()) {
            $adminInSystem = $this->adminModel->findByMail($mail);
            $adminInSystem->setToken($token);
            try {
                $this->adminModel->updateToken($admin->getToken(), $adminInSystem->getId());
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
            $admin = $adminInSystem;
        }
        return $admin;
    }

    /**
     * Reset password apres validation de l'email
     *
     * @return Admin
     */
    public function resetPasswordAfterValidation()
    {
        $admin = new Admin();
        $id = $_GET[self::FIELD_ID];
        $token = $_GET[self::FIELD_TOKEN];
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
        $admins = $this->adminModel->findById($id);
        return $admins;
    }
    /**
     * Fonction pour verifier et retourner la reference avant validation cashout
     *
     * @return mixed
     */
    public function refTransactionValideCashOut()
    {
        $reference = $_POST[self::FIELD_REF_CASHOUT];
        $this->processingRefCashOut($reference);
        if (!$this->hasError()) {
            return $reference;
        }
    }
    /**
     * Validation reference cashout
     *
     * @return void
     */
    protected function validationRefCashOut($reference)
    {
        $this->notNullable($reference);
    }

    /**
     * Traitement reference cashout
     *
     * @return void
     */
    protected function processingRefCashOut($reference)
    {
        try {
            $this->validationRefCashOut($reference);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_REF_CASHOUT, $e->getMessage());
        }
    }
}

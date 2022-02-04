<?php

namespace Root\App\Controllers\Validators;

use Root\App\Models\ModelException;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\User;
use Root\App\Models\UserModel;
use Root\App\Controllers\Controller;
use Root\App\Models\CashOutModel;
use Root\App\Models\Objects\CashOut;
use Root\Core\GenerateId;
use RuntimeException;

class UserValidator extends AbstractMemberValidator
{

    const FIELD_SPONSOR = 'sponsor';
    const FIELD_PARENT = 'parent';
    const FIELD_SIDE = 'side';
    const FIELD_PASSWORD_CONFIRM = 'confirm_password';
    const FIELD_CASHOUT_AMOUNT = 'amount';
    const MONTANT_MIN = 20;
    const FIELD_CODE_PAYS = 'country_code';

    /**
     * Undocumented variable
     *
     * @var UserModel
     */
    private $userModel;

    /**
     * Undocumented variable
     *
     * @var CashOutModel
     */
    private $cashOutModel;

    const FIELD_IMAGE = 'image';

    public function __construct()
    {
        $this->userModel = ModelFactory::getInstance()->getModel('User');
        $this->cashOutModel = ModelFactory::getInstance()->getModel('CashOut');
    }

    /**
     * creation du compte utilisateur apres validation
     * {@inheritDoc}
     * @see \Root\Controllers\Validators\AbstractValidator::createAfterValidation()
     * @return User
     */
    public function createAfterValidation()
    {
        $user = new User();
        $name = $_POST[self::FIELD_NAME];
        $mail = $_POST[self::FIELD_EMAIL];
        $phone = $_POST[self::FIELD_TELEPHONE];
        $password = $_POST[self::FIELD_PASSWORD];
        $password_confirm = $_POST[self::FIELD_PASSWORD_CONFIRM];
        $image = $_FILES[self::FIELD_IMAGE];

        $side = isset($_GET[self::FIELD_SIDE]) ? $_GET[self::FIELD_SIDE] : null;
        $parent = isset($_GET[self::FIELD_PARENT]) ? $_GET[self::FIELD_PARENT] : null;
        $sponsor = isset($_GET[self::FIELD_SPONSOR]) ? $_GET[self::FIELD_SPONSOR] : null;

        $id = GenerateId::generate(11, "1234567890ABCDEFabcdef");
        $token = GenerateId::generate(60, "AZERTYUIOPQSDFGHJKLWXCVBNMazertyuiopqsdfghjklwxcvbnm1234567890");
        $this->processingId($user, $id, true);
        $this->processingEmail($user, $mail);
        $this->processingName($user, $name);
        $this->processingTelephone($user, $phone);
        $this->processingPassword($user, $password, true, $password_confirm);
        $this->processingImage($image, false);
        $this->processingParent($user, $parent);
        $this->processingSponsor($user, $sponsor, $side);
        $this->processingToken($token, $user);
        if (!$this->hasError()) {
            $controller = new Controller();
            if (!empty($image) && isset($image)) {
                $chemin = $controller->addImage(self::FIELD_IMAGE);
                $user->setPhoto($chemin);
            } else {
                $user->setPhoto(null);
            }
            $user->setRecordDate(new \DateTime());
            $user->settimeRecord(new \DateTime());
            try {
                $this->userModel->create($user);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }

        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        $_REQUEST['lastInsert'] = $user;
        return $user;
    }

    public function deleteAfterValidation()
    {
    }

    public function updateAfterValidation()
    {
    }

    /**
     * Renvoie de l'email pour generer un nouveau token
     * @return User
     */
    public function resendMail()
    {
        $user = new User();
        $mail = $_POST[self::FIELD_EMAIL];
        $token = GenerateId::generate(60, "AZERTYUIOPQSDFGHJKLWXCVBNMazertyuiopqsdfghjklwxcvbnm1234567890");
        $this->processingToken($token, $user);
        $this->processingEmail($user, $mail, true);
        if (!$this->hasError()) {
            $userInSystem = $this->userModel->findByMail($mail);
            $userInSystem->setToken($token);
            try {
                $this->userModel->updateToken($user->getToken(), $userInSystem->getId());
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
            $user = $userInSystem;
        }
        return $user;
    }

    /**
     * Ajouter un demande de retrait
     *
     * @return CashOut
     */
    public function cashOutAfterValidation()
    {
        $cashOut = new CashOut();
        $id = GenerateId::generate(11, "1234567890ABCDEFabcdef");
        $amout = $_POST[self::FIELD_CASHOUT_AMOUNT];
        $this->processingId($cashOut, $id, true);
        $this->processingCashOut($cashOut, $amout);

        if (!$this->hasError()) {
            $cashOut->setRecordDate(new \DateTime());
            $cashOut->setTimeRecord(new \DateTime());
            $cashOut->setUser($_SESSION[self::SESSION_USERS]);
            try {
                $this->cashOutModel->create($cashOut);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }

        return $cashOut;
    }
    /**
     * Login de l'utilisateur apres validation
     * {@inheritDoc}
     * @return User
     */
    public function loginProcess()
    {
        $user = new User();
        $mail = $_POST[self::FIELD_EMAIL];
        $password = $_POST[self::FIELD_PASSWORD];

        $this->processingEmail($user, $mail, true, true);
        $this->processingPassword($user, $password);

        $users = !empty($mail) ? $this->userModel->findByMail($mail) : null;
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec de la connexion" : "Connexion faite avec success";
        return $users;
    }

    /**
     * 
     *
     * 
     */
    public function changeStatusAfterValidation()
    {
    }
    /**
     * Activation du compte apres validation
     *
     * @return User
     */
    public function activeAccountAfterValidation()
    {
        $user = new User();
        $id = $_GET[self::FIELD_ID];
        $token = $_GET[self::FIELD_TOKEN];
        $this->processingAccount($token, $id, $user);
        $users = $this->userModel->findById($id);
        if (!$this->hasError()) {
            try {
                $this->userModel->validateAccount($id);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        return $users;
    }
    /**
     * Reinitialisation du compte on send mail
     * @return User
     */
    public function resetPassword()
    {
        $user = new User();
        $mail = $_POST[self::FIELD_EMAIL];
        $token = GenerateId::generate(60, "AZERTYUIOPQSDFGHJKLWXCVBNMazertyuiopqsdfghjklwxcvbnm1234567890");
        $this->processingToken($token, $user);
        $this->processingEmail($user, $mail, true);
        if (!$this->hasError()) {
            $userInSystem = $this->userModel->findByMail($mail);
            $userInSystem->setToken($token);
            try {
                $this->userModel->updateToken($user->getToken(), $userInSystem->getId());
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
            $user = $userInSystem;
        }
        $_REQUEST['lastInsert'] = $user;
        return $user;
    }
    /**
     * Reset password apres validation de l'email
     * @return User
     */
    public function resetPasswordAfterValidation()
    {
        $user = new User();
        $id = $_GET[self::FIELD_ID];
        $token = $_GET[self::FIELD_TOKEN];
        $password = $_POST[self::FIELD_PASSWORD];
        $password_confirm = $_POST[self::FIELD_PASSWORD_CONFIRM];
        $pass_hash = $this->processingPassword($user, $password, true, $password_confirm, true);
        $this->processingAccount($token, $id, $user);
        if (!$this->hasError()) {
            try {
                $this->userModel->updatePassword($id, $pass_hash);
                $this->userModel->updateToken(null, $id);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        $users = $this->userModel->findById($id);
        return $users;
    }

    /**
     * validation du retrait apres validation
     *
     * @param mixed $amount
     * @return void
     */
    protected function validationCashOut($amount)
    {
        $this->notNullable($amount);
        if (!is_numeric($amount)) {
            throw new \RuntimeException("Veuillez entrer les valeurs numeriques");
        }
        if (!preg_match("#^[0-9]*$#", $amount)) {
            throw new \RuntimeException("Veuillez entrer les valeurs numeriques correctes");
        }
        $user = $this->userModel->load($_SESSION[self::SESSION_USERS]);

        if ($user->getSold() < $amount) {
            throw new \RuntimeException("Valeur incorrect, le montant est superieur a votre solde");
        }
        if ($amount < self::MONTANT_MIN) {
            throw new \RuntimeException("Le montant a retirer doit etre au minimum 20$");
        }
    }

    /**
     * Undocumented function
     *
     * @param CashOut $cashOut
     * @param mixed $amount
     * @return void
     */
    protected function processingCashOut(CashOut $cashOut, $amount)
    {
        try {
            $this->validationCashOut($amount);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_CASHOUT_AMOUNT, $e->getMessage());
        }
        $cashOut->setAmount($amount);
    }
    /**
     * Pour la validation du numero de telephone
     * @param string $telephone
     * @return void
     */
    protected function validationTelephone($telephone): void
    {
        $this->notNullable($telephone);
        $codePays = $_POST['country_code'];
        $numTelephone = "+" . $codePays . $telephone;
        if (!preg_match(self::RGX_TELEPHONE, $telephone) && !preg_match(self::RGX_TELEPHONE_RDC, $telephone)) {
            throw new \RuntimeException("Votre numero de telphone est invalide");
        }
        if ($this->userModel->checkByPhone($numTelephone)) {
            throw new \RuntimeException("Ce numero de telephone est deja utlise pour une autre compte");
        }
    }
    /**
     * Traitement du numero de telephone
     *
     * @param User $user
     * @param string $telephone
     * @return void
     */
    protected function processingTelephone(User $user, $telephone): void
    {
        try {
            $codePays = $_POST['country_code'];
            $this->validationTelephone($telephone);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_TELEPHONE, $e->getMessage());
        }
        $numTelephone = "+" . $codePays . $telephone;
        $user->setPhone($numTelephone);
    }
    /**
     * Traitement de l'image
     * @param array $image
     * @param boolean $nullable
     * @return void
     */
    protected function processingImage($image, $nullable = false): void
    {
        try {
            $this->validationImage($image, $nullable);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_IMAGE, $e->getMessage());
        }
    }

    /**
     * Validation Parent
     *
     * @param string $Idparent
     * @return void
     */
    protected function validationParent($Idparent): void
    {
        if (empty($Idparent) || $Idparent == null) {
            $Idparent = $this->userModel->findRoot()->getId();
        }

        if (!$this->userModel->checkById($Idparent)) {
            throw new \RuntimeException("Parent invalide");
        }
    }
    /**
     * Traitement du parent
     *
     * @param User $user
     * @param string $Idparent
     * @return void
     */
    protected function processingParent(User $user, $Idparent): void
    {
        try {
            if ($Idparent === null) {
                // $user->setParent($this->userModel->findRoot()->getId());
                $user->setParent($this->userModel->findRoot());
                return;
            } else {
                $this->validationParent($Idparent);
            }
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_PARENT, $e->getMessage());
        }
        $user->setParent($Idparent);
    }
    /**
     * Validation du sponsor
     *
     * @param string $idSponsor
     * @return void
     */
    protected function validationSponsor($idSponsor): void
    {
        if ($idSponsor != null && !$this->userModel->checkById($idSponsor)) {
            throw new \RuntimeException("Sponsor Invalide");
        }
    }

    protected function processingSponsor(User $user, $idSponsor, $side = null): void
    {
        try {
            if ($idSponsor != null && !empty($idSponsor)) {
                $this->validationSponsor($idSponsor);
            }
            $node = ($idSponsor == null && empty($idSponsor)) ? ($user->hasParentNode() ? $user->getParent() : $this->userModel->findRoot()) : $this->userModel->findById($idSponsor);

            while ($this->userModel->countSides($node->getId()) == 2) {
                $node = $this->userModel->findRightSide($node->getId());
            }
            $user->setSponsor($node);
            $right = $this->userModel->hasRightSide($node->getId());
            $left = $this->userModel->hasLeftSide($node->getId());


            if ((!$right && $side == null) || (!$right && $side == User::FOOT_RIGHT) || ($side == User::FOOT_LEFT && $left && !$right)) {
                $user->setFoot(User::FOOT_RIGHT);
                return;
            }

            if ((!$left && $side == null) || (!$left && $side == User::FOOT_LEFT) || ($side == User::FOOT_RIGHT && $right && !$left)) {
                $user->setFoot(User::FOOT_LEFT);
                return;
            }

            throw new \RuntimeException("Impossible de determinner sur quel pied affecter ton compte");
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_SPONSOR, $e->getMessage());
            $user->setSponsor($idSponsor);
        }
    }
}

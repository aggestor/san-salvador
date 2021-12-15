<?php

namespace Root\App\Controllers\Validators;

use Root\App\Models\ModelException;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\User;
use Root\App\Models\UserModel;
use Root\App\Controllers\Controller;

class UserValidator extends AbstractMemberValidator
{

    const FIELD_SPONSOR = 'sponsor';
    const FIELD_PARENT = 'parent';
    const FIELD_SIDE = 'side';
    const FIELD_PASSWORD_CONFIRM = 'confirmPassword';

    /**
     * Undocumented variable
     *
     * @var UserModel
     */
    private $userModel;

    const FIELD_IMAGE = 'image';

    public function __construct()
    {
        $this->userModel = ModelFactory::getInstance()->getModel('User');
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
        //$image = $_FILES[self::FIELD_IMAGE];

        $side = isset($_GET[self::FIELD_SIDE]) ? $_GET[self::FIELD_SIDE] : null;
        $parent = isset($_GET[self::FIELD_PARENT]) ? $_GET[self::FIELD_PARENT] : null;
        $sponsor = isset($_GET[self::FIELD_SPONSOR]) ? $_GET[self::FIELD_SPONSOR] : null ;

        $id = Controller::generate(11, "1234567890ABCDEFabcdef");
        $this->processingId($user,$id,true);
        $this->processingEmail($user, $mail);
        $this->processingName($user, $name);
        $this->processingTelephone($user, $phone);
        $this->processingPassword($user, $password, true, $password_confirm);
        //$this->processingImage($user, $image);
        $this->processingParent($user, $parent);
        $this->processingSponsor($user, $sponsor, $side);

        if (!$this->hasError()) {
            $user->setRecordDate(new \DateTime());
            $user->setRecordTime(new \DateTime());
            try {
                $this->userModel->create($user);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
                var_dump($e->getMessage());
                exit();
            }
        }

        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec d'inscription" : "succes";
        return $user;
    }

    public function deleteAfterValidation()
    {
    }

    public function updateAfterValidation()
    {
    }
    public function loginProcess()
    {
        $user = new User();
        $mail = $_POST[self::FIELD_NAME];
        $password = $_POST[self::FIELD_PASSWORD];

        $this->processingEmail($user, $mail, true);
        $this->processingPassword($user, $password);
        if (!$this->hasError()) {
            try {
                $this->userModel->create($user);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        $this->caption = ($this->hasError() || $this->getMessage() != null) ? "Echec de la connexion" : "Connexion faite avec success";
    }
    public function changeStatusAfterValidation()
    {
    }

    /**
     * Pour la validation du numero de telephone
     * @param string $telephone
     * @return void
     */
    protected function validationTelephone($telephone): void
    {
        $this->notNullable($telephone);
        if (!preg_match(self::RGX_TELEPHONE, $telephone) && !preg_match(self::RGX_TELEPHONE_RDC, $telephone)) {
            throw new \RuntimeException("Votre numero de telphone est invalide");
        }
        if ($this->userModel->checkByPhone($telephone)) {
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
            $this->validationTelephone($telephone);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_TELEPHONE, $e->getMessage());
        }
        $user->setPhone($telephone);
    }
    /**
     * Traitement de l'image
     * @param User $user
     * @param array $image
     * @param boolean $nullable
     * @return void
     */
    protected function processingImage(User $user, $image): void
    {
        try {
            $this->validationImage($image);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_IMAGE, $e->getMessage());
        }
        $user->setPhoto($image);
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
            //$Idparent = $this->userModel->findRoot()->getId();
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

            $node = ($idSponsor == null && empty($idSponsor)) ? $this->userModel->findRoot() : $this->userModel->findById($idSponsor);
            // var_dump($this->userModel->countSides($node->getId()));
            // die();
            if ($this->userModel->countSides($node->getId()) == 2) {
                while ($this->userModel->countSides($node->getId()) == 2) {
                    if ($this->userModel->hasleftSide($node->getId())) {
                        $node = $this->userModel->findLeftSide($node->getId());
                    }
                }
                $user->setFoot(User::FOOT_LEFT);
            } else {
                if ($side != null) {
                    if (!$this->userModel->hasSide($node->getId(), $side)) {
                        $user->setSide($side);
                    } else {
                        $user->setSide($side == User::FOOT_LEFT ? User::FOOT_RIGHT : User::FOOT_LEFT);
                    }
                } else {
                    $user->setSide($this->userModel->hasLeftSide($node->getId()) ? User::FOOT_RIGHT : User::FOOT_LEFT);
                }
            }
            $user->setSponsor($node);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_SPONSOR, $e->getMessage());
            $user->setSponsor($idSponsor);
        }
    }
}

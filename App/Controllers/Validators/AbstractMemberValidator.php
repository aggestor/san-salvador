<?php

namespace Root\App\Controllers\Validators;

use ReflectionClass;
use Root\App\Models\AbstractMemberModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Member;
use Root\App\Models\Schema;
use RuntimeException;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractMemberValidator extends AbstractValidator
{
    const FIELD_EMAIL = 'userEmail';
    const FIELD_PASSWORD = 'password';
    const FIELD_NAME = 'username';
    const FIELD_TELEPHONE = 'PhoneNumber';

    const MAX_LENGHT_PSW = 30;
    const MIN_LENGHT_PSW = 8;

    /***
     * changement de statut du compte d'un utilisateur
     * @return Member
     */
    public abstract function changeStatusAfterValidation();

    /**
     * processus de connexion
     * @return Member
     */
    public abstract function loginProcess();

    /**
     * Undocumented function
     *
     * @param string $mail
     * @param boolean $onConnection
     * @param Member $member
     * @return void
     */
    protected function validationEmail($mail, bool $onConnection = false, Member $member): void
    {

        $this->notNullable($mail);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException("Entrer un e-mail invalide");
        }
        $fac = ModelFactory::getInstance();
        $ref = new ReflectionClass($member);
        /**
         * @var AbstractMemberModel $model
         */
        $model = $fac->getModel($ref->getShortName());
        if ($onConnection) {
            if (!$model->checkByMail($mail)) {
                throw new \RuntimeException("Cet e-mail est introuvable ");
            }
        } else {
            if ($model->checkByMail($mail)) {
                throw new \RuntimeException("Cette e-mail est deja utiliser pour un autre compte");
            }
        }
    }

    /**
     * validation du nom d'un utilisateur
     * @param string $name
     * @throws \RuntimeException
     */
    protected function validationName($name): void
    {
        $this->notNullable($name);
        if (strlen($name) > 30) {
            throw new \RuntimeException("Entrez un nom de moin de 30 caractere");
        }
    }

    /**
     * Traitement du nom de l'utilisateur
     *
     * @param Member $member
     * @param string $name
     * @return void
     */
    protected function processingName(Member $member, $name): void
    {
        try {
            $this->validationName($name);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_NAME, $e->getMessage());
        }
        $member->setName($name);
    }


    /**
     * validation du mot de apssse
     * @param string $password
     * @param bool $onCreate
     * @param string $confirmation
     * @throws \RuntimeException
     */
    protected function validationPassword($password, bool $onCreate = false, $confirmation = "", Member $member): void
    {
        if ($onCreate) {
            if ($this->isNull($password) || $this->isNull($confirmation)) {
                throw new \RuntimeException("Entrez et confirmez votre mot de passe");
            }

            if ($password != $confirmation) {
                throw new \RuntimeException("Le mot de passe doit etre indentique a la confirmation");
            }

            if (strlen($password) < self::MIN_LENGHT_PSW || strlen($password) > self::MAX_LENGHT_PSW) {
                throw new \RuntimeException("Le mot de passe doit etre " . self::MIN_LENGHT_PSW . " et " . self::MAX_LENGHT_PSW . " carractere");
            }
        } else {
            //pour la connexion;
            $fac = ModelFactory::getInstance();
            $ref = new ReflectionClass($member);
            /**
             * @var AbstractMemberModel $model
             */
            $model = $fac->getModel($ref->getShortName());
            if ($this->isNull($password)) {
                throw new \RuntimeException("Entrez et confirmez votre mot de passe");
            }

            if (strlen($password) < self::MIN_LENGHT_PSW || strlen($password) > self::MAX_LENGHT_PSW) {
                throw new \RuntimeException("Mot de passe invalide");
            }
            if ($model->check(Schema::USER['user_password'], $password)) {
                throw new \RuntimeException("Mot de passe incorrect");
            }
        }
    }
    /**
     * Undocumented function
     *
     * @param Member $member
     * @param string $password
     * @param boolean $onCreate
     * @param string $confirmation
     * @return void
     */
    protected function processingPassword(Member $member, $password, $onCreate = false, $confirmation = "")
    {
        try {
            $this->validationPassword($password, $onCreate, $confirmation, $member);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_PASSWORD, $e->getMessage());
        }
        $pass_has = !empty($password) ? password_hash($password, PASSWORD_ARGON2I) : null;
        $member->setPassword($pass_has);
    }
    /**
     * traitement de l'e-mail
     * @param Member $member
     * @param string $mail
     * @param boolean $onConnection
     */
    protected function processingEmail(Member $member, $mail, $onConnection = false): void
    {
        try {
            $this->validationEmail($mail, $onConnection, $member);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_EMAIL, $e->getMessage());
        }
        $member->setEmail($mail);
    }
}

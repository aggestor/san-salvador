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
    const FIELD_EMAIL = 'user_email';
    const FIELD_PASSWORD = 'password';
    const FIELD_NAME = 'username';
    const FIELD_TELEPHONE = 'phone_number';
    const FIELD_TOKEN = 'token';

    const MAX_LENGHT_PSW = 30;
    const MIN_LENGHT_PSW = 8;
    const MAX_LENGHT_TOKEN = 60;

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
     * Reset password
     *
     * @return Member
     */
    public abstract function resetPassword();
    /**
     * Active Account apres validation
     *
     * @return Member
     */
    public abstract function activeAccountAfterValidation();
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
            $user = $model->findByMail($mail);
            if (!$user->isValidationMail()) {
                throw new \RuntimeException("Votre Compte n'est pas encore active, un email d'activavion est déja envoyer dans votre boite mail");
            }
            if (!$model->checkByMail($mail)) {
                throw new \RuntimeException("Votre adresse e-mail est incorrect");
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
            if ($this->isNull($password)) {
                throw new \RuntimeException("Ce champs est obligatoire");
            }
            if (strlen($password) < self::MIN_LENGHT_PSW || strlen($password) > self::MAX_LENGHT_PSW) {
                throw new \RuntimeException("Mot de passe invalide");
            }
            $fac = ModelFactory::getInstance();
            $ref = new ReflectionClass($member);
            /**
             * @var AbstractMemberModel $model
             */
            $model = $fac->getModel($ref->getShortName());
            $mail = $model->findByMail($member->getEmail());
            $pass_has = !is_null($mail) ? $mail->getPassword() : "";
            if (!password_verify($password, $pass_has)) {
                throw new \RuntimeException("L'adresse e-mail et/ou le mot de passe est incorrect");
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
     * @return string|void
     */
    protected function processingPassword(?Member $member, $password, $onCreate = false, $confirmation = "", bool $onActivation = false)
    {
        try {
            $this->validationPassword($password, $onCreate, $confirmation, $member);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_PASSWORD, $e->getMessage());
        }
        $pass_has = !empty($password) ? password_hash($password, PASSWORD_ARGON2I) : null;
        if ($onActivation) {
            return $pass_has;
        } else {
            $member->setPassword($pass_has);
        }
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
    /**
     * Pour la validation du compte
     *
     * @param string $token. Token 
     * @param string $id. id
     * @param Member $member
     * @throws \RuntimeException
     */
    protected function validationAccount(string $token, string $id, Member $member)
    {

        if ($this->isNull($token) || $this->isNull($id)) {
            throw new \RuntimeException("Erreur d'activation du compte");
        }
        //on verifie si l'id existe et le token
        $fac = ModelFactory::getInstance();
        $ref = new ReflectionClass($member);
        /**
         * @var AbstractMemberModel $model
         */
        $model = $fac->getModel($ref->getShortName());
        // var_dump($model->checkById($id));
        // exit();
        if (!$model->checkById($id)) {
            throw new \RuntimeException("Id introuvable");
        }

        /**
         * @var Member
         */
        $occurence = $model->findById($id);
        $getToken = $occurence->getToken(); //get token n'existe pas pour le moment
        if ($getToken == "") {
            throw new \RuntimeException("Token introuvable");
        }
        if ($getToken != $token) {
            throw new \RuntimeException("Token introuvable");
        }
    }
    /**
     * Pour le traitement du compte apres validation
     * @param string $token
     * @param string $id
     * @param Member $member
     * @return void
     */
    public function processingAccount($token, $id, Member $member): void
    {
        try {
            $this->validationAccount($token, $id, $member);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_TOKEN, $e->getMessage());
        }
    }
    /**
     * Pour la validation du token
     *
     * @param string $token
     * @return void
     */
    public function validationToken(string $token)
    {
        if ($this->isNull($token)) {
            throw new \RuntimeException("Token invalide {$token}");
        }
    }
    /**
     * Traitement du token apres validation
     *
     * @param string $token
     * @param Member $member
     */
    public function processingToken($token, Member $member)
    {
        try {
            $this->validationToken($token);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_TOKEN, $e->getMessage());
        }
        $member->setToken($token);
    }
}

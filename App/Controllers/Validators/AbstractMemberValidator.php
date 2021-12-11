<?php
namespace Root\Controllers\Validators;


use Root\Models\Objects\Member;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractMemberValidator extends AbstractValidator
{
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';
    const FIELD_NAME = 'name';
    
    const MAX_LENGHT_PSW = 30;
    const MIN_LENGHT_PSW = 8;
    
    /***
     * changement de statut du compte d'un utilisateur
     * @return Member
     */
    public abstract function changeStatusAfterValidation ();
    
    /**
     * processus de connexion
     * @return Member
     */
    public abstract function loginProcess ();
    
    /**
     * valdiation d'un email
     * @param string $mail
     * @param bool $onConnection
     * @throws \RuntimeException
     */
    protected function validationEmail ($mail, bool $onConnection = false) : void {
        $this->notNullable($mail);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException("Entrer un e-mail valide");
        }
    }

    /**
     * validation du nom d'un utilisateur
     * @param string $name
     * @throws \RuntimeException
     */
    protected function validationName ($name) : void {
        $this->notNullable($name);
        if (strlen($name) > 30 ) {
            throw new \RuntimeException("Entrez un nom de moin de 30");
        }
    }
    
    /**
     * validation du mot de apssse
     * @param string $password
     * @param bool $onCreate
     * @param string $confirmation
     * @throws \RuntimeException
     */
    protected function validationPassword ($password, bool $onCreate = false, $confirmation) : void {
        if ($onCreate) {
            if ($this->isNull($password) || $this->isNull($confirmation)) {
                throw new \RuntimeException("Entrez et confirmez votre mot de passe");
            }
            
            if ($password != $confirmation) {
                throw new \RuntimeException("Le mot de passe doit etre indentique a la confirmation");
            }
            
            if (strlen($password) < self::MIN_LENGHT_PSW || strlen($password) > self::MAX_LENGHT_PSW) {
                throw new \RuntimeException("Le mot de passe doit etre ".self::MIN_LENGHT_PSW." et ".self::MAX_LENGHT_PSW." carractere");
            }
        }else {
            //pour la connexion;
            if ($this->isNull($password) || $this->isNull($confirmation)) {
                throw new \RuntimeException("Entrez et confirmez votre mot de passe");
            }
            
            if (strlen($password) < self::MIN_LENGHT_PSW || strlen($password) > self::MAX_LENGHT_PSW) {
                throw new \RuntimeException("Mot de passe invalide");
            }
        }
    }
    
    
    
    /**
     * traitement de l'e-mail
     * @param Member $member
     * @param string $mail
     * @param boolean $onConnection
     */
    protected function processingEmail (Member $member, $mail, $onConnection=false) : void {
        try {
            $this->validationEmail($mail, $onConnection);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_EMAIL, $e->getMessage());
        }
        $member->setEmail($mail);
    }
}


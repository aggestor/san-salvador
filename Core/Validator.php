<?php

namespace Root\Core;

class Validator
{
    private $errors=[];
    /**
     * Function pour verifier si un champs n'est pas vide
     *
     * @param mixed $texte
     * @return boolean
     */
    public static function isEmpty($texte)
    {
        if (!empty($texte)) {
            return false;
        }
        return true;
    }
    /**
     * Function pour verifier si l'email est valide
     *
     * @param [type] $texte
     * @return boolean
     */
    public static function isEmail($texte)
    {
        if (filter_var($texte, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    /**
     * Pour verifier si un post existe deja dans la base des donnees
     *
     * @param mixed $texte
     * @return boolean
     */
    public static function isExist($texte)
    {

    }
    /**
     * pour verifier si un post est un entier
     *
     * @param mixed $texte
     * @return boolean
     */
    public static function isEntier($texte)
    {
        if (filter_var($texte, FILTER_VALIDATE_INT)) {
            return true;
        }
        return false;
    }
    /**
     * Pour verifier si une session existe
     *
     * @param mixed $session
     * @return void
     */
    public static function sessionExist($session)
    {
        if (isset($session) && !empty($session)) {
            return true;
        }
        return false;
    }


    
    /**
     * Undocumented function
     *
     * @param mixed $texte
     * @return boolean
     */
    public function isString($texte)
    {
        if (preg_match("#^[a-zA-Z]*$#", $texte)) {
            return true;
        }
        return false;
    }
    /**
     * Fonction de criptage des password;
     *
     * @param mixed $password
     * @return void
     */
    public static function crypt($password)
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }
    public function verify($password)
    {

    }
}

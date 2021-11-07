<?php
    namespace Root\App\Controllers;
    class Validator{
        public $regexs=[
            'alpha'         => '[\p{L}]+',
            'alphanum'      => '[\p{L}0-9]+',
            'int'           => '[0-9]+',
            'float'         => '[0-9\.,]+',
            'tel'           => '[0-9+\s()-]+',
            'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
        ];
        /**
         * isFloat est une methode qui verifie si une valeur est de type decimale
         *
         * @param [type] $value est une valeur a verifier
         * @return boolean retourne trou si c'est un decimale et false dans le cas contraire 
         */
        public static function isFloat($value){
            if(filter_var($value, FILTER_VALIDATE_FLOAT)) return true;
        }
        /**
         * isInt permet deverifier si une valeur est de type entier
         *
         * @param [type] $value est une valeur a verifier
         * @return boolean retourne trou si c'est un entier et false dans le cas contraire 
         */
        public static function isInt($value){
            if(filter_var($value, FILTER_VALIDATE_INT)) return true;
        }
        /**
         * isEmail verifier si la valeur donnée est un address email
         *
         * @param [type] $value valeur a verifier
         * @return boolean retourne trou si c'est un email et false dans le cas contraire 
         */
        public static function isEmail($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
        }
        /**
         * isPhone est une methode qui verifier si une valeur est numéro de téléphone
         *
         * @param [type] $value valeur a verifier
         * @return boolean retourne trou si le numero est conforme et false dans le cas contraire 
         */
        public static function isPhone($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[0-9+\s()-]+/" )))) return true;
        }
        /**
         * isString varifie si la valeur est de type texte
         *
         * @param [type] $value valeur a verifier
         * @return boolean retourne trou si c'est un texte et false dans le cas contraire 
         */
        public static function isString($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z]+$/")))) return true;
        }
    }
?>
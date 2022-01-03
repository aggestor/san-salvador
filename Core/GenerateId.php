<?php

namespace Root\Core;

class GenerateId
{
    private static $DEFAULT_CHARS = "qbcdefghijklmnopqrst1234567890";
    
    /**
     * Pour genener un melnge de chaine de caractere 
     *
     * @param integer $length. La longueur de la chaine de caractere a genener
     * @param string $carateres. Les caracteres a melanger
     * @return string
     */
    public static function generate(int $length=11, ?string $carateres = null)
    {
        return substr(str_shuffle(str_repeat($carateres != null? $carateres : self::$DEFAULT_CHARS, $length)), 0, $length);
    }
}

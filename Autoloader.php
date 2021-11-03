<?php

namespace App;
/**
 * This It autoloads name spaces and classes
 */
class Autoloader
{
    static function register(){
        spl_autoload_register([__CLASS__, "autoload"]);
    }
    static function autoload($class){

        $class = str_replace(__NAMESPACE__."\\", "", $class);
        $class = str_replace("\\", "/",$class);
        $file = __DIR__.'/'.$class.".php";

        if(file_exists($file)){
            require($file);
        }
    }
}
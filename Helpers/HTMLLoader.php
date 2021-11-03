<?php

namespace App\Helpers;

class HTMLLoader{
    public string $file = "";
    /**
     * @param 
     */
    public static function load(string $file = ""):void{
        //checking if the provided parameter is a file
        if(file_exists($file)){
            include($file);
        }else{
            die("Ce fichier n'existe pas");
        }
    }

}


?>



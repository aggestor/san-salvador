<?php
    namespace Root\App\Helpers;

    class MenuHighlighter{
        public static array $paths = ['home','packages', 'register', 'login','products', 'services'];
        public static string $current_path = '';

        public static function get_path(){
            if(isset($_GET['path'])){
                $path = $_GET['path'];

                if(in_array($path, Self::$paths)){
                    switch($path){
                        case "packages":
                            Self::set_path("packs");
                            break;
                        case "products" :
                            Self::set_path("produits");
                            break;
                        case "services" :
                            Self::set_path("services");
                            break;
                        case "home" :
                            Self::set_path("acceuil");
                            break;
                    }
                }else{
                    Self::set_path("404");
                }
            }else{
                Self::set_path("acceuil");
            }
            return  new MenuHighlighter;
        }
        private static function set_path( string $path = ""){
            if(is_string($path)){
                Self::$current_path = $path;
            }else{
                http_response_code(404);
                die("Wrong path provided !");
            }

        }
         public static function high_light(string $menu = ""){
             if(strtolower($menu) === Self::$current_path){
                 return "_green_text";
             }
             else return;
         }

    }



?>
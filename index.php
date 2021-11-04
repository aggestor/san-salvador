<?php

use App\Autoloader;
use App\Helpers\HTMLLoader;

include("Autoloader.php");
    Autoloader::register()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/tailwind.css"/>
    <link rel="stylesheet" href="assets/global.css"/>
    <!--
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    -->
</head>
<body class="w-screen secondary_bg h-screen overflow-x-hidden overflow-y-scroll grid grid-cols-12">
    <!-- header page beginning-->
    <?php 
        if(isset($_GET['path'])){
            $path = htmlspecialchars($_GET['path']);
            switch($path){
                case "home":
                    HTMLLoader::load("pages/indexContent.php");
                    break;
                case "packages":
                    HTMLLoader::load("pages/packs.php");
                    break;
                case "products":
                    HTMLLoader::load("pages/products.php");
                    break;
                case "services":
                    HTMLLoader::load("pages/services.php");
                    break;
                default:
                    include("index.php");
                    break;

            }
        }
        else{
                HTMLLoader::load("pages/indexContent.php");
            }
    ?>
</body>
</html>
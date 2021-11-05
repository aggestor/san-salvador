<?php
use Root\Autoloader;

include("../Autoloader.php");
    Autoloader::register()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/tailwind.min.css"/>
    <link rel="stylesheet" href="assets/css/aos.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css"/>
    <!--
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    -->
</head>
<body class="w-screen secondary_bg  h-screen overflow-x-hidden overflow-y-scroll ">
    <!-- header page beginning-->
    <?php 
        if(isset($_GET['path'])){
            $path = htmlspecialchars($_GET['path']);
            switch($path){
                case "home":
                    require("../Views/pages/indexContent.php");
                    break;
                case "packages":
                    require("../Views/pages/packs.php");
                    break;
                case "products":
                    require("../Views/pages/products.php");
                    break;
                case "services":
                    require("../Views/pages/services.php");
                    break;
                default:
                    require("../Views/pages/404.php");
                    break;
            }
        }
        else{
                require("../Views/pages/indexContent.php");
            }
    ?>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
            AOS.init()
            
    </script>
</body>
</html>
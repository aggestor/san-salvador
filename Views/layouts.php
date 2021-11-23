<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/tailwind.min.css" />
    <link rel="stylesheet" href="assets/css/aos.min.css" />
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
    <!--
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    -->
</head>

<body class="w-screen primary_bg bg-opacity-100 grid grid-cols-12 h-screen overflow-y-scroll ">
    <!-- header page beginning-->

    <?php
    require(VIEWS . "includes/HeaderBar.php");
    echo $content;
    require(VIEWS . "includes/Footer.php");
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        AOS.init()
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/tailwind.css" />
    <link rel="stylesheet" href="/assets/css/aos.min.css" />
    <link rel="stylesheet" href="/assets/css/global.css" />
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
</head>

<body class="w-screen primary_bg bg-opacity-100 overflow-x-hidden scroll grid grid-cols-12 overflow-y-auto ">
    <!-- header page beginning-->

    <?= $content ?>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/orgchart.js"></script>
    <script src="/assets/js/aos.min.js"></script>
    <script src="/assets/js/cropper.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        AOS.init()
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <meta name='viewport' content="width=device-width,height=device-height, initial-scale=1, shrink-to-fit=yes">

    <!--theme colors -->
    <meta name="theme-color" content="#3b82f6" />

    <!--Basic meta info -->
    <meta name="keywords" content="Usalvagetrade, usalvage, universal salvage trade, usalva, trading, traders">
    <meta name="author" content="Usalavagetrade" />
    <meta name="description" content="Usalavagetrade, La revolution du commerce de la cryptomonnaie | Universal salvage trade">

    <!--OpenGraph meta -->
    <meta property="og:description" content="Usalavagetrade, La revolution du commerce de la cryptomonnaie | Universal salvage trade" />
    <meta property="og:title" content="La revolution du commerce de la cryptomonnaie" />
    <meta property="og:image" content="/assets/logos/icon.png" />

    <link rel="stylesheet" href="/assets/css/main.css" />
    <!--<link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha512-L7MWcK7FNPcwNqnLdZq86lTHYLdQqZaz5YcAgE+5cnGmlw8JT03QB2+oxL100UeB6RlzZLUxCGSS4/++mNZdxw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/logos/icon.png">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="w-screen primary_bg bg-opacity-100 scroll grid grid-cols-12 overflow-y-auto ">
    <!-- header page beginning-->
    <div class="grid grid-cols-1 col-span-12">
        <div class="col-span-1 flex justify-between h-24 p-2 primary_bg_ border-gray-800 border-b">
            <div id="user-identifiers" class="w-3/12 h-full flex">
                <div class="h-20 overflow-hidden w-20 grid place-items-center border-gray-800 border rounded-full primary_bg">
                    <img class="object-contain" src="/assets/img/<?= $images[0] ?>" alt="<?= $_SESSION["users"]->getName() ?>">
                </div>
                <div class="w-8/12 flex flex-col pl-5">
                    <span class="text-gray-300 font-semibold text-lg"><?= $_SESSION["users"]->getName() ?></span>
                    <span class="text-gray-400 text-base"><?= $_SESSION["users"]->getEmail() ?></span>
                    <span class="_green_text text-sm">Online</span>
                </div>
            </div>
            <div class="w-2/12 flex items-center h-full">
                <span class="bg-gray-300 grid mr-4 ml-3 text-gray-900 place-items-center w-8 h-8 rounded-full">
                    <i class="fas fa-dollar-sign "></i>
                </span>
                <span class="font-semibold text-gray-300 text-xl my-auto">
                    <?= $params['user']->getSold() ?>
                </span>
            </div>
            <div class="w-2/12 flex items-center h-full">
                <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-12 rounded-full">
                    <span class="text-base font-semibold mr-1"><?= $params['user']->getPack()->getName() ?></span> <i class="fas fa-check-circle "></i>
                </span>
            </div>
            <div class="w-2/12 flex items-center h-full">
                <span class="bg-gray-300 grid text-gray-900 place-items-center w-8 h-8 rounded-full">
                    <i class="fas fa-calendar "></i>
                </span>
                <span class="text-gray-300 flex pl-2 flex-col my-auto">
                    <span>Membre depuis </span>
                    <span><?= $_SESSION['users']->getrecordDate()->format("F Y") ?></span>
                </span>
            </div>
            <div class="w-3/12 border-gray-800 border p-2 mr-3 h-full rounded-xl">
                <div class="flex relative">
                    <span class="w-4 h-4 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                    <span class="w-3 h-3 left-1 top-1 rounded-full absolute bg-green-500"></span>
                    <span class="text-green-500 absolute left-10 "> EVOLUTION DE VOTRE COMPTE</span>
                </div>
                <div class="w-full h-3 overflow-hidden mt-8 border-green-500 border rounded-full">
                    <div style="width: calc(<?= $params['user']->getBonusToPercent() ?>%/3)" class="h-2 bg-green-500">

                    </div>
                </div>
                <div class="text-gray-500 flex justify-between">
                    <span><?= $params['user']->getBonusToPercent() ?>%</span>
                    <span class="text-green-500">300%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 col-span-12">
        <div class="col-span-2 h-96 rounded border border-gray-800 primary_bg_">
            <div data-path-user="/user/dashboard" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-school"></i></span>
                    <span class="w-10/12 mt-0.5">Dashboard</span>
                </div>
            </div>
            <div data-path-user="/user/tree" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-tree"></i></span>
                    <span class="w-10/12 mt-0.5">Arbre</span>
                </div>
            </div>
            <div data-path-user="/user/me" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-user"></i></span>
                    <span class="w-10/12 mt-0.5">Mon Compte</span>
                </div>
            </div>
            <div data-path-user="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-home"></i></span>
                    <span class="w-10/12 mt-0.5">Acceuil</span>
                </div>
            </div>
            <div data-path-user="/user/logout" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-power-off"></i></span>
                    <span class="w-10/12 mt-0.5">Déconnexion</span>
                </div>
            </div>
        </div>
        <div class="col-span-10 flex flex-col p-3">
            <?= $content ?>
        </div>
    </div>



    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/aos.min.js"></script>
    <script src="/assets/js/cropper.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        AOS.init()
    </script>
</body>

</html>
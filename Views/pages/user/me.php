<?php
$images = explode("AND", $_SESSION['users']->getPhoto());
?>

<div class="col-span-12  primary_bg">
    <div class="w-full flex justify-between lg:h-24 h-auto flex-col lg:flex-row p-2 primary_bg_ border-gray-800 border-b">
        <div id="user-identifiers" class="lg:w-3/12 w-full h-full flex ">
            <div class=":h-20 h-16 w-16 overflow-hidden lg:w-20 grid place-items-center border-gray-800 border rounded-full primary_bg">
                <img class="object-contain" src="/assets/img/<?= $images[0] ?>" alt="<?= $params['user']->getName() ?>">
            </div>
            <div class="w-7/12 flex flex-col pl-5">
                <span class="text-gray-300 font-semibold text-base lg:text-lg"><?= $params['user']->getName() ?></span>
                <span class="text-gray-400 lg:text-base text-sm"><?= $params['user']->getEmail() ?></span>
                <span class="text-green-500 border border-green-500 rounded-full w-16 text-center p-0.5 lg:text-sm text-xs">En ligne</span>
            </div>
            <div class="w-2/12 lg:hidden flex flex-col">
                <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-6 rounded-full">
                    <span class="text-xs font-semibold mr-1"><?= $params['user']->getPack()->getName() ?></span> <i class="fas text-xs fa-check-circle "></i>
                </span>
                <span class="flex items-center border-gray-800 border mt-3 rounded-full">
                    <span class="bg-gray-300 grid mr-4 text-gray-900 place-items-center w-6 h-6 rounded-full">
                        <i class="fas text-sm fa-dollar-sign "></i>
                    </span>
                    <span class="font-semibold text-gray-300 text-sm my-auto">
                        <?= $params['user']->getSold() ?>
                    </span>
                </span>
            </div>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-gray-300 grid mr-4 ml-3 text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-dollar-sign "></i>
            </span>
            <span class="font-semibold text-gray-300 text-xl my-auto">
                <?= $params['user']->getSold() ?>
            </span>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-12 rounded-full">
                <span class="text-base font-semibold mr-1"><?= $params['user']->getPack()->getName() ?></span> <i class="fas fa-check-circle "></i>
            </span>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-gray-300 grid text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-calendar "></i>
            </span>
            <span class="text-gray-300 flex pl-2 flex-col my-auto">
                <span>Membre depuis </span>
                <span><?= $_SESSION['users']->getrecordDate()->format("F Y") ?></span>
            </span>
        </div>
        <div class="lg:w-3/12 w-full border-gray-800 lg:border lg:p-2 p-1 lg:mr-3 h-full rounded-xl">
            <div class="lg:flex hidden relative">
                <span class="w-3 h-3 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                <span class="w-2 h-2  top-1 rounded-full absolute bg-green-500"></span>
                <span class="text-green-500 absolute left-10 -top-1 "> Evolution de votre compte</span>
            </div>
            <div class="w-full h-2 overflow-hidden lg:mt-8 mt-2 mr-3 border-green-500 border rounded">
                <div style="width: calc(<?= $params['user']->getBonusToPercent() ?>% / 3)" class="h-1 bg-green-500">

                </div>
            </div>
            <div class="text-gray-500 text-sm flex justify-between">
                <span><?= $params['user']->getBonusToPercent() ?>%</span>
                <span class="text-green-500">300%</span>
            </div>
        </div>
        <div class="w-full hide-scroll-bar ml-1 h-10 sticky top-0 flex lg:hidden text-sm items-center overflow-y-hidden overflow-x-auto">
            <div data-path-user="/user/dashboard" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-10/12 mt-0.5">Dashboard</span>
            </div>
            <div data-path-user="/user/tree" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Arbre</span>
            </div>
            <div data-path-user="/user/me" class="flex p-1 my-2  text-white transition-all duration-500   cursor-pointer bg-gradient-to-r bg-green-600 rounded  hover:text-white">
                <span class="w-auto mx-2 flex"><span class="mr-1">Mon</span> <span>Compte</span></span>
            </div>
            <div data-path-user="/user/cashout" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Retrait</span>
            </div>
            <div data-path-user="/" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Acceuil</span>
            </div>
            <div data-path-user="/user/share/link" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Partager</span>
            </div>
            <div data-path-user="/user/logout" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Déconnexion</span>
            </div>
        </div>
    </div>
    <div class="w-full mt-4 grid grid-cols-12">
        <div class="col-span-2 hidden lg:block relative ml-1 h-screen-customer rounded border border-gray-800 primary_bg_">
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
            <div data-path-user="/user/me" class="flex p-2 my-2 from-green-500 to-gray-900 text-white transition-all duration-500   cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-user"></i></span>
                    <span class="w-10/12 mt-0.5">Mon Compte</span>
                </div>
            </div>
            <div data-path-user="/user/cashout" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-dollar-sign"></i></span>
                    <span class="w-10/12 mt-0.5">Retrait</span>
                </div>
            </div>
            <div data-path-user="/user/share/link" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-share"></i></span>
                    <span class="w-10/12 mt-0.5">Partager</span>
                </div>
            </div>
            <div data-path-user="/packages" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-upload"></i></span>
                    <span class="w-10/12 mt-0.5">Remonter de pack</span>
                </div>
            </div>
            <div data-path-user="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-arrow-left"></i></span>
                    <span class="w-10/12 mt-0.5">Retour à l'acceuil</span>
                </div>
            </div>
            <div data-path-user="/user/logout" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-power-off"></i></span>
                    <span class="w-10/12 mt-0.5">Déconnexion</span>
                </div>
            </div>
            <div class="absolute bottom-0 left-4 h-16 text-gray-500">
                <span class="text-center">Usalvagetrade &#169; 2022</span>
            </div>
        </div>
        <div class="lg:col-span-10 col-span-12 h-screen-customer mobile scroll overflow-y-auto overflow-x-hidden flex flex-col p-3">
            <div class="w-11/12 mx-auto mb-3  border-b border-gray-900">
                <h1 class="text-gray-400 mb-3"> <i class="fas text-xl fa-info-circle mr-2"></i> <span class="font-semibold text-base lg:text-2xl">Toutes les informations nécessaires sur l'utilisateur</span></h1>
            </div>
            <div class="w-11/12 mx-auto lg:space-x-3 lg:flex-row flex-col flex">
                <div class="lg:w-4/12 w-11/12 mx-auto lg:mx-0 lg:block flex justify-center ">
                    <img class="object-contain h-60 w-60 rounded-full lg:rounded-lg" src="/assets/img/<?= $images[0] ?>" alt="<?= $params['user']->getName() ?>">
                </div>
                <div class="lg:w-4/12 w-11/12 lg:mx-0 mx-auto p-2 h-auto rounded my-3  lg:bg-transparent ">
                    <h2 class=" w-10/12 mx-auto text-blue-500 mb-2 font-semibold">Informations personnelles</h2>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Noms</div>
                        <div class="text-gray-600"><?= $params['user']->getName() ?></div>
                    </div>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Adresse mail</div>
                        <div class="text-gray-600"><?= $params['user']->getEmail() ?></div>
                    </div>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Numéro de téléphone</div>
                        <div class="text-gray-600"><?= str_replace("/", "", $params['user']->getPhone()) ?></div>
                    </div>
                    <div class="w-10/12 mx-auto h-16">
                        <a href="/user/edit" class="p-2 hover:bg-blue-700 cursor-pointer rounded bg-blue-600 text-white text-center">Modifier</a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
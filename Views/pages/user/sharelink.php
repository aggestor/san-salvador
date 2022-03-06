<?php
$images = explode("AND", $params['user']->getPhoto());
?>

<div class="col-span-12  primary_bg">
    <div class="w-full flex justify-between lg:h-24 h-auto flex-col lg:flex-row p-2 primary_bg_ border-gray-800 border-b">
        <div class="flex lg:hidden my-2 justify-between">
            <h1 class="text-gray-200 font-semibold">USALVAGETRADE</h1>
             <button id="hamburger" class="w-8 h-8 rounded sm:hidden items-center flex justify-center border my-auto text-gray-800">
                <i class="fas fa-bars text-xl text-gray-200"></i>
            </button>
        </div>
        <nav id="mobile" class="hidden flex-col fixed w-screen h-screen z-1000 top-0 secondary_bg">
            <div class="flex justify-end w-11/12 mx-auto">
                <button id="times" class="w-8 h-8  sm:hidden flex justify-center items-center border rounded mt-4 text-white">
                    <i class="fas fa-times text-xl text-gray-200"></i>
                </button>
            </div>
            <ul class="flex w-full justify-evenly text-center  h-96 flex-col text-white">
            <li class="text-base"><span><a href="/user/dashboard">Dashboard</a></span></li>
                    <li class="text-base"><span><a href="/user/tree">Arbre</a></span></li>
                    <li class="text-base"><span><a href="/user/cashout">Retrait</a></span></li>
                    <li class="text-base"><span><a href="/">Acceuil</a></span></li>
                    <li class="text-base"><span><a href="/user/share/link">Partager</a></span></li>
                    <li class="hover:text-green-500 text-base"><a href="/user/me">Mon Compte</a></li>
                    <li class="hover:text-green-500 font-semibold text-base"><a href="/user/logout">Déconnexion</a></li>
            </ul>
            <p class="text-gray-400 w-full mx-auto text-center mt-36">&#169; USALVAGETRADE <span id="year"></span></p>
        </nav>
        <div id="user-identifiers" class="lg:w-3/12 w-full h-full flex ">
            <div class="h-16 w-16 overflow-hidden grid place-items-center border-gray-800 border rounded-full primary_bg">
                <img class="object-contain" src="/assets/img/<?=$images[0]?>" alt="<?=$_SESSION["users"]->getName()?>">
            </div>
            <div class="w-7/12 flex flex-col pl-5">
                <span class="text-gray-300 font-semibold text-base lg:text-lg"><?=$_SESSION["users"]->getName()?></span>
                <span class="text-gray-400 lg:text-base text-sm"><?=$_SESSION["users"]->getEmail()?></span>
                <span class="text-green-500 border border-green-500 rounded-full w-16 text-center p-0.5 text-xs">En ligne</span>
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
                <span><?= $params['user']->getrecordDate()->format("F Y") ?></span>
            </span>
        </div>
        <div class="lg:w-3/12 w-full border-gray-800 lg:border lg:p-2 p-1 lg:mr-3 h-full rounded-xl">
            <div class="lg:flex hidden relative">
                <span class="w-3 h-3 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                <span class="w-2 h-2  top-1 rounded-full absolute bg-green-500"></span>
                <span class="text-green-500 absolute left-10 -top-1 "> Evolution de votre compte</span>
            </div>
            <div class="w-full h-2 overflow-hidden lg:mt-8 mt-2 mr-3 border-green-500 border rounded">
                <div style="width: calc(<?= $params['user']->getBonusToPercent() ?>%/3)" class="h-1 bg-green-500">

                </div>
            </div>
            <div class="text-gray-500 text-sm flex justify-between">
                <span><?= $params['user']->getBonusToPercent() ?>%</span>
                <span class="text-green-500">300%</span>
            </div>
        </div>
<<<<<<< HEAD
=======
        <div class="w-full hide-scroll-bar ml-1 h-10 sticky top-0 flex lg:hidden text-sm items-center overflow-y-hidden overflow-x-auto">
            <div data-path-user="/user/dashboard" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white"> <span class="w-10/12 mt-0.5">Dashboard</span>
            </div>
            <div data-path-user="/user/tree" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Arbre</span>
            </div>
            <div data-path-user="/user/me" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2 flex"><span class="mr-1">Mon</span> <span>Compte</span></span>
            </div>
            <div data-path-user="/user/cashout" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Retrait</span>
            </div>
            <div data-path-user="/" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Acceuil</span>
            </div>
            <div data-path-user="/user/share/link" class="flex p-1 my-2  text-white transition-all duration-500   cursor-pointer bg-gradient-to-r bg-green-600 rounded  hover:text-white">
                <span class="w-auto mx-2">Partager</span>
            </div>
            <div data-path-user="/user/logout" class="flex p-1 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:text-white">
                <span class="w-auto mx-2">Déconnexion</span>
            </div>
        </div>
>>>>>>> 18b5b5f826e0917c814f131705def5c8c4f879ec
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
            <div data-path-user="/user/me" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
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
            <div data-path-user="/user/share/link" class="flex p-2 my-2 from-green-500 to-gray-900 text-white transition-all duration-500   cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
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
                <span class="text-center">Usalvagetrade &#169; <span id="year"></span></span>
            </div>
        </div>
        <div class="lg:col-span-10 col-span-12 h-screen-customer scroll overflow-y-auto overflow-x-hidden flex lg:p-3 p-0">
            <div class="flex flex-col w-11/12 mx-auto">
                <div class="w-full mb-3 h-10 border-b border-gray-900">
                    <h1 class="text-gray-400"> <i class="fas text-xl fa-share-alt mr-2"></i> <span class="font-semibold lg:text-2xl text-base">Partage un lien de parrainage</span></h1>
                </div>
                <form class="w-full flex justify-between my-6 lg:h-96 h-auto primary_bg_ rounded">
                    <div class="md:w-1/2 w-full p-3 h-full">
                        <div class=" mt-3 h-72 mb-2 flex flex-col justify-center items-center rounded w-full">
                            <div id="pairing-sides" class="h-32 mt-5 p-2 w-full border  border-gray-600 rounded flex flex-col">
                                <div class="w-10/12 text-gray-300">Choisir côté de parrainage</div>
                                <div class="mt-3 mx-1 flex  justify-between">
                                    <div data-side="1" class="flex border border-gray-400 cursor-pointer text-gray-300 rounded h-12 p-1 items-center w-4/12 justify-between">
                                        <span>Gauche</span>
                                        <span class="lg:h-7 h-4 lg:w-7 w-4 rounded-full border"></span>
                                    </div>
                                    <div data-side="2" class="flex border border-gray-400 cursor-pointer text-gray-300 rounded h-12 p-1 items-center w-4/12 justify-between">
                                        <span>Droite</span>
                                        <span class="lg:h-7 h-4 lg:w-7 w-4 rounded-full border"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-full mt-5 justify-around">
                                <!--PASSWORD BEGIN-->
                                <div class="w-9/12 flex justify-center items-center mb-2">
                                    <div id="valueToCopy" data-parent="<?= $params['user']->getId() ?>" data-sponsor="<?= $params['user']->getSponsor()->getId() ?>" class="w-full bg-gray-900 text-gray-400 justify-center items-center flex text-base cursor-text rounded h-10">
                                    </div>
                                </div>
                                <div class="w-3/12 flex items-center justify-end h-10">
                                    <span id="copy" class="bg-green-500 text-gray-900 rounded hover:bg-green-600 cursor-pointer p-1 items-center font-semibold flex justify-around w-10/12 h-10"> Copier <i class="fas fa-copy "></i></span>
                                </div>
                            </div>
                        </div>
                        <h3 class="w-11/12 text-gray-400"><b>Note :</b> Le partage d'un lien de parrainage permet d'angrandir votre reseau et de gagner un bonus de parrainnage</h3>
                    </div>
                    <div class="w-1/2 hidden md:flex justify-center p-2 h-full">
                        <img class="h-96" src="/assets/logos/share-link.png" alt="Share Link Illustration, https://storyset.com">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
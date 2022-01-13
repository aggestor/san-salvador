<?php
$images = explode("AND", $_SESSION['users']->getPhoto());
?>

<div class="col-span-12  primary_bg">
    <div class="w-full flex justify-between h-24 p-2 primary_bg_ border-gray-800 border-b">
        <div id="user-identifiers" class="w-3/12 h-full flex">
            <div class="h-20 overflow-hidden w-20 grid place-items-center border-gray-800 border rounded-full primary_bg">
                <img class="object-contain" src="/assets/img/<?=$images[0]?>" alt="<?=$_SESSION["users"]->getName()?>">
            </div>
            <div class="w-8/12 flex flex-col pl-5">
                <span class="text-gray-300 font-semibold text-lg"><?=$_SESSION["users"]->getName()?></span>
                <span class="text-gray-400 text-base"><?=$_SESSION["users"]->getEmail()?></span>
                 <span class="text-green-500 border border-green-500 rounded-full w-16 text-center p-0.5 text-sm">En ligne</span>
            </div>
        </div>
        <div class="w-2/12 flex items-center h-full">
             <span class="bg-gray-300 grid mr-4 ml-3 text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-dollar-sign "></i>
            </span>
            <span class="font-semibold text-gray-300 text-xl my-auto">
                <?=$params['user']->getSold()?>
            </span>
        </div>
        <div class="w-2/12 flex items-center h-full">
             <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-12 rounded-full">
               <span class="text-base font-semibold mr-1"><?=$params['user']->getPack()->getName()?></span> <i class="fas fa-check-circle "></i>
            </span>
        </div>
        <div class="w-2/12 flex items-center h-full">
             <span class="bg-gray-300 grid text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-calendar "></i>
            </span>
            <span class="text-gray-300 flex pl-2 flex-col my-auto">
                <span>Membre depuis </span>
                <span><?=$_SESSION['users']->getrecordDate()->format("F Y")?></span>
            </span>
        </div>
        <div class="w-3/12 border-gray-800 border p-2 mr-3 h-full rounded-xl">
            <div class="flex relative">
                <span class="w-3 h-3 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                <span class="w-2 h-2  top-1 rounded-full absolute bg-green-500"></span>
                <span class="text-green-500 absolute left-10 -top-1 "> Evolution de votre compte</span>
            </div>
            <div class="w-full h-2 overflow-hidden mt-8 border-green-500 border rounded">
                <div style="width: calc(<?=$params['user']->getBonusToPercent()?>% / 3)" class="h-1 bg-green-500">

                </div>
            </div>
            <div class="text-gray-500 text-sm flex justify-between">
                <span><?=$params['user']->getBonusToPercent()?>%</span>
                <span class="text-green-500">300%</span>
            </div>
        </div>
    </div>
    <div class="w-full mt-4 grid grid-cols-12">
        <div class="col-span-2 relative ml-1 h-screen-customer rounded border border-gray-800 primary_bg_">
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
            <div data-path-user="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-home"></i></span>
                    <span class="w-10/12 mt-0.5">Acceuil</span>
            </div>
            </div>
            <div data-path-user="/user/share/link" class="flex p-2 my-2 from-green-500 to-gray-900 text-white transition-all duration-500   cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-share-alt"></i></span>
                    <span class="w-10/12 mt-0.5">Partager</span>
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
        <div class="col-span-10 h-screen-customer scroll overflow-y-auto overflow-x-hidden flex p-3">
            <div class="flex flex-col w-11/12 mx-auto">
                <div class="w-full mb-3 h-10 border-b border-gray-900">
                  <h1 class="text-gray-400"> <i class="fas text-xl fa-share-alt mr-2"></i> <span class="font-semibold text-2xl">Partage un lien de parrainage</span></h1>
               </div>
               <form class="w-full flex justify-between my-6 h-96 primary_bg_ rounded">
                    <div class="w-1/2 p-3 h-full">
                        <div class=" mt-3 h-72 mb-2 flex flex-col justify-center items-center rounded w-full">
                            <div id="pairing-sides" class="h-32 mt-5 p-2 w-full border  border-gray-600 rounded flex flex-col">
                                <div class="w-10/12 text-gray-300">Choisir côté de parrainage</div>
                                <div class="mt-3 mx-1 flex  justify-between">
                                    <div data-side="1" class="flex border border-gray-400 cursor-pointer text-gray-300 rounded h-12 p-1 items-center w-4/12 justify-between">
                                        <span>Gauche</span>
                                        <span class="h-7 w-7 rounded-full border"></span>
                                    </div>
                                    <div data-side="2" class="flex border border-gray-400 cursor-pointer text-gray-300 rounded h-12 p-1 items-center w-4/12 justify-between">
                                        <span>Droite</span>
                                        <span class="h-7 w-7 rounded-full border"></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="flex w-full mt-5 justify-around">
                                <!--PASSWORD BEGIN-->
                                <div class="w-9/12 flex mb-2">
                                    <div  id="valueToCopy" data-parent="<?= $_SESSION['users']->getParent()->getId() ?>"data-sponsor="<?= $_SESSION['users']->getSponsor()->getId() ?>" class="w-full bg-gray-900 text-gray-400 flex-grow-0 flex-shrink-0 flex text-sm cursor-text rounded h-10">
                                    </div>
                                </div>
                                <div class="w-3/12 flex items-center justify-end h-10">
                                    <span id="copy" class="bg-green-500 text-gray-900 rounded hover:bg-green-600 cursor-pointer p-1 items-center font-semibold flex justify-around w-10/12 h-10"> Copier <i class="fas fa-copy "></i></span>
                                </div>
                            </div>
                        </div>
                        <h3 class="w-11/12 text-gray-400"><b>Note :</b> Le partage d'un lien de parrainage permet d'angrandir votre reseau et de gagner un bonus de parrainnage</h3>
                    </div>
                    <div class="w-1/2 flex justify-center p-2 h-full">
                            <img class="h-96" src="/assets/logos/share-link.png" alt="">
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
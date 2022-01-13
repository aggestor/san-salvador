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
                <span class="w-4 h-4 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                <span class="w-3 h-3 left-1 top-1 rounded-full absolute bg-green-500"></span>
                <span class="text-green-500 absolute left-10 "> EVOLUTION DE VOTRE COMPTE</span>
            </div>
            <div class="w-full h-3 overflow-hidden mt-8 border-green-500 border rounded-full">
                <div style="width: calc(<?=$params['user']->getBonusToPercent()?>%/3)" class="h-2 bg-green-500">

                </div>
            </div>
            <div class="text-gray-500 flex justify-between">
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
            <div data-path-user="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-home"></i></span>
                    <span class="w-10/12 mt-0.5">Acceuil</span>
            </div>
            </div>
            <div data-path-user="/user/share/link" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-share"></i></span>
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
        <div class="col-span-10 h-screen-customer scroll overflow-y-auto overflow-x-hidden flex flex-col p-3">
            <div class="w-11/12 mx-auto mb-3  border-b border-gray-900">
                  <h1 class="text-gray-400 mb-3"> <i class="fas text-xl fa-info-circle mr-2"></i> <span class="font-semibold text-2xl">Toutes les informations necessaires sur l'utilisateur</span></h1>
               </div>
            <div class="w-11/12 mx-auto flex">
                    <div class="w-4/12">
                        <img class="object-contain h-60 w-60 rounded-lg" src="/assets/img/<?=$images[0]?>" alt="<?=$_SESSION["users"]->getName()?>">
                    </div>
                    <div class="w-4/12 pl-3 h-56">
                        <h2 class=" w-10/12 mx-auto text-blue-500 mb-2 font-semibold">Informations personnelles</h2>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Id</div>
                            <div class="text-gray-600"><?=$_SESSION["users"]->getId()?></div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Noms</div>
                            <div class="text-gray-600"><?=$_SESSION["users"]->getName()?></div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Adresse mail</div>
                            <div class="text-gray-600"><?=$_SESSION["users"]->getEmail()?></div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Numéro de téléphone</div>
                            <div class="text-gray-600"><?=$_SESSION["users"]->getPhone()?></div>
                        </div>
                    </div>
                <div class="w-4/12 p-2">
                    <h2 class=" w-10/12 mx-auto text-blue-500 mb-2 font-semibold">Autres informations</h2>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Confirmation mail</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Compte activé</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Peu partager son lien</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Peut retirer</div>
                            <div class="w-16 h-8 border-red-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-red-500">Non </span> <i class="fas mt-1 text-red-500 fa-times    "></i>
                            </div>
                        </div>
                        
                        
                </div>
            </div>
            <div class="w-11/12 border-t border-gray-900 mx-auto flex ">
                <div class="w-4/12 h-56">
                    <h2 class=" w-10/12 mx-auto text-blue-500 mb-2 font-semibold">Information sur le Réseau</h2>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Parent</div>
                        <div class="text-gray-600"><?=$_SESSION["users"]->getParent()->getId()?></div>
                    </div>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Sponsor</div>
                        <div class="text-gray-600"><?=$_SESSION["users"]->getSponsor()->getId()?></div>
                    </div>
                    
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Capital investi</div>
                        <div class="w-16 h-8 border-blue-500  border p-1 rounded-full flex justify-around">
                                <span class="text-blue-500"><?=$_SESSION["users"]->getSold() ?> </span> <i class="fas mt-1 text-blue-500 fa-dollar-sign    "></i>
                        </div>
                    </div>
                    <div class="w-10/12 mx-auto h-16">
                        <div class="text-gray-300 font-semibold">Dévise</div>
                        <div class="w-16 h-8 border-blue-500  border p-1 rounded-full flex justify-around">
                                <span class="text-blue-500">USD</span> <i class="fas mt-1 text-blue-500 fa-dollar-sign    "></i>
                        </div>
                    </div>
                    
                </div>
                <div class="w-4/12 p-2">
                    <h2 class=" w-10/12 mx-auto text-blue-500 mb-2 font-semibold">Autres informations</h2>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Confirmation mail</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Compte activé</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Peu partager son lien</div>
                            <div class="w-16 h-8 border-green-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-green-500">Oui </span> <i class="fas mt-1 text-green-500 fa-check-circle    "></i>
                            </div>
                        </div>
                        <div class="w-10/12 mx-auto h-16">
                            <div class="text-gray-300 font-semibold">Peu retirer</div>
                            <div class="w-16 h-8 border-red-500  border p-1 rounded-full flex justify-around">
                                    <span class="text-red-500">Non </span> <i class="fas mt-1 text-red-500 fa-times    "></i>
                            </div>
                        </div>
                        
                        
                </div>
            </div>
        </div>
    </div>
</div>

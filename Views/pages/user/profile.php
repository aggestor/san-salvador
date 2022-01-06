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
                <span class="_green_text text-sm">Online</span>
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
               <span class="text-base font-semibold mr-1">Super diamond</span> <i class="fas fa-check-circle "></i>
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
        <div class="col-span-2 h-96 rounded border border-gray-800 primary_bg_">
            <div data-path="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-school"></i></span>
                    <span class="w-10/12 mt-0.5">Dashboard</span>
            </div>
            </div>
            <div data-path="/tree" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-tree"></i></span>
                    <span class="w-10/12 mt-0.5">Arbre</span>
            </div>
            </div>
            <div data-path="/me" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
            <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-user"></i></span>
                    <span class="w-10/12 mt-0.5">Mon Compte</span>
            </div>
            </div>
        </div>
        <div class="col-span-10 flex flex-col p-3">
            <div class="grid grid-cols-12 space-x-2 p-2">

                <div class="col-span-4 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                    <div class="flex">
                        <span class="text-blue-500 font-semibold"><i class="fas fa-comment-dollar"></i> MONTANT INVESTI</span>
                    </div>
                    <div class="w-full  rounded-full">
                        <div class="flex">
                            <span class="bg-blue-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                                <i class="fas fa-dollar-sign "></i>
                            </span>
                            <span class="font-semibold text-blue-500 mt-3 text-2xl my-auto">
                            <?=$params['user']->getCapital()?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                    <div class="flex">
                        <span class="text-yellow-500 font-semibold"><i class="fas fa-object-group    "></i> REVENU BINAIRE</span>
                    </div>
                    <div class="w-full  rounded-full">
                        <div class="flex">
                            <span class="bg-yellow-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                                <i class="fas fa-dollar-sign "></i>
                            </span>
                            <span class="font-semibold text-yellow-300 mt-3 text-2xl my-auto">
                            <?=$params['user']->getSoldBinary()?>
                            </span>
                            <div class="border rounded-lg border-gray-900 p-2 ml-2 w-auto mt-2 flex h-10 justify-around items-center">
                                <span class="bg-gray-500 grid  text-gray-900 place-items-center w-7 h-7 rounded-full">
                                    <i class="fas fa-dice-two"></i>
                                </span>
                                <span class="font-semibold text-gray-500 mx-2 text-lg">
                                2 personnes
                                </span>
                                <span class="bg-green-500 grid  text-gray-900 place-items-center w-7 h-7 rounded-full">
                                    <i class="fas fa-check-circle rounded-full"></i>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                    <div class="flex">
                        <span class="text-pink-500 font-semibold"><i class="fas fa-users"></i> REVENU DIRECT</span>
                    </div>
                    <div class="w-full  rounded-full">
                        <div class="flex">
                            <span class="bg-pink-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                                <i class="fas fa-dollar-sign "></i>
                            </span>
                            <span class="font-semibold text-pink-500 mt-3 text-2xl my-auto">
                            <?=$params['user']->getSoldParainage()?>
                            </span>
                            <div class="border rounded-lg border-gray-900 p-2 ml-2 w-56 mt-2 flex h-10 justify-around items-center">
                                <span class="bg-gray-500 grid  text-gray-900 place-items-center w-7 h-7 rounded-full">
                                    <i class="fas fa-users"></i>
                                </span>
                                <span class="font-semibold text-gray-500 text-2xl">
                                12 parrainnés
                                </span>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="grid grid-cols-12 space-x-2 p-2">

                <div class="col-span-4 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                    <div class="flex">
                        <span class="text-blue-500 font-semibold"><i class="fas fa-comment-dollar"></i> MONTANT INVESTI</span>
                    </div>
                    <div class="w-full  rounded-full">
                        <div class="flex">
                            <span class="bg-blue-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                                <i class="fas fa-dollar-sign "></i>
                            </span>
                            <span class="font-semibold text-blue-500 mt-3 text-2xl my-auto">
                            <?=$params['user']->getPack()->getAcurracy() ?> % / Jour
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-span-8 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                    <div class="flex">
                        <span class="text-yellow-500 font-semibold"><i class="fas fa-object-group    "></i> REVENU BINAIRE</span>
                    </div>
                    <div class="w-full  rounded-full">
                        <div class="flex">
                            <span class="bg-yellow-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                                <i class="fas fa-dollar-sign "></i>
                            </span>
                            <span class="font-semibold text-yellow-300 mt-3 text-2xl my-auto">
                            <?=$params['user']->getPack()->getAcurracy() ?>
                            </span>
                            <div class="border rounded-lg border-gray-900 p-2 ml-2 w-auto mt-2 flex h-10 justify-around items-center">
                                <span class="bg-gray-500 grid  text-gray-900 place-items-center w-7 h-7 rounded-full">
                                    <i class="fas fa-dice-two"></i>
                                </span>
                                <span class="font-semibold text-gray-500 mx-2 text-lg">
                                2 personnes
                                </span>
                                <span class="bg-green-500 grid  text-gray-900 place-items-center w-7 h-7 rounded-full">
                                    <i class="fas fa-check-circle rounded-full"></i>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

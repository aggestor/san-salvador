<?php
$images = explode("AND", $params['user']->getPhoto());
?>

<div class="col-span-12 overflow-x-hidden  primary_bg">

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
                <span><?= $params['user']->getBonusToPercent() == 100 ? "300" : $params['user']->getBonusToPercent() ?>%</span>
                <span class="text-green-500">300%</span>
            </div>
        </div>
    </div>
    <div class="w-full mt-4 grid grid-cols-12">
        <div class="col-span-2 relative hidden lg:block ml-1 h-screen-customer rounded border border-gray-800 primary_bg_">
            <div data-path-user="/user/dashboard" class="flex p-2 my-2 from-green-500 to-gray-900 text-white transition-all duration-500   cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
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
            <div data-path-user="/user/history" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-history"></i></span>
                    <span class="w-10/12 mt-0.5">Historique de retrait</span>
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
                <span class="text-center">Usalvagetrade &#169; <span id="year"></span></span>
            </div>
        </div>
        <div class="lg:col-span-10 col-span-12 h-screen-customer scroll lg:overflow-y-auto lg:overflow-x-hidden flex flex-col lg:p-3">
            <div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <?php if(isset($params['message']) AND $params['message'] != 1): ?>
        <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Toutes les inscriptions en attente.</h1>
            <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center"><?= count($params['nonAllInscription']) ?></span>
        </div>
        <div class="w-11/12 mx-auto p-3 text-gray-300  mt-6 mb-3 border border-gray-700 primary_bg_ flex justify-between rounded">
            <div class="w-1/12">Noms</div>
            <div class="w-2/12">Email</div>
            <div class="w-1/12">Téléphone</div>
            <div class="w-1/12">Montant</div>
            <div class="w-1/12">Origine</div>
            <div class="w-2/12">Référence</div>
            <div class="w-1/12">Action</div>
        </div>
        <?php foreach ($params['allInscription'] as $data) : ?>
            <div class="w-11/12 mx-auto p-1 items-center text-gray-500  my-2 border border-gray-500 flex justify-between rounded">
                <div class="w-1/12"><?= $data->getUser()->getName() ?></div>
                <div class="w-2/12"><?= $data->getUser()->getEmail() ?></div>
                <div class="w-1/12"><?= str_replace("/", "", $data->getUser()->getPhone()) ?></div>
                <div class="w-1/12"><?= $data->getAmount() ?></div>
                <div class="w-1/12"><?= $data->getTransactionOrigi() ?></div>
                <div class="w-2/12"><?= $data->getTransactionCode() ?></div>
                <div>
                    <form method="POST" action="/admin/active/inscription-<?= $data->getId() . "-" . $data->getUser()->getId() ?>"><button class="_green_bg rounded text-gray-800 p-1.5" type="submit">Valider <i class="fas fa-check-circle    "></i></button></form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="col-span-12  primary_bg grid place-items-center">
    <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <h1 class="text-gray-200 text-3xl font-bold">Aucun retrait effectué pour le moment.</h1>
            <p class="text-gray-400 font-semibold text-lg mt-4">Tous les retrait validés seront affichés  sur cette page.</p>
        </div>
        <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
            <span class="w-full h-full justify-center flex items-center text-gray-900">
                <span class='w-40 h-40 bg-gray-500  rounded-full grid place-items-center'><i class="fas fa-dollar-sign fa-5x"></i></span>
            </span>
        </div>
    </div>
</div>
        <?php endif;?>
</div>

        </div>
    </div>
</div>
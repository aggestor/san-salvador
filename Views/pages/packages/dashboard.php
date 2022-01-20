<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Faites toute la gestion de vos packs ici.</h1>
            <div class="flex w-3/12 justify-between">
                <span id="btnShowPackSection" class="primary_bg_ rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-500 hover:bg-opacity-100 flex items-center justify-around cursor-pointer"><i class="fas fa-tv"></i> Afficher</span>
                <span id="btnAddPackSection" class="primary_bg_ rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-500 hover:bg-opacity-100 flex items-center justify-around cursor-pointer"><i class="fas fa-plus-circle"></i> Ajouter</span>
            </div>
        </div>
        <div id="addPackAdminSection" class="w-11/12 mx-auto p-3 border border-gray-700 primary_bg_ flex rounded">
            <?php include(VIEWS."pages/packages/create.php");?>
        </div>
        <div id="showPackAdminSection" class="w-11/12 mx-auto p-3  mt-6 border border-gray-700 primary_bg_ flex rounded">
            <div class="w-full">
                <div class="h-12 w-full flex justify-between">
                    <h1 class="text-gray-300 font-semibold text-xl w-full"> <i class="fas fa-list  mr-3"></i> Liste de tous les pack disponibles.</h1>
                    <span id="closeShowPackAdmin" class="w-7 h-7 cursor-pointer border-gray-500 border rounded grid place-items-center text-gray-500"><i class="fa text-lg fa-times"></i></span>
                </div>
                <div class="w-full flex flex-col p-2">
                    <div class="w-11/12 flex mb-4 font-semibold text-gray-400 mx-auto justify-between h-12 rounded border border-gray-800">
                        <div class="w-2/12 p-2 mt-1">Photo</div>
                        <div class="w-2/12 p-2 mt-1">Nom</div>
                        <div class="w-2/12 p-2 mt-1">Montant min</div>
                        <div class="w-2/12 p-2 mt-1">Montant max</div>
                        <div class="w-2/12 p-2 mt-1">Gain journalier</div>
                    </div>
                    
                    <?php foreach($params["pack"] as $pack) : 
                        $images = explode("AND",$pack->getImage())
                    ?>
                        <div class="w-11/12 my-2 flex font-semibold text-gray-400 mx-auto justify-between h-24 rounded border border-gray-800">
                            <div class="w-2/12 p-1 mt-1"><img src="/assets/img/<?= $images[0] ?>" class="h-20 object-cover rounded w-20" alt=""></div>
                            <div class="w-2/12 p-2 mt-1"><?= $pack->getName()?>$</div>
                            <div class="w-2/12 p-2 mt-1"><?= $pack->getAmountMin()?>$</div>
                            <div class="w-2/12 p-2 mt-1"><?= $pack->getAmountMax()?>$</div>
                            <div class="w-2/12 p-2 mt-1">Gain journalier</div>
                        </div>

                    <?php endforeach ;?>
                </div>
            </div>
        </div>
    </div>
</div>
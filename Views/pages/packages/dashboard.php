<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Faites toute la gestion de vos packs ici.</h1>
            <div class="flex w-3/12 justify-between">
                <span class="primary_bg_ rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-600 flex items-center justify-around cursor-pointer"><i class="fas fa-tv"></i> Afficher</span>
                <span class="primary_bg_ rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-600 flex items-center justify-around cursor-pointer"><i class="fas fa-plus-circle"></i> Ajouter</span>
            </div>
        </div>
        <div id="addPackAdminSection" class="w-11/12 mx-auto p-3 border border-gray-700 primary_bg_ flex rounded">
            <?php include(VIEWS."pages/packages/create.php");?>
        </div>
        <div id="showPackAdminSection" class="w-11/12 mx-auto p-3  mt-6 border border-gray-700 primary_bg_ flex rounded">
            <?php include(VIEWS."pages/packages/view_all.php");?>
        </div>
    </div>
</div>
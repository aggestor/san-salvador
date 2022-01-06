<div class="w-11/12 mx-auto mt-3 flex">
    <div class="w-full flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Gestion de tous les autres administrateurs</h1>
            <div class="flex w-3/12 justify-between">
                <span id="btnShowAdminSection" class="primary_bg_ rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-500 hover:bg-opacity-100 flex items-center justify-around cursor-pointer"><i class="fas fa-tv"></i> Tous</span>
                <span id="btnAddAdminSection" class="primary_bg_ ml-3 rounded text-gray-300 hover:text-gray-900 font-semibold h-10 w-28 p-1 hover:bg-green-500 hover:bg-opacity-100 flex items-center justify-around cursor-pointer"><i class="fas fa-plus-circle"></i> Ajouter</span>
            </div>
        </div>
        <div id="addAdminAdminSection" class="w-11/12 mx-auto p-3 border border-gray-700 primary_bg_ flex rounded">
            <?php include(VIEWS."pages/admin/create.php");?>
        </div>
        <div id="showAdminAdminSection" class="w-11/12 mx-auto p-3  mt-6 border border-gray-700 primary_bg_ flex rounded">
            <?php include(VIEWS."pages/admin/view_all.php");?>
        </div>
    </div>
</div>
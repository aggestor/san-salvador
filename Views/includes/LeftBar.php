<div class="col-span-2 primary_bg_ relative h-screen overflow-y-auto border-gray-800 border-r">
    <div class="title text-gray-300 p-2 font-semibold ">
        <h1 class="ml-2">USALVAGETRADE</h1>
    </div>
    <div id="userMenu" class="flex flex-col">
        <div data-path="/dashboard" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-school"></i></span> 
                <span class="w-10/12 mt-0.5">Dashboard</span>
           </div>
        </div>
        <div data-path="/administrator" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-user-secret"></i></span> 
                <span class="w-10/12 mt-0.5">Administrateurs</span>
           </div>
        </div>
        <div data-path="/users-page-1" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-users"></i></span> 
                <span class="w-10/12 mt-0.5">Utilisateurs</span>
           </div>
        </div>
        <div data-path="/pack" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-box"></i></span> 
                <span class="w-10/12 mt-0.5">Packages</span>
           </div>
        </div>
        <div data-path="/currencies" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-dollar-sign"></i></span> 
                <span class="w-10/12 mt-0.5">Devises</span>
           </div>
        </div>
        <div data-path="/validate/cashout" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-exchange-alt"></i></span> 
                <span class="w-10/12 mt-0.5">Retraits</span>
           </div>
        </div>
        <div data-path="/active/inscription" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
           <div class="w-11/12 mx-auto flex ">
                <span class="w-2/12"><i class="fas fa-check-double  "></i></span> 
                <span class="w-10/12 mt-0.5">Inscriptions</span>
           </div>
        </div>
        <div class="absolute left-3 bottom-2">
            <span class="text-gray-500">Usalvagetrade &#169; <?= date("Y")?></span>
        </div>
    </div>
</div>
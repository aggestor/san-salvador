<div class="w-full flex sticky top-0 justify-between h-14 items-center p-2 border-b border-gray-800">
    <div class="w-2/12 flex justify-between">
        <div class="w-fit rounded text-xl items-center h-11 primary_bg_ p-1 mr-1 text-gray-300 flex my-auto">
            <span class=" ml-2 font-semibold"> <i class="fa fa-clock mr-2"></i> <span id="adminTimer">12:15</span></span>
        </div>
    </div>
    <div class="w-5/12">
        <div class="flex justify-end full">
            <div class="w-3/12 rounded-full transition-all duration-500 h-11 p-1 cursor-pointer text-gray-300 hover:bg-green-500 hover:text-white relative flex my-auto">
                <img src="/assets/logos/user.png" class="w-9 h-9 rounded-full" alt="">
                <span class=" ml-2 font-semibold text-sm mt-2 3w"><?= $_SESSION['admin']->getName() ?></span>
                <span class="w-3 h-3 absolute left-7 top-8 _green_bg rounded-full"></span>
            </div>
            <div class="w-9 ml-1 rounded-full transition-all duration-500 h-9 grid place-items-center cursor-pointer text-gray-300 hover:bg-green-500 hover:text-white my-auto">
                <a class="" href="/admin/destroy"> <i class="fas fa-power-off"></i></a>
            </div>
        </div>
    </div>
</div>
<?php //var_dump($params['nonValidate']); exit(); 
?>
<div class="w-full grid grid-cols-12 px-12 py-5 overflow-y-auto">
    <div class="col-span-12 flex overflow-x-auto flex-nowrap hide-scroll-bar justify-between h-10 border-b border-gray-800">
        <h1 class="text-gray-300 font-semibold  text-lg"> <i class="fas fa-tv mr-2 "></i> Dashboard administration</h1>
    </div>

    <div class="lg:col-span-12 col-span-12 h-screen-customer scroll lg:overflow-y-auto lg:overflow-x-hidden flex flex-col lg:p-0">
        <div class="grid lg:grid-cols-12 grid-cols-1 lg:space-x-2 p-2">
            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-blue-500 font-semibold"><i class="fas fa-comment-dollar"></i> TOUS LES BONUS DE PARRAINAGE</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-blue-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-blue-500 mt-3 text-2xl my-auto">
                            <?php echo $params['parainnage']; ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-yellow-500 font-semibold"><i class="fas fa-comment-dollar"></i> TOUS LES BONUS JOURNALIERS</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-yellow-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-yellow-300 mt-3 text-2xl my-auto">
                            <?php echo $params['invest'] ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-pink-500 font-semibold"><i class="fas fa-comment-dollar"></i> TOUS LES BONUS BINAIRE</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-pink-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-pink-500 mt-3 text-2xl my-auto">
                            <?php echo $params['binaire'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 grid-cols-1 lg:space-x-2 p-2">
            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-blue-500 font-semibold"><i class="fas fa-comment-dollar"></i> SURPLUS</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-blue-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-blue-500 mt-3 text-2xl my-auto">
                            <?php echo $params['surplus'] ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-yellow-500 font-semibold"><i class="fas fa-comment-dollar"></i> RETRAITS DEJA EFFECTUE</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-yellow-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-yellow-300 mt-3 text-2xl my-auto">
                            <?= "0" ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-1 primary_bg_  p-4 mt-6 h-36 rounded-xl shadow">
                <div class="flex">
                    <span class="text-pink-500 font-semibold"><i class="fas fa-comment-dollar"></i> RETRAITS NON VALIDE</span>
                </div>
                <div class="w-full  rounded-full">
                    <div class="flex">
                        <span class="bg-pink-500 grid mt-3 mr-4 text-gray-900 place-items-center w-8 h-8 rounded-full">
                            <i class="fas fa-dollar-sign "></i>
                        </span>
                        <span class="font-semibold text-pink-500 mt-3 text-2xl my-auto">
                            <?php echo $params['cashoutNotValidate'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
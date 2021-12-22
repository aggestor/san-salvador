<div class="col-span-12 h-screen primary_bg ">
    <div class="w-full h-20 flex  flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a>
            <h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 w-10/12 font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 lg:w-9/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <form method="POST" class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <div class="md:w-9/12 w-11/12 mx-auto lg:w-full ">
                <h2 class="text-gray-400 font-semibold text-xl lg:ml-4 my-4 text-left"> Souscrire à un pack !</h2>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="packMount1" name="mount_invested" type="text" placeholder="Montant investi" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['subscribe']) && !empty($params['errors']['mount_invested'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['mount_invested']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="mail" name="source" type="text" placeholder="Source de transaction" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['subscribe']) && !empty($params['errors']['source'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['source']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="mail" name="ref" type="text" placeholder="Reference" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['subscribe']) && !empty($params['errors']['ref'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['ref']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="subscribe" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-check-circle    "></i> Souscrire</button>
            </div>
        </form>
        <div class="lg:w-6/12 hidden lg:flex overflow-hidden items-center justify-center">
            <img src="/assets/logos/admin.png" class="object-cover h-72" alt="Green Admin illustration">
        </div>
    </div>
    <div class="md:w-6/12 w-11/12 md:p-0 p-3  mx-auto mt-12 flex flex-col md:flex-row justify-between">
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/politics">Politiques</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/terms">Conditions d'utilisations</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contracts">Contracts</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/help">Aide</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contact">Contact</a>
    </div>
</div>

<?php

mkdir("./assets/test");

?>
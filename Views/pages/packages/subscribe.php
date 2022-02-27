<div class="col-span-12 h-screen primary_bg ">
    <div class="w-full h-20 flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a>
            <a href="/" class=" cursor-pointer"><h1 class="text-gray-300 hover:text-green-500 font-bold text-xl text-left mx-a">USALVAGETRADE</h1></a>
        </div>
        <h2 class="text-gray-400 w-10/12 font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 lg:w-9/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <form method="POST" class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <div class="md:w-9/12 w-11/12 mx-auto lg:w-full ">
                <h2 class="text-gray-400 font-semibold text-xl lg:ml-4 my-4 text-left"> Souscrivez à un de nos pack en remplissant ce formulaire !</h2>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold overflow-hidden text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-56 px-2 flex flex-col rounded border  <?=$data = (isset($_POST['subscribe']) && !empty($params['errors']['source'])) ? "border-red-500" : " border-gray-400"?>">
                    <label for="source" class="my-1">Source de transaction</label>
                    <div class="w-full bg-gray-900 rounded flex justify-between h-8">
                        <div data-trans-type="btc"  class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white rounded-l transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center text-gray-300">Bitcoin</div>
                        <div data-trans-type="am" class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white  cursor-pointer transition-all duration-150 justify-center font-semibold text-center flex items-center text-gray-300">Airtel money</div>
                        <div data-trans-type="mps" class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white rounded-r transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center text-gray-300">M-Pesa</div>
                    </div>
                    <div id="transactionDataContainer" class="w-full  text-center mx-1 h-36">
                            <p id="defaultTransactionData" class="my-auto h-36 text-gray-400 flex justify-center items-center flex-col">
                                <i class="fas fa-info-circle  fa-2x  "></i>
                                <span>Vous n'avez pas encore choisi la source de votre transaction !</span>
                            </p>
                            <div style="display: none;" id="BTCTransactionData" class=" mr-2 h-36 justify-center flex-col flex">
                                <p class="text-gray-500 w-full overflow-hidden my-1 text-sm">Envoyez l'argent au Porte-feuille BTC suivant : <span class="font-semibold text-sm text-gray-200">bc1qrrlu8djcwjzjpyqwwphww3d28n09n4yvenyr40</span> </p>
                                <div class="w-10/12 mx-auto flex space-x-2 justify-between">
                                    <span id="showBTCGraph" class="bg-blue-600 rounded w-5/12 text-sm p-1 mt-5 cursor-pointer hover:bg-blue-800 text-white">Cours d'action BTC</span>
                                    <span id="copyBTC" data-addr="bc1qrrlu8djcwjzjpyqwwphww3d28n09n4yvenyr40" class="primary_bg_ border-gray-800 border rounded w-5/12 text-sm p-1 mt-5 cursor-pointer hover:bg-blue-800 text-white">Copier l'addresse</span>
                                </div>
                            </div>
                            <div style="display: none;" id="btcGraph" class="w-full text-center grid place-items-center text-xs mx-1 h-36">

                            </div>
                            <div style="display: none;" id="MPSTransactionData" class="my-auto h-36 justify-center flex flex-col">
                                <p class="text-gray-500 text-center my-2">Envoyez votre argent sur M-Pesa au numéro ci-bas.</p>
                                <span  class="font-semibold text-gray-200 text-2xl">02366490</span>
                                <span id="copyMPS" data-num="02366490" class="primary_bg_ border-gray-800 border rounded mx-auto w-5/12 text-sm p-1 mt-5 cursor-pointer hover:bg-blue-800 text-white">Copier le numéro</span>

                            </div>
                            <div style="display: none;" id="AMTransactionData" class="my-auto h-36 flex justify-center flex-col">
                                <p class="text-gray-500 text-center my-2">Envoyez votre argent sur AirtelMoney au numéro ci-bas.</p>
                                <span class="font-semibold text-gray-200 text-2xl">0990 135 518</span>
                                <span id="copyAM" data-num="0990135518" class="primary_bg_ border-gray-800 border rounded mx-auto w-5/12 text-sm p-1 mt-5 cursor-pointer hover:bg-blue-800 text-white">Copier le numéro</span>
                            </div>
                    </div>
                </div>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
            <?php if (isset($_POST['subscribe']) && !empty($params['errors']['source'])): ?>
                    <span class="mb-2 text-red-500 text-xs"><?php echo $params['errors']['source']; ?></span>
                <?php endif;?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  <?=$data = (isset($_POST['subscribe']) && !empty($params['errors']['mount_invested'])) ? "border-red-500" : " border-gray-400"?>">
                    <input id="packMount1" name="mount_invested" type="text" placeholder="Montant investi" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['subscribe']) && empty($params['errors']['mount_invested'])) ? $_POST['mount_invested'] : ""; ?>" />
                </div>
                <?php if (isset($_POST['subscribe']) && !empty($params['errors']['mount_invested'])): ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['mount_invested']; ?></span>
                <?php endif;?>
            </div>

            <input id="source" name="source" type="text" hidden class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['subscribe']) && empty($params['errors']['source'])) ? $_POST['source'] : ""; ?>" />
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  <?=$data = (isset($_POST['subscribe']) && !empty($params['errors']['ref'])) ? "border-red-500" : " border-gray-400"?>">
                    <input id="mail" name="ref" type="text" placeholder="Reference" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['subscribe']) && empty($params['errors']['ref'])) ? $_POST['ref'] : ""; ?>" />
                </div>
                <?php if (isset($_POST['subscribe']) && !empty($params['errors']['ref'])): ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['ref']; ?></span>
                <?php endif;?>
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
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/security">Sécurité</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/terms">Conditions d'utilisations</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/help">Aide</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contact">Contact</a>
    </div>
</div>

<?php

//mkdir("./assets/test");

?>
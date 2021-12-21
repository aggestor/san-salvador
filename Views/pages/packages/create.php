<!-- -nom 
-photo
-montant_max
-montant_min
-taux_interet -->
<div class="w-full">
    <div class="h-12 flex justify-between">
        <h1 class="text-gray-300 font-semibold text-xl w-full"> <i class="fas fa-2x fa-box-open    "></i> Compléter ce formulaire pour créer un nouveau pack.</h1>
        <span class="w-7 h-7 cursor-pointer border-gray-500 border rounded grid place-items-center text-gray-500"><i class="fa text-lg fa-times"></i></span>
    </div>
    <form method="POST" enctype="multipart/form-data" class="w-10/12 mx-auto items-center flex h-72">
        <div class="w-5/12 flex justify-center">
            <div id="imageHolder" class="h-52 w-52 grid cursor-pointer text-gray-400 hover:border-green-500 hover:text-green-500 place-items-center border rounded border-gray-400">
                <div class="flex flex-col  overflow-hidden">
                    <i class="fas fa-2x fa-camera mx-auto"></i>
                    <span>Image du pack</span>
                </div>
            </div>
        </div>
        <div class="w-7/12 flex flex-col p-3">
            <div class="md:w-11/12 mx-auto w-full mb-2">
                <div class="md:w-9/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data =  (isset($_POST['create_pack']) && !empty($params['errors']['pack_name'])) ?"border-red-500" : " border-gray-400" ?>">
                    <input id="currency" name="pack_name" type="text" placeholder="Nom du pack" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                </div>
                <?php if (isset($_POST['create_pack']) && !empty($params['errors']['pack_name'])): ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['pack_name']; ?></span>
                <?php endif;?>
            </div>
            <div class="md:w-11/12 mx-auto w-full mb-2">
                <div class="md:w-9/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data =  (isset($_POST['create_pack']) && !empty($params['errors']['pack_currency'])) ?"border-red-500" : " border-gray-400" ?>">
                    <input id="currency" name="pack_currency" type="text" placeholder="Taux du pack" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                </div>
                <?php if (isset($_POST['create_pack']) && !empty($params['errors']['pack_currency'])): ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['pack_currency']; ?></span>
                <?php endif;?>
            </div>
            <div class="md:w-11/12 md:flex w-full md:justify-between mb-2 mx-auto">
                <div class="md:w-1/2 w-full md:mt-0 mt-1 mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  <?= $data =  (isset($_POST['create_pack']) && !empty($params['errors']['pack_min_value'])) ?"border-red-500" : " border-gray-400" ?>">
                        <input id="minValue" name="pack_min_value" type="email" placeholder="Valeur minimale" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                    </div>
                    <?php if (isset($_POST['create_pack']) && !empty($params['errors']['pack_min_value'])): ?>
                        <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['pack_min_value']; ?></span>
                    <?php endif;?>
                </div>
                <div class="md:w-1/2 w-full md:mt-0 mt-1 mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data =  (isset($_POST['create_pack']) && !empty($params['errors']['pack_max_value'])) ?"border-red-500" : " border-gray-400" ?>">
                        <input id="maxValue" name="pack_max_value" type="text" placeholder="Valeur minimale" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                    </div>
                    <?php if (isset($_POST['create_pack']) && !empty($params['errors']['pack_max_value'])): ?>
                        <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['pack_max_value']; ?></span>
                    <?php endif;?>
                </div>
                <input type="file" name="pack_image" class="hidden" id="packImageUploader">
            </div>
            <div class="md:w-11/12 my-4 mx-auto">
                <button type="submit" name="create_pack" class="_green_bg w-9/12 hover:bg-green-500 text-gray-900 p-2 h-10 font-semibold rounded"><i class="fas fa-plus-circle mr-1"></i> Créer un pack avec des infos</button>
            </div>
        </div>
    </form>
        <p class="text-gray-400 w-8/12"><b>Note:</b> <em>En créant ce pack, vous confirmer connaitre l'impacte qu'il aura sur le système et que cadre de  USALVAGETRADE est d'accord avec cet acte, mais vous serez enregistré(e) étant l'auteur.</em></p>

</div>
<div class="col-span-12 h-screen primary_bg flex flex-col">
    <div class="w-full h-20 flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a>
            <a href="/" class=" cursor-pointer"><h1 class="text-gray-300 hover:text-green-500 font-bold text-xl text-left mx-a">USALVAGETRADE</h1></a>
        </div>
        <h2 class="text-gray-400 w-10/12 font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 mt-12 border border-gray-900 mx-auto primary_bg shadow rounded md:p-12 p-6">
        <div class="md:w-9/12 w-11/12 mx-auto ">
            <div class="w-full md:hidden mx-auto grid place-items-center">
                <span class="w-24 h-24 rounded-full bg-gray-300 grid place-items-center"><i class="fas fa-3x text-gray-900 fa-key"></i></span>
            </div>
            <h2 class="text-gray-400 font-semibold text-base my-4 text-left"> Entrer votre addresse mail dans le champs ci-bas pour reinitialiser votre mot de passe</h2>
        </div>

        <form method="POST" class="md:w-10/12 w-11/12  mx-auto md:p-3">
            <div class="md:w-11/12 w-full mx-auto">
                <div class="mx-auto focus-within:font-semibold <?= $data =  (isset($_POST['submit']) && !empty($params['errors']['user_email'])) ?"border-red-500" : " border-gray-400" ?> text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="mail" type="email" name="user_email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                </div>
                <?php if (isset($_POST['submit']) && !empty($params['errors']['user_email'])): ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['user_email']; ?></span>
                <?php endif;?>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="submit" class="bg-green-500 text-gray-900 p-2 w-full h-10 rounded"> <i class="fas fa-check-circle    "></i> Reinitialiser mot de passe</button>
            </div>
        </form>
    </div>
        <div class="md:w-6/12 w-11/12 md:p-0 p-3  mx-auto mt-12 flex flex-col md:flex-row justify-between">
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/terms">Conditions d'utilisations</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/security">Sécurité</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/help">Aide</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contact">Contacts</a>
    </div>
</div>
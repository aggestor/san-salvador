<div class="col-span-12 h-screen primary_bg ">
    <div class="w-full h-20 flex  flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a>
            <h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 md:w-10/12 w-full mx-auto font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 flex flex-col justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg shadow rounded md:p-12 p-4">
        <div class="md:w-9/12 w-11/12 mx-auto ">
            <h2 class="text-gray-400 font-semibold text-xl my-4 text-left"> Connectez-vous sur votre compte</h2>
        </div>
        <form method="POST" class="md:w-10/12 w-11/12  mx-auto md:p-3">
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 <?= $data =  (isset($_POST['connexion']) && !empty($params['errors']['user_email'])) ?"border-red-500" : " border-gray-400" ?> focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border">
                    <input id="identifier" name="user_email" type="email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['connexion']) && empty($params['errors']['user_email'])) ? $_POST['user_email'] : ""; ?>" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['user_email'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['user_email']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold <?= $data =  (isset($_POST['connexion']) && !empty($params['errors']['password'])) ?"border-red-500" : " border-gray-400" ?> text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border">
                    <input id="password" name="password" type="password" placeholder="Mot de passe" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['password'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['password']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 flex justify-between mt-5 mx-auto">
                <div class="w-6/12 flex text-gray-500 justify-left">
                    <input class="w-4 h-4 mx-2" type="checkbox" name="remember" id="remember">
                    <label class="text-sm" for="remember">Se souvenir de moi</label>
                </div>
                <div class="w-6/12 text-gray-500">
                    <span class="flex justify-end font-semibold"><a class="text-sm" href="/reset-password">Mot de passe oublié ?</a></span>
                </div>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="connexion" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-lock"></i> Connexion</button>
            </div>
            <div class="md:w-11/12 flex text-gray-500 justify-between mt-5 mx-auto">
                <span class="flex justify-end">Pas encore inscrit(e) ? <a class="font-semibold" href="/register"> &#160; Créer un compte</a></span>
            </div>
        </form>
    </div>
    <div class="md:w-6/12 w-11/12 md:p-0 p-3  mx-auto mt-12 flex flex-col md:flex-row justify-between">
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/politics">Politiques</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/terms">Conditions d'utilisations</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contracts">Contracts</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/help">Aide</a>
        <a class="text-gray-500 font-semibold hover:text-green-500" href="/contact">Contact</a>
    </div>
</div>
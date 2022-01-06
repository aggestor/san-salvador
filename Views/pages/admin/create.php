<!-- <div class="col-span-12 h-96">
    <div class="md:w-6/12 w-11/12 lg:w-full flex flex-col lg:flex-row justify-center items-center border-gray-900 mx-auto shadow rounded md:p-12 lg:p-0 p-4">
        <form method="POST" class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="name" name="username" type="text" placeholder="Noms" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['userEmail'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['userEmail']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-2">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="mail" name="user_email" type="email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['userEmail'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['userEmail']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="connexion" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-lock"></i> Connexion</button>
            </div>
        </form>
        <div class="lg:w-6/12 hidden lg:flex overflow-hidden items-center justify-center">
            <img src="/assets/logos/admin.png" class="object-cover h-72" alt="Green Admin illustration">
        </div>
    </div>
</div> -->
<div class="w-full h-96 p-2">
    <div class="h-12 w-full flex justify-between">
        <h1 class="text-gray-300 font-semibold text-xl w-full"> <i class="fas fa-user-secret  mr-3"></i> Ajouter un administrateur</h1>
    </div>
    <div class="w-full h-full flex justify-between">
        <form class="w-6/12 mt-12" method="POST">
            <div class="md:w-11/12 w-full mx-auto mb-4">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="name" name="username" type="text" placeholder="Noms" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['userEmail'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['userEmail']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 w-full mx-auto mb-4">
                <div class=" mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="mail" name="user_email" type="email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="" />
                </div>
                <?php if (isset($_POST['connexion']) && !empty($params['errors']['userEmail'])) : ?>
                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['userEmail']; ?></span>
                <?php endif; ?>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="sendAdminMail" class="_green_bg text-gray-900 p-2 w-full h-10 rounded">Envoyer le mail <i class="fas ml-1 fa-paper-plane    "></i></button>
            </div>
            <div class="md:w-11/12 text-gray-400 mx-auto mt-4">
                <p><b>Note : </b> La suite de l'inscription sera fait par l'admin lui meme apres confimation de son mai.</p>
            </div>
        </form>
        <div class="w-6/12 h-full flex justify-center overflow-hidden">
            <img src="/assets/logos/admin.png" class="h-72 mb-4" alt="Admin Image illustration">
        </div>
    </div>
</div>
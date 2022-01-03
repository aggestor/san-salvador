<div class="col-span-12 h-screen">
    <div class="md:w-6/12 lg:w-9/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <form method="POST" class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <div class="md:w-9/12 w-11/12 mx-auto lg:w-full ">
                <h2 class="text-gray-400 font-semibold text-xl lg:ml-4 my-4 text-left"> Ajouter un nouveau administrateur !</h2>
            </div>
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
</div>
<div class="col-span-12 primary_bg">
    <div class="w-full h-20 flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a>
            <h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 md:w-10/12 w-full mx-auto font-semibold text-base pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="flex flex-col md:flex-row md:w-10/12 w-full my-3 rounded overflow-hidden h-auto border border-gray-900 mx-auto md:justify-around justify-center">
        <div class="md:w-6/12 grid place-items-center md:p-0 p-4 primary_bg">
            <div class="w-full flex justify-center flex-col primary_bg">
                <div class="md:w-10/12 w-11/12 mx-auto ">
                    <div id="userIcon" class="w-full md:hidden h-48 mx-auto grid place-items-center">
                        <i class="fas fa-7x text-gray-400 fa-user-circle"></i>
                    </div>
                    <h2 id="register-title" class="text-gray-500 font-semibold text-base my-4 text-left">Remplissez ce formulaire ci-bas pour vous inscrire sur notre plateforme !</h2>
                </div>
                <form method="POST" class="md:w-11/12 w-full  mx-auto" enctype="multipart/form-data">
                    <!--FORM PART 1-->
                    <div class="w-full form-1 flex flex-col mx-auto p-3">
                        <!--USERNAME BEGIN-->
                        <div class="md:w-11/12 mx-auto w-full mb-2">
                            <div class="md:w-8/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data = (isset($_POST['enregistrer']) && !empty($params['errors']['username'])) ?"border-red-500" : " border-gray-400" ?>">
                                <input id="username" name="username" type="text" placeholder="Nom d'utilisateur" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['enregistrer']) && empty($params['errors']['username'])) ? $_POST['username']:"";?>" />
                            </div>
                            <?php if (isset($_POST['enregistrer']) && !empty($params['errors']['username'])): ?>
                                <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['username']; ?></span>
                            <?php endif;?>
                        </div>
                        <!--USERNAME END-->
                        <div class="md:w-11/12 md:flex w-full md:justify-between mb-2 mx-auto">
                            <!--EMAIL BEGIN-->
                            <div class="md:w-1/2 w-full md:mt-0 mt-1 mr-1">
                                <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  <?= $data =(isset($_POST['enregistrer']) && !empty($params['errors']['user_email'])) ?"border-red-500" : " border-gray-400" ?>">
                                    <input id="userEmail" name="user_email" type="email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['enregistrer']) && empty($params['errors']['user_email'])) ? $_POST['user_email'] : "";?>" />
                                </div>
                                <?php if (isset($_POST['enregistrer']) && !empty($params['errors']['user_email'])): ?>
                                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['user_email']; ?></span>
                                <?php endif;?>
                            </div>
                            <!--EMAIL END-->

                            <!--PHONE NUMBER BEGIN-->
                            <div class="md:w-1/2 w-full md:mt-0 mt-1 mr-1">
                                <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data = (isset($_POST['enregistrer']) && !empty($params['errors']['phone_number'])) ?"border-red-500" : " border-gray-400" ?>">
                                    <input id="PhoneNumber" name="phone_number" type="text" placeholder="Numéro de téléphone" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['enregistrer']) && empty($params['errors']['phone_number'])) ? $_POST['phone_number'] : "";?>" />
                                </div>
                                <?php if (isset($_POST['enregistrer']) && !empty($params['errors']['phone_number'])): ?>
                                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['phone_number']; ?></span>
                                <?php endif;?>
                            </div>
                            <!--PHONE NUMBER END-->
                        </div>
                        <!--PASSWORD BEGIN-->
                        <div class="md:w-11/12 mx-auto w-full mb-2">
                            <div class="md:w-8/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data =  (isset($_POST['enregistrer']) && !empty($params['errors']['password'])) ?"border-red-500" : " border-gray-400" ?>">
                                <input id="password" name="password" type="text" placeholder="Mot de passe" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                            </div>
                            <?php if (isset($_POST['enregistrer']) && !empty($params['errors']['password'])): ?>
                                <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['password']; ?></span>
                            <?php endif;?>
                        </div>
                        <!--PASSWORD END-->
                        <!--PASSWORD BEGIN-->
                        <div class="md:w-11/12 mx-auto w-full mb-2">
                            <div class="md:w-8/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data =  (isset($_POST['enregistrer']) && !empty($params['errors']['confirm_password'])) ?"border-red-500" : " border-gray-400" ?>">
                                <input id="confirmPassword" name="confirm_password" type="text" placeholder="Confirmer mot de passe" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                            </div>
                            <?php if (isset($_POST['enregistrer']) && !empty($params['errors']['confirm_password'])): ?>
                                <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['confirm_password']; ?></span>
                            <?php endif;?>
                        </div>
                        <!--PASSWORD END-->
                        <div class="md:w-11/12 flex justify-between mt-3 mx-auto">
                            <div class="lg:w-9/12 text-gray-500 text-sm">
                                Avant de cliquer sur <i>Suivant</i>, rassurez-vous d'avoir bien rempli le formulaire ce-dessus.
                            </div>
                        </div>
                        <div class="md:w-11/12 w-full mx-auto mt-4">
                            <button name="2" type="button" class="_green_bg form-user-btn text-gray-900 p-2 md:w-9/12 w-full h-10 rounded"><i class="fas fa-arrow-down"></i> Suivant</button>
                        </div>
                        <div class="md:w-11/12 mx-auto ">
                            <span class="flex ml-1 text-gray-400">Déjà inscrit(e)? &#160;<a class="hover:text-green-500 font-semibold" href="/login">Se connecter</a></span>
                        </div>
                    </div>
                    <!---FORM PART 2-->
                    <div class="w-full form-2 hidden flex-col mx-auto p-3">
                        <div>
                            <div style="display:none" class=" w-full grid place-items-center" id="crop"></div>
                            <div class="w-16 h-16 rounded-full _green_bg cursor-pointer grid place-items-center mx-auto" id="camera"> <i class="fas fa-2x mx-auto fa-camera    "></i></div>
                        </div>
                        <div class="md:w-11/12  flex justify-between mt-3 mx-auto">
                            <div class="lg:w-9/12 text-gray-500 text-sm">
                                <b>Note : </b> En cliquant sur  <i>Enregistrer</i>, vous acceptez nos conditions d'utilisations et notre politique de confidentialités.
                            </div>
                        </div>
                        <div class="md:w-11/12 w-full flex justify-between mx-auto mt-4">
                            <button type="submit" name="enregistrer" class="_green_bg  text-gray-900 p-2 w-5/12 h-10 rounded"><i class="fas fa-save"></i> Enregistrer</button>
                            <button name="-2" type="button" class="_green_bg form-user-btn text-gray-900 p-2 w-5/12 h-10 rounded"><i class="fas fa-arrow-up"></i> Retour</button>
                        </div>
                    </div>
                    <input type="file" id="imageToCrop" class="hidden">
                    <input type="file" id="image" name="image" class="hidden">

                </form>
                <!--FORM END-->
            </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="1500" class="md:w-6/12 w-full overflow-x-hidden md:flex hidden justify-center">
            <img src="assets/logos/add-user.png" style="height: 500px;" alt="Joining image" />
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
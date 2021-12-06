<div class="col-span-12 primary_bg">
    <div class="w-full h-20 flex  flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="javascript:history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a><h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 w-10/12 mx-auto font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="flex flex-col md:flex-row md:w-11/12 w-full my-3 rounded overflow-hidden h-auto border border-gray-900 mx-auto md:justify-around justify-center">
    <div class="md:w-6/12 md:p-0 p-4 primary_bg">
    <div class="w-full flex justify-center flex-col primary_bg">
        <div class="md:w-10/12 w-11/12 mx-auto ">
            <div class="w-full md:hidden h-48 mx-auto grid place-items-center">
                <i class="fas fa-7x text-gray-400 fa-user-circle"></i>
            </div>
            <h2 class="text-gray-500 font-semibold text-base my-4 text-left">Remplissez ce formulaire ci-bas pour vous inscrire sur notre plateforme !</h2>
        </div>
        <form method="POST" action="/sign_in" class="md:w-11/12 w-full  mx-auto p-3">
            <!--USERNAME BEGIN-->
            <div class="md:w-11/12 mx-auto w-full mb-2">
                <div class="md:w-8/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="username" type="text" placeholder="Nom d'utilisateur" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                </div>
                <?php
                    if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["userName"])) { ?>
                        <span class="-mt-2 text-red-500 text-xs"><?= $_SESSION["message"]["userName"]?></span>
                   <?php }
                ?>
            </div>
            <!--USERNAME END-->
            <div class="md:w-11/12 md:flex md:justify-between mb-2 mx-auto">
                <!--EMAIL BEGIN-->
                <div class="md:w-1/2 w-full mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                        <input id="userEmail" name="userEmail" type="email" placeholder="Addresse mail" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                    </div>
                    <?php
                        if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["userEmail"])) { ?>
                        <span class="-mt-2 text-gray-500 text-xs"><?=$_SESSION["message"]["userEmail"]?></span>
                    <?php } ?>
                </div>
                <!--EMAIL END-->

                <!--PHONE NUMBER BEGIN-->
                <div class="md:w-1/2 w-full mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                        <input id="PhoneNumber" name="PhoneNumber" type="text" placeholder="Numéro de téléphone" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                    </div>
                    <?php
                        if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["PhoneNumber"])) { ?>
                            <span class="-mt-2 text-gray-500 text-xs"><?= $_SESSION["message"]["PhoneNumber"]?></span>
                       <?php } ?>
                </div>
                <!--PHONE NUMBER END-->
            </div>

            <!--PASSWORDS BEGIN-->
            <div class="md:w-11/12 md:flex md:justify-between mb-2 mx-auto">
                <div class="md:w-1/2 w-full mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                        <input id="password" name="Password" type="password" placeholder="Mot de passe" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                    </div>
                    <?php
                        if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["PhoneNumber"])) {?>
                            <span class="-mt-2 text-red-500 text-xs"><?=$_SESSION["message"]["Password"]?></span>
                       <?php }?>
                </div>
                <div class="md:w-1/2 w-full mr-1">
                    <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                        <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirmer mot de passe" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                    </div>
                    <?php
                        if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["PhoneNumber"])) {?>
                            <span class="-mt-2 text-red-500 text-xs"><?=$_SESSION["message"]["Password"]?></span>
                       <?php }?>
                </div>
            </div>
            <!--PASSWORD END-->

            <!--SPONSOR BEGIN-->
            <div class="md:w-11/12 mx-auto w-full mb-2">
                <div class="md:w-8/12 w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                    <input id="sponsor" readonly type="text" placeholder="Sponsor" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on"/>
                </div>
                <span class="-mt-2 text-gray-500 text-xs">Le champ ci-haut est obligatoire !</span>
            </div>
            <!--SPONSOR END-->
            <!--PARING SIDE BEGIN-->
            <div class="md:w-8/12 h-24 p-2 mx-auto md:ml-5 border border-gray-400 rounded-lg h-10">
               <span class="text-gray-400">Coté de parainnage</span>
               <div class="w-full flex mt-3 justify-between">
                   <span data-side="left" class="p-1 flex text-gray-400 cursor-pointer side- border rounded border-gray-400"> <i class="fas mr-2 mt-1 fa-circle    "></i> Gauche</span>
                   <span data-side="right" class="p-1 flex text-gray-400 cursor-pointer side border rounded border-gray-400"> <i class="fas mr-2 mt-1 fa-circle    "></i> Droit</span>
               </div>
            </div>
            <!--PARING SIDE END-->
            <div class="md:w-11/12 flex justify-between mt-3 mx-auto">
                <div class="w-full text-gray-500 text-sm">
                    En cliquant sur <i>Enregistrer</i>, vous acceptez nos <a class="hover:text-green-500 font-semibold" href="/terms">conditions générales d'utilisation</a> nos <a class="hover:text-green-500 font-semibold" href="/politics"> politiques de fonctionnements et de confidentialités </a>.
                </div>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="enregistrer" class="_green_bg text-gray-900 p-2 md:w-9/12 w-full h-10 rounded"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
            <div class="md:w-11/12 mx-auto ">
                <span class="flex ml-1 text-gray-400">Déjà inscrit(e)? &#160;<a class="hover:text-green-500 font-semibold" href="/login">Se connecter</a></span>
            </div>
        </form>
    </div>
</div>
    <div data-aos="fade-down"
    data-aos-duration="1500" class="md:w-6/12 w-full overflow-x-hidden md:flex hidden justify-center">
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
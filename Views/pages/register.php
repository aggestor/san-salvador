<div class="col-span-12 primary_bg">
    <div class="flex flex-col md:flex-row md:w-11/12 w-full md:h-screen h-auto md:items-center mx-auto md:justify-around justify-center">
    
    <div class="md:w-6/12 md:p-0 p-4 primary_bg">
    <div class="w-full flex justify-center flex-col primary_bg">
        <div class="md:w-10/12 w-11/12 mx-auto ">
            <h1 class="_green_text font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
            <h2 class="text-gray-400 font-semibold text-xl my-4 text-left">Bienvenu(e) sur universal salvage trade</h2>
            <div class="w-full md:hidden h-48 mx-auto grid place-items-center">
                <i class="fas fa-7x text-gray-400 fa-user-circle"></i>
            </div>
            <h2 class="text-gray-500 font-semibold text-base my-4 text-left">Remplissez ce formulaire ci-bas pour vous inscrire sur notre plateforme !</h2>
        </div>
<!--mine-->
        <form method="POST" action="/register" class="w-10/12  mx-auto p-3">
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="userName" id="username" placeholder="Nom d'utilisateur" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none" value="<?php if (isset($_POST['enregister']) && empty($_SESSION["message"]["userName"])) {
                                                                                                                                                                                                echo $_POST['userName'];
                                                                                                                                                                                            } ?>">
            </div>
            <span class="-mt-2 text-red-500 text-xs ml-7 mb-3 w-11/12">
                <?php
                if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["userName"])) {
                    echo $_SESSION["message"]["userName"];
                }
                ?>
            </span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="userEmail" id="email" placeholder="Addresse mail" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none" value="<?php if (isset($_POST['enregister']) && empty($_SESSION["message"]["userEmail"])) {
                                                                                                                                                                                            echo $_POST['userEmail'];
                                                                                                                                                                                        } ?>">
            </div>
            <span class="-mt-2 text-red-500 text-xs ml-7 mb-3 w-11/12">
                <?php
                if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["userEmail"])) {
                    echo $_SESSION["message"]["userEmail"];
                }
                ?>
            </span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="PhoneNumber" id="phone" placeholder="Numéro de téléphone" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none" value="<?php if (isset($_POST['enregister']) && empty($_SESSION["message"]["PhoneNumber"])) {
                                                                                                                                                                                                    echo $_POST['PhoneNumber'];
                                                                                                                                                                                                } ?>">
            </div>
            <span class="-mt-2 text-red-500 text-xs ml-7 mb-3 w-11/12">
                <?php
                if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["PhoneNumber"])) {
                    echo $_SESSION["message"]["PhoneNumber"];
                }
                ?>
            </span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="password" name="Password" id="password" placeholder="Mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-red-500 text-xs ml-7 mb-3 w-11/12">
                <?php
                if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["Password"])) {
                    echo $_SESSION["message"]["Password"];
                }
                ?>
            </span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="password" name="ConfirmPassword" id="confirm_password" placeholder="Confirmer mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-red-500 text-xs ml-7 mb-3 w-11/12">
                <?php
                if (isset($_POST['enregister']) && isset($_SESSION["message"]) && !empty($_SESSION["message"]["Password"])) {
                    echo $_SESSION["message"]["Password"];
                }
                ?>
            </span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="userSponsor" id="sponsor" readonly placeholder="Sponsor" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none" value="usalavatrade">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12"></span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <select name="userSide" id="side" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    <option>Côté de parrainnage</option>
                    <option value="left">Gauche</option>
                    <option value="right">Droite</option>
                </select>
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12"></span>
            <div class="w-11/12 flex justify-between mt-5 mx-auto">
                <div class="w-6/12 flex text-gray-500 justify-left">
                    <input class="w-4 h-4 mx-2" type="checkbox" name="remember" id="remember">
                    <label class="text-sm" for="remember">Se souvenir de moi</label>
                </div>
                <div class="w-6/12 text-gray-500">
                    <span class="flex justify-end"><a href="/reset-password">Mot de passe oublié ?</a></span>
                </div>
            </div>
            <div class="w-11/12 mx-auto mt-4">
                <button type="submit" name="enregister" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-save    "></i> Enregistrer</button>
<!-- conf 2-->
        <form method="POST" action="/sign_in" class="md:w-11/12 w-full  mx-auto p-3">
            <div class="md:w-7/12 mx-auto md:ml-5 border border-gray-400 rounded-lg h-10">
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 mb-3 mdw-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-11/12 md:flex md:justify-between mx-auto">
                <div class="md:w-1/2 w-full md:mr-1">
                    <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="text" name="fistName" id="fistName" placeholder="Nom" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
                <div class="md:w-1/2 w-full md:ml-1">
                    <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="text" name="lastName" id="lastName" placeholder="Post-nom" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
            </div>
            <div class="md:w-11/12 md:flex md:justify-between mx-auto">
                <div class="md:w-1/2 w-full md:mr-1">
                    <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="email" name="email" id="email" placeholder="Addresse mail" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
                <div class="md:w-1/2 w-full md:ml-1">
                    <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
            </div>
            <div class="md:w-11/12 md:flex justify-between mx-auto">
                <div class="md:w-1/2 md:mr-1">
                    <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="password" name="password" id="password" placeholder="Mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
                <div class="md:w-1/2 md:ml-1">
                   <div class="w-full mx-auto border border-gray-400 rounded-lg h-10">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                    </div>
                    <span class="-mt-2 text-gray-500 bg-opacity-50 bg-black text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
                </div>
            </div>
            <div class="md:w-7/12 mx-auto md:ml-5 border border-gray-400 rounded-lg h-10">
                <input type="text" name="sponsor" id="sponsor" readonly placeholder="Sponsor" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-7/12 mx-auto md:ml-5 border border-gray-400 rounded-lg h-10">
               <select name="side" id="side" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                   <option>Côté de parrainnage</option>
                   <option value="left">Gauche</option>
                   <option value="right">Droite</option>
               </select>
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-11/12 flex justify-between mt-5 mx-auto">
                <div class="w-full text-gray-500 text-sm">
                    En cliquant sur <b>Enregistrer</b>, vous acceptez nos <a class="_green_text font-semibold" href="/terms">conditions générales d'utilisation</a> nos <a class="_green_text font-semibold" href="/politics"> politiques de fonctionnements et de confidentialités </a>.
                </div>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-save    "></i> Enregistrer</button>
<!--end conflict-->
            </div>
            <div class="md:w-11/12 mx-auto ">
                <span class="flex ml-1 text-gray-400">Déjà inscrit(e)? &#160;<a class="_green_text" href="/login">Se connecter</a></span>
            </div>
        </form>
    </div>
</div>
    <div data-aos="fade-down"
    data-aos-duration="1500" class="md:w-6/12 w-full overflow-x-hidden md:flex hidden justify-center">
        <img src="assets/logos/add-user.png" style="height: 400px;" alt="Joining image" />
    </div>
    </div>

</div>
<div class="col-span-12 h-screen primary_bg flex justify-center items-center">
    <div class="w-6/12 border border-gray-500 mx-auto primary_bg shadow rounded p-6">
        <div class="w-9/12 mx-auto ">
            <h1 class="_green_text font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
            <h2 class="text-gray-400 font-semibold text-xl my-4 text-left">Bienvenu(e) sur universal get trade</h2>
            <h2 class="text-gray-500 font-semibold text-base my-4 text-left">Remplissez ce formulaire ci-bas pour vous inscrire sur notre plateforme !</h2>
        </div>
        <form method="POST" action="/sign_in" class="w-10/12  mx-auto p-3">
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 mb-3 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="email" name="email" id="email" placeholder="Addresse mail" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="password" name="password" id="password" placeholder="Mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 bg-opacity-50 bg-black text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="sponsor" id="sponsor" readonly placeholder="Sponsor" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
               <select name="side" id="side" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
                   <option>Côté de parrainnage</option>
                   <option value="left">Gauche</option>
                   <option value="right">Droite</option>
               </select>
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
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
                <button type="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-save    "></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<div class="col-span-12 h-screen primary_bg flex justify-center items-center">
    <div class="w-6/12 border border-gray-500 mx-auto primary_bg shadow rounded p-6">
        <div class="w-9/12 mx-auto ">
            <h1 class="_green_text font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
            <h2 class="text-gray-400 font-semibold text-xl my-4 text-left"> Entrer votre addresse mail dans le champs ci-bas pour reinitialiser votre mot de passe</h2>
        </div>
        
        <form method="POST" action="/sign_in" class="w-10/12  mx-auto p-3">
            <div class="w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="mail" name="mail" id="mail" placeholder="Entrer votre addresse mail" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 mb-3 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="w-11/12 mx-auto mt-4">
                <button type="submit" name="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"> <i class="fas fa-check-circle    "></i> Reinitialiser mot de passe</button>
            </div>
        </form>
    </div>
</div>
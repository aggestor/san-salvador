<div class="col-span-12 h-screen primary_bg flex flex-col">
    <div class="w-full h-20 flex  flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a><h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 w-10/12 mx-auto font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 mt-12 border border-gray-900 mx-auto primary_bg shadow rounded p-12">
        <div class="md:w-9/12 mx-auto ">
            <div class="w-full md:hidden h-48 mx-auto grid place-items-center">
                <i class="fas fa-6x text-gray-400 fa-envelope"></i>
            </div>
            <h2 class="text-gray-400 font-semibold text-base my-4 text-left"> Entrer votre addresse mail dans le champs ci-bas pour reinitialiser votre mot de passe</h2>
        </div>
        
        <form method="POST" action="/sign_in" class="md:w-10/12  mx-auto md:p-3">
            <div class="md:w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="mail" name="mail" id="mail" placeholder="Entrer votre addresse mail" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 mb-3 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" name="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"> <i class="fas fa-check-circle    "></i> Reinitialiser mot de passe</button>
            </div>
        </form>
    </div>
</div>
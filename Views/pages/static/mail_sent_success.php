<div class="col-span-12 h-screen primary_bg grid place-items-center">
    <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <h1 class="_green_text text-3xl font-bold">Mail envoyé avec succès !!!</h1>
            <p class="text-gray-400 font-semibold text-lg mt-4"> Nous avons envoyé un mail à l'addresse <span class="text-gray-300"><?php echo isset($params['mail']) ? $params['mail'] : "" ?></span> </p>
            <p class="text-gray-400  mt-6 text-sm"><b>Note :</b> Allez consulter votre boite mail...</p>
            <p class="mt-6 text-sm text-gray-300"><a href="/" class="font-semibold text-black p-2  rounded cursor-pointer hover:bg-green-500 bg-green-500">Revenir plutard</a></p>
        </div>
        <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
            <span class="h-60 w-60 text-gray-900 relative">
                <span class='w-40 h-40  rounded-full bg-green-500 grid place-items-center'><i class="fas fa-envelope fa-4x"></i></span>
                <span class="w-28 h-28 border-4 absolute right-6 bottom-8 border-gray-900 rounded-full bg-green-500 grid place-items-center text-6xl font-semibold">@</span>
            </span>
        </div>
    </div>
</div>
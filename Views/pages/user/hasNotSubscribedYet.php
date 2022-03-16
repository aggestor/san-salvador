<div class="col-span-12 h-screen primary_bg grid place-items-center">
    <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <div class="md:w-10/12 w-11/12 lg:w-8/12  mx-auto md:p-3">
            <h1 class="text-gray-200 text-3xl font-bold">Bienvenu(e) <?php echo isset($_SESSION['users']) ? $_SESSION['users']->getName() : "USALVAGETRADE" ?></h1>
            <p class="text-gray-400 font-semibold text-lg mt-4">Vous etes desormain membre de USALVAGETRADE. Pour commencez à voir les avantages qu'offre notre entreprise, vous devez souscrire à un de nos pack en cliquant sur le bouton "Voir les packs" ci-bas.</p>
            <p class="mt-6 text-sm text-gray-300"><a href="/packages" class="font-semibold text-black p-2  rounded cursor-pointer hover:bg-green-500 bg-green-500">Voir les packs</a></p>
        </div>
        <div class="lg:w-4/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
            <span class="h-60 w-60 text-gray-900">
                <span class='w-56 h-56  rounded-full bg-gray-500 grid place-items-center'><i class="fas fa-5x fa-users"></i></span>
            </span>
        </div>
    </div>
</div>
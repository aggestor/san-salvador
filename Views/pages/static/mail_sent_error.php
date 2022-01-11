<div class="col-span-12 h-screen primary_bg grid place-items-center">
    <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <h1 class="text-red-500 text-3xl font-bold">Mail non envoyé !!!</h1>
            <p class="text-gray-400 font-semibold text-lg mt-4"> Une erreur est survenue lors de l'envoie de votre mail...</p>
            <div>
                <form autocomplete="off" method="POST" action="/user/mail/resend-<?php echo $_SESSION['action']; ?>">
                    <div class="w-full mx-auto focus-within:font-semibold text-gray-600 focus-within:text-green-500 group focus-within:border-green-500 my-4 h-14 px-2 flex rounded-xl border-2 border-gray-400">
                        <input class="bg-transparent w-11/12 h-11/12 text-xl focus:text-green-500 focus:outline-none" type="text" placeholder="Entrer votre mail" name="user_email" value="<?php echo $_SESSION['mail']; ?>" /> <button type="submit" class="h-full p-1"><i class="fas fa-paper-plane text-xl my-auto mx-2 "></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
            <span class="h-60 w-60 text-gray-900 rounded-full relative">
                <span class='w-40 h-40  rounded-full bg-red-500 grid place-items-center'><i class="fas fa-envelope fa-4x"></i></span>
                <span class="w-28 h-28 border-4 absolute right-6 bottom-8 text-red-500 border-red-500 rounded-full bg-gray-900 grid place-items-center font-semibold"><i class="fas fa-4x fa-exclamation-circle"></i></span>
            </span>
        </div>
    </div>
</div>
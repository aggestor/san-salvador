<header id="header" class="h-16 secondary_bg grid py-3 sticky top-0  z-50 filter blur-2 col-span-12">
  <div id="other" class="flex  relative w-11/12 mx-auto justify-between">
    <span class="text-gray-100 lg:text-lg my-auto text-base font-semibold">USALVAGETRADE</span>
    <nav class="lg:w-6/12 hidden w-full sm:flex my-auto sm:w-7/12">
        <ul id="defaultMenu" class="flex w-full justify-around text-gray-100">
            <li class="text-base"><span><a href="/">Acceuil</a></span></li>
            <li class="text-base"><span><a href="/help">Aide</a></span></li>
            <li class="text-base"><span><a href="/packages">Packs</a></span></li>
            <li class="text-base"><span><a href="/services">Services</a></span></li>
            <?php if (!isset($_SESSION['users'])): ?>
                <li class="text-base">|</li>
                <li class="hover:text-green-500 font-semibold text-base"><a href="/register">Créer un compte</a></li>
                <li class="text-base">ou</li>
                <li class="hover:text-green-500 font-semibold text-base"><a class="_green_btn" href="/login">Connexion</a></li>
            <?php else: ?>
                <li class="hover:text-green-500 text-base"><a href="/user/dashboard">Profil</a></li>
                <li class="hover:text-green-500 font-semibold text-base"><a href="/user/logout">Déconnexion</a></li>
            <?php endif;?>


        </ul>
    </nav>
    <button id="hamburger" class="w-8 h-8 rounded sm:hidden items-center flex justify-center border my-auto text-gray-800">
        <i class="fas fa-bars text-xl text-gray-200"></i>
    </button>
</div>
<nav id="mobile" class="hidden flex-col fixed w-screen h-screen z-1000 top-0 secondary_bg">
    <div class="flex justify-end w-11/12 mx-auto">
        <button id="times" class="w-8 h-8  sm:hidden flex justify-center items-center border rounded mt-4 text-white">
            <i class="fas fa-times text-xl text-gray-200"></i>
        </button>
    </div>
    <ul class="flex w-9/12 mx-auto justify-evenly  h-96 flex-col text-white">
       <li class="text-base"><span><a href="/">Acceuil</a></span></li>
            <li class="text-base"><span><a href="/help">Aide</a></span></li>
            <li class="text-base"><span><a href="/packages">Packs</a></span></li>
            <li class="text-base"><span><a href="/services">Services</a></span></li>
             <?php
                if (!isset($_SESSION['users'])): ?>
                    <li class="hover:text-green-500 font-semibold text-base"><a href="/register">Créer un compte</a></li>
                    <li class="hover:text-green-500 font-semibold text-base"><a class="_green_btn" href="/login">Connexion</a></li>
                 <?php else: ?>
                    <li class="hover:text-green-500 text-base"><a href="/user/dashboard">Profil</a></li>
                <li class="hover:text-green-500 font-semibold text-base"><a href="/user/logout">Déconnexion</a></li>
                <?php endif;?>
    </ul>
    <p class="text-gray-400 w-9/12 mx-auto  mt-36">&#169; USALVAGETRADE <span id="year"></span></p>
</nav>
</header>
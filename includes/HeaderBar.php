<?php
     use App\Helpers\MenuHighlighter;
?>
<div class="p-1 col-span-12 z-50 h-20 flex items-center sticky top-0 primary_bg">
    <div class="flex w-11/12 mx-auto">
        <div class="w-4/12">
            <span class="text-gray-100 text-5xl font-semibold">Aggestor</span>
        </div>
        <div class="w-7/12 h-16 items-center text-gray-200 flex justify-around">
                <span class ="<?= MenuHighlighter::get_path()->high_light("Acceuil") ?>">
                    <a href="home">Acceuil</a>
                </span>
                <span>
                    <a href="helps">Aide</a>
                </span>
                <span class ="<?= MenuHighlighter::get_path()->high_light("Packs") ;?>">
                    <a href="packages">Packs</a>
                </span>
                <span class ="<?= MenuHighlighter::get_path()->high_light("Produits") ;?>">
                    <a href="products">Produits</a>
                </span>
                <span class ="<?= MenuHighlighter::get_path()->high_light("Services") ;?>">
                    <a href="services">Services</a>
                </span>
                <span>
                    |
                </span>
                <span>
                    <a class=" text-white font-semibold" href="register">Créer un compte </a>
                </span>
                <span>ou</span>
                <span>
                    <a class="_green_btn" href="login">Connexion</a>
                </span>
        </div>
    </div>
    
</div>
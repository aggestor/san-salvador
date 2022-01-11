<div class="col-span-12 h-screen grid place-items-center">
    <div class="w-11/12 mx-auto flex flex-col md:flex-row md:justify-around">
        <div class="md:w-6/12 sm:w-11/12 flex justify-center">
            <img class="h-96" src="/assets/logos/404.png" />
        </div>
        <div class="md:w-6/12 sm:w-11/12">
            <p class="text-3xl font-semibold _green_text">404 - Page non trouvée</p>
            <p class="text-gray-400 _space_text_l3 mt-2 w-8/12">Nous avons pas pu répondre à votre réquette. Cette erreur peut être dûe à : <br />
            <ul class="list-disc _space_text_l3 mt-2 ml-8 text-gray-400">
                <li>Mauvaise addresse entrée par l'utilisateur</li>
                <li>URL expirée, du coup non trouvée sur le serveur</li>
                <li>Une erreur sur le serveur lors du rendu</li>
            </ul>
            <ul class="list-disc _space_text_l3 mt-2 ml-8 text-gray-400">
                <li><?php echo isset($params['message']) ? $params['message'] : "" ?></li>
            </ul>
            </p>
        </div>
    </div>
</div>
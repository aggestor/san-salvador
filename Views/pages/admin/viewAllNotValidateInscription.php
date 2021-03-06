<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
<?php if (!isset($params['message'])) : ?>
        <div class="col-span-12 flex flex-col">
            <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
                <h1 class="text-gray-300 font-semibold text-xl">Toutes les inscriptions en attente.</h1>
                <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center"><?= count($params['allInscription']) ?></span>
            </div>
            <div class="w-11/12 mx-auto p-3 text-gray-300  mt-6 mb-3 border border-gray-700 primary_bg_ flex justify-between rounded">
                <div class="w-1/12">Noms</div>
                <div class="w-2/12">Email</div>
                <div class="w-1/12">Téléphone</div>
                <div class="w-1/12">Montant</div>
                <div class="w-1/12">Origine</div>
                <div class="w-2/12">Référence</div>
                <div class="w-1/12">Action</div>
            </div>
            <?php foreach ($params['allInscription'] as $data) : ?>
                <div class="w-11/12 mx-auto p-1 items-center text-gray-500 text-sm  my-2 border border-gray-500 flex justify-between rounded">
                    <div class="w-1/12"><?= $data->getUser()->getName() ?></div>
                    <div class="w-2/12"><?= $data->getUser()->getEmail() ?></div>
                    <div class="w-1/12"><?= str_replace("/", "", $data->getUser()->getPhone()) ?></div>
                    <div class="w-1/12"><?= $data->getAmount() ?></div>
                    <div class="w-1/12"><?= $data->getTransactionOrigi() ?></div>
                    <div class="w-2/12">
                    <?php
                        $str = $data->getTransactionCode();
                        $count = strlen($str);
                        $real_str = "";
                        if ($count > 25  && strpos($str, " ") !== true) {
                            $str_1 = substr($str, 0, 25);
                            $str_2 = substr($str, 25, $count);
                            $real_str = $str_1 . " " . $str_2;
                        } else {
                            $real_str = $str;
                        }
                        echo $real_str;
                        ?>
                </div>
                <div class="flex w-1/12 space-x-1 justify-between">
                    <div>
                        <form method="POST" action="/admin/canceled/inscription-<?= $data->getId()?>"><button class="bg-red-500 rounded text-gray-800 p-1.5" type="submit"><i class="fas fa-times-circle    "></i></button></form>
                    </div>
                    <div class="mr-1">
                        <form method="POST" action="/admin/active/inscription-<?= $data->getId() . "-" . $data->getUser()->getId() ?>"><button class="bg-green-500 rounded text-gray-900 p-1.5" type="submit"><i class="fas fa-check-circle    "></i></button></form>
                    </div>
                    
                </div>
                </div>
            <?php endforeach; ?>
            <div class="w-11/12 h-auto text-gray-400  mx-auto items-center">
                <div class="mb-4">
                    Page <?= $_GET['page'] . " sur <b class='text-gray-200'> " . $params['nombrePage'] . "</b>" ?>
                </div>
                <div>
                    <?php
                    $page = $_GET['page'];
                    $nombre_de_pages = $params['nombrePage'];
                    if ($page < $nombre_de_pages and $page != 1) : ?>
                        <div class="w-3/12 flex justify-between">
                            <a href="/admin/active/inscription-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                            <a href="/admin/active/inscription-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                        </div>
                    <?php elseif ($page == $nombre_de_pages and $page != 1) : ?>
                        <a href="/admin/active/inscription-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                    <?php elseif ($page == 1 and $nombre_de_pages > 1) : ?>
                        <a href="/admin/active/inscription-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-span-12  primary_bg grid place-items-center">
            <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
                <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
                    <h1 class="text-gray-200 text-3xl font-bold">Aucune inscription en attente de validation.</h1>
                    <p class="text-gray-400 font-semibold text-lg mt-4">Toutes les inscriptions en attente de validation seront affichées ici.</p>
                </div>
                <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
                    <span class="w-full h-full justify-center flex items-center text-gray-900">
                        <span class='w-40 h-40 bg-gray-500  rounded-full grid place-items-center'><i class="fas fa-check-double fa-5x"></i></span>
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
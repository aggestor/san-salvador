<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <?php if (isset($params['cashOut'])) : ?>
        <div class="col-span-12 flex flex-col">
            <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
                <h1 class="text-gray-300 font-semibold text-xl">Toutes les demandes de retrait déjà validé.</h1>
                <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center"><?= count($params['cashOut']) ?></span>
            </div>
            <div class="w-11/12 mx-auto p-3 text-gray-300  mt-6 mb-3 border border-gray-700 primary_bg_ flex justify-between rounded">
                <div class="w-2/12">Noms</div>
                <div class="w-2/12">Email</div>
                <div class="w-2/12">Destination</div>
                <div class="w-1/12">Montant</div>
                <div class="w-1/12">Date</div>

            </div>
            <?php foreach ($params['cashOut'] as $data) : ?>
                <div class="w-11/12 mx-auto p-1 items-center text-gray-500  my-2 border border-gray-500 flex justify-between rounded">
                    <div class="w-2/12"><?= $data->getUser()->getName() ?></div>
                    <div class="w-2/12"><?= $data->getUser()->getEmail() ?></div>
                    <div class="w-2/12"><?= str_replace("/", "", $data->getDestination()) ?></div>
                    <div class="w-1/12 font-semibold text-white"><?= $data->getAmount() ?> USD</div>
                    <div class="w-1/12"><?= $data->getRecordDate()->format("d-m-Y") ?></div>
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
                            <a href="/admin/history-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                            <a href="/admin/history-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                        </div>
                    <?php elseif ($page == $nombre_de_pages and $page != 1) : ?>
                        <a href="/admin/history-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                    <?php elseif ($page == 1 and $nombre_de_pages > 1) : ?>
                        <a href="/admin/history-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-span-12  primary_bg grid place-items-center">
            <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
                <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
                    <h1 class="text-gray-200 text-3xl font-bold">Aucun retrait effectué pour le moment.</h1>
                    <p class="text-gray-400 font-semibold text-lg mt-4">Tous les retrait validés seront affichés sur cette page.</p>
                </div>
                <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
                    <span class="w-full h-full justify-center flex items-center text-gray-900">
                        <span class='w-40 h-40 bg-gray-500  rounded-full grid place-items-center'><i class="fas fa-dollar-sign fa-5x"></i></span>
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
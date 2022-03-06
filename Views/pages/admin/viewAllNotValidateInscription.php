<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <?php if(isset($params['message']) AND $params['message'] != 1): ?>
        <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Toutes les inscriptions en attente.</h1>
            <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center"><?= count($params['nonAllInscription']) ?></span>
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
            <div class="w-11/12 mx-auto p-1 items-center text-gray-500  my-2 border border-gray-500 flex justify-between rounded">
                <div class="w-1/12"><?= $data->getUser()->getName() ?></div>
                <div class="w-2/12"><?= $data->getUser()->getEmail() ?></div>
                <div class="w-1/12"><?= str_replace("/", "", $data->getUser()->getPhone()) ?></div>
                <div class="w-1/12"><?= $data->getAmount() ?></div>
                <div class="w-1/12"><?= $data->getTransactionOrigi() ?></div>
                <div class="w-2/12"><?= $data->getTransactionCode() ?></div>
                <div>
                    <form method="POST" action="/admin/active/inscription-<?= $data->getId() . "-" . $data->getUser()->getId() ?>"><button class="_green_bg rounded text-gray-800 p-1.5" type="submit">Valider <i class="fas fa-check-circle    "></i></button></form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="col-span-12  primary_bg grid place-items-center">
    <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
        <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
            <h1 class="text-gray-200 text-3xl font-bold">Aucune inscription en attente de validation.</h1>
            <p class="text-gray-400 font-semibold text-lg mt-4">Toutes les inscriptions en attente de validation seront affichées  ici.</p>
        </div>
        <div class="lg:w-6/12 h-72 hidden lg:flex overflow-hidden items-center justify-center">
            <span class="w-full h-full justify-center flex items-center text-gray-900">
                <span class='w-40 h-40 bg-gray-500  rounded-full grid place-items-center'><i class="fas fa-check-double fa-5x"></i></span>
            </span>
        </div>
    </div>
</div>
        <?php endif;?>
</div>
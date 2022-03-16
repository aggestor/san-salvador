<div class="w-full mt-4 relative h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <?php if(isset($params['cashOut'])):?>
    <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Toutes les demandes de retrait en attente.</h1>
            <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center"><?= count($params['cashOut']) ?></span>
        </div>
        <div class="w-11/12 mx-auto p-3 text-gray-300  mt-6 mb-3 border border-gray-700 primary_bg_ flex justify-between rounded">
            <div class="w-1/12">Noms</div>
            <div class="w-2/12">Destination</div>
            <div class="w-2/12">Email</div>
            <div class="w-1/12">Montant</div>
            <div class="w-1/12">Date</div>
            <div class="w-1/12">Action</div>
        </div>
        <?php foreach ($params['cashOut'] as $data) : ?>
            <div class="w-11/12 mx-auto p-1 items-center text-gray-500  my-2 border border-gray-500 flex justify-between rounded">
                <div class="w-1/12"><?= $data->getUser()->getName() ?></div>
                <div class="w-2/12"><?php
                $str =  str_replace("/", "", $data->getDestination()) ;
                $count = strlen($str);
                $real_str = "";
                if($count > 25){
                    $str_1 = substr($str, 0, 25);
                    $str_2 = substr($str, 25, $count);
                    $real_str = $str_1." ".$str_2;
                }else{
                    $real_str = $str;
                }
                echo $real_str;
                ?></div>
                <div class="w-2/12"><?= $data->getUser()->getEmail() ?></div>
                <div class="w-1/12 font-semibold text-white"><?= $data->getAmount() ?> USD</div>
                <div class="w-1/12"><?= $data->getRecordDate()->format("d-m-Y") ?></div>
                <div class="flex w-1/12 justify-between">
                    <button data-act="/admin/validate/cashout-<?= $_GET['page']?>-<?= $data->getId() ?>-<?= $data->getUser()->getId()?>" class="bg-green-500 rounded text-gray-800 p-1.5 m-1 showModal" ><i class="fas fa-check-circle"></i></button>
                    <form method="POST" action="/admin/canceled/cashout-<?= $data->getId() ?>"><button class="bg-red-500 rounded text-white p-1.5 m-1" type="submit"><i class="fas fa-times-circle    "></i></button></form>
                    <form style="display: <?= $data = isset($params['error']) ? '': 'none'?>" method="POST" class="h-96 shadow modal flex flex-col shadow-gray-900 rounded  w-[600px] backdrop-blur-lg top-16 left-48 absolute primary_bg_ bg-opacity-90 text-white">
                        <div class="flex justify-end w-full h-12">
                            <span data-page="<?= $_GET['page']?>" class="fas hideModal fa-times-circle fa-2x mt-2 cursor-pointer h-10 w-10 rounded text-gray-400"></span>
                        </div>
                        <div class="flex flex-col h-full w-9/12 mx-auto items-center justify-center">
                        <!--PASSWORD BEGIN-->
                        <div class="md:w-11/12 mx-auto w-full mb-2">
                            <div class="w-full focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-32 px-2 items-center flex rounded border <?= $data =  (isset($_POST['submit']) && !empty($params['error']['ref'])) ?"border-red-500" : " border-gray-400" ?>">
                                <textarea id="ref" name="ref" type="text" placeholder="Reference de transaction" class="bg-transparent focus:text-green-500 h-28 resize-none focus:outline-none ml-2 w-full" autocomplete="on" ><?= $data = (isset($_POST['submit'])&& !$params['error']['ref']) ? $params['ref'] : "" ?></textarea>
                            </div>
                            <?php if (isset($_POST['submit']) && !empty($params['error']['ref'])): ?>
                                <span class="-mt-2 text-red-500 text-xs"><?php echo $params['error']['ref']; ?></span>
                            <?php endif;?>
                        </div>
                        <!--PASSWORD END-->
                        <div class="md:w-11/12 flex justify-between mt-3 mx-auto">
                            <div class="lg:w-9/12 text-gray-500 text-sm">
                                Avant de cliquer sur <i>Suivant</i>, rassurez-vous d'avoir bien rempli le champ ci-dessus.
                            </div>
                        </div>
                        <div class="md:w-11/12 w-full mx-auto mt-4">
                            <button name="submit" type="submit" class="bg-green-500 text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-save"></i> Enregistrer</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach;?>
        
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
                        <a href="/admin/validate/cashout-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                        <a href="/admin/validate/cashout-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                    </div>
                <?php elseif ($page == $nombre_de_pages and $page != 1) : ?>
                    <a href="/admin/validate/cashout-<?= $page - 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                <?php elseif ($page == 1 and $nombre_de_pages > 1) : ?>
                    <a href="/admin/validate/cashout-<?= $page + 1 ?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php else : ?>
        <div class="col-span-12  primary_bg grid place-items-center">
            <div class="md:w-6/12 lg:w-8/12 flex flex-col lg:flex-row justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg_ shadow rounded md:p-12 p-4">
                <div class="md:w-10/12 w-11/12 lg:w-6/12  mx-auto md:p-3">
                    <h1 class="text-gray-200 text-3xl font-bold">Aucun démande de retrait pour le moment.</h1>
                    <p class="text-gray-400 font-semibold text-lg mt-4">Toutes les demandes de retrait seront affichés sur cette page.</p>
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
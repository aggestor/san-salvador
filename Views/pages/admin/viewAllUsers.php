<div class="w-full mt-4 h-screen-admin scroll overflow-y-scroll grid grid-cols-12">
    <div class="col-span-12 flex flex-col">
        <div class="w-11/12 mx-auto mb-4 h-12 border-b border-gray-900 flex justify-between">
            <h1 class="text-gray-300 font-semibold text-xl">Tous utilisateurs.</h1>
            <span class="bg-blue-500 text-white w-8 h-8 rounded-full grid place-items-center" ><?= count($params['allUsers']);?></span>
        </div>
        <div class="w-11/12 mx-auto p-3 text-gray-300  mt-6 mb-3 border border-gray-700 primary_bg_ flex justify-between rounded">
            <div class="w-2/12">Id</div>
            <div class="w-3/12">Noms</div>
            <div class="w-3/12">Téléphone</div>
            <div class="w-3/12">Email</div>
            <div class="w-2/12">Date d'inscription</div>
        </div>
        <?php foreach($params['allUsers'] as $data) :?>
        <div class="w-11/12 mx-auto p-1 items-center text-gray-500  my-2 border border-gray-800 flex justify-between rounded">
            <div class="w-2/12"><?= $data->getUser()->getId()?></div>
            <div class="w-3/12"><?= $data->getUser()->getName()?></div>
            <div class="w-3/12"><?= $data->getUser()->getPhone()?></div>
            <div class="w-3/12"><?= $data->getUser()->getEmail()?></div>
            <div class="w-2/12"><?= $data->getRecordDate()->format("d-m-Y")?></div>
        </div>
        <?php endforeach;?>
        <div class="w-11/12 h-auto text-gray-200  mx-auto items-center">
           <div class="mb-4">
               Page <?= $_GET['page'] ." sur <b> ". $params['nombrePage'] . "</b>" ?>
           </div> 
           <div>
               <?php
               $page = $_GET['page'];
               $nombre_de_pages = $params['nombrePage'];
    
                if($page < $nombre_de_pages AND $page != 1) : ?>
                    <div class="w-3/12 flex justify-between">
                         <a href="/admin/user-page-<?= $page-1?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                         <a href="/admin/user-page-<?= $page+1?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
                    </div>
                <?php elseif($page = $nombre_de_pages AND $page != 1) : ?>
                         <a href="/admin/user-page-<?= $page-1?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">&larr; Retour </a>
                <?php elseif($page = 1 AND $nombre_de_pages > 1) :?>
                    <a href="/admin/user-page-<?= $page+1?>" class="bg-blue-600 p-2 rounded hover:bg-blue-800 cursor-pointer text-white">Suivant &rarr;</a>
               <?php endif; ?>
           </div>
        </div>
    </div>
</div>
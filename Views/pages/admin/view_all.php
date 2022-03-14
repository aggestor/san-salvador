<div id="test" class="w-full">
    <div class="h-12 w-11/12 mx-auto flex p-2 justify-between">
        <h1 class="text-gray-300 font-semibold text-xl w-full"> <i class="fas fa-list  mr-3"></i> Liste de tous les administratifs.</h1>
    </div>
    <div class="w-full flex flex-col p-2">
        <div class="w-11/12 flex justify-between p-1 h-12 my-3 mx-auto rounded border border-gray-500">
            <div class="h-full flex text-gray-200 font-semibold justify-between overflow-hidden w-full">
                <div class="w-3/12 pl-3 h-full justify-center flex flex-col">
                    <span>Id</span>
                </div>
                <div class="w-3/12 pl-3 h-full justify-center flex flex-col">
                    <span>Noms</span>
                </div>
                <div class="w-3/12 pl-3 h-full justify-center flex flex-col">
                    <span>Email</span>
                </div>
                <div class="w-3/12 pl-3 h-full justify-center flex flex-col">
                    <span>Action</span>
                </div>
                
            </div>
        </div>
        <?php foreach($params['allAdmin'] as $admin): ?>
        <div class="w-11/12 mx-auto flex justify-between  h-10 my-3 pb-1">
            <div class="h-full flex justify-between overflow-hidden w-full">
                <div class="w-3/12 pl-3 h-8/12 justify-center flex flex-col">
                    <span class="text-gray-400"><?= $admin->getId() ?></span>
                </div>
                <div class="w-3/12 pl-3 h-8/12 justify-center flex flex-col">
                    <span class="text-gray-400 font-semibold"><?= $admin->getName() ?></span>
                </div>
                <div class="w-3/12 h-8/12 justify-center flex flex-col">
                    <span class="text-gray-400"><?= $admin->getEmail() ?></span>
                </div>
                <div class="w-3/12 pl-3 h-8/12 justify-center flex flex-col">
                    <form method="POST" class="justify-center flex flex-col" action="/admin/ban">
                        <button class="text-white hover:bg-blue-800 text-sm p-1 transition-all duration-200 bg-blue-600 font-semibold rounded flex items-center justify-center h-9">Désactiver <i class="fas fa-ban mt-1 ml-1" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
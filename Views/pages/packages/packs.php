<div style="background-image: url(/assets/logos/pack.jpg); background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;" id="pack" class="col-span-12 flex bg-opacity-10 items-center z-10 h-96">
    <div class="flex flex-col lg:h-36 h-48 bg-black blur-lg w-10/12 p-4 mx-auto bg-opacity-70">
        <h1 class="lg:text-5xl text-xl _green_text font-bold">Forfaits de démarrage </h1>
        <p class="lg:text-xl text-base lg:w-8/12 w-full my-3 text-gray-100">Pour commencer avec Usalvagetrade en tant qu'affilié, voici les différents forfaits de démarrage parmi lesquels choisir.</p>
    </div>
</div>
<div class="col-span-12 secondary_bg">
    <div class="w-11/12 lg:h-screen mx-auto flex mt-6 flex-col">
        <div class="w-full flex mt-9  flex-col md:flex-row justify-between">
            <?php
                foreach($params['pack'] as $pack){ 
                    $images = explode("AND",$pack->getImage())

                    ?>
                    <div class="md:w-4/12 w-11/12 p-2 m-4 primary_bg rounded-xl shadow border border-gray-200 h-96">
                        <span><img src="/assets/img/<?= $images[0] ?>" alt="silver illustration" class="w-36 h-36 mx-auto"></span>
                        <div class="text-gray-400">
                            <p class="text-center _green_text font-semibold"><?= $pack->getName();?></p>
                            <div>
                                <p class="font-bold text-center text-2xl "> <?= $pack->getAmountMin()?>$ à <?= $pack->getAmountMax()?>$</p>
                                <p class="w-11/12 mt-4 mx-auto _space_letter_pack"> <b class="_green_text"><?= $pack->getAcurracy()?>%</b> des gains quotidiens du lundi au vendredi.</p>
                                <div class="bg-blue-600 hover:bg-blue-800 p-2 mx-auto w-5/12 text-center font-semibold cursor-pointer rounded-3xl mt-12 text-white"><a href="/user/pack/subscribe">Souscrire</a></div>
                            </div>

                        </div>

                    </div>
               <?php } ?>
        </div>
    </div>

</div>
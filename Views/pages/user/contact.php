<div class="col-span-12 secondary_bg">
    <div class="flex flex-col md:flex-row w-11/12 h-v-70 h-auto md:items-center mx-auto md:justify-around">
        <div data-aos="fade-down" data-aos-duration="1500" class="md:w-6/12 w-full overflow-x-hidden flex justify-center">
            <img src="assets/logos/contact.png" class="md:h-96 h-80 w-80 md:w-96" alt="Joining image" />
        </div>
        <div data-aos="fade-down" data-aos-duration="1500" class="md:w-6/12 overflow-x-hidden w-11/12 lg:mx-0 mx-auto flex flex-col mt-6 ">
            <h1 class="md:w-11/12 w-full lg:mx-0 mx-auto md:text-2xl text-xl text-white font-bold">CONTACTEZ-NOUS</span></h1>
            <p class="text-gray-500 my-2 md:w-11/12 w-full lg:mx-0 mx-auto">Laissez-nous un message en remplissant ce formulaire ci-dessous.</p>
            <form method="POST" class="w-11/12 lg:mx-0 mx-auto flex flex-col">
                <div class="lg:w-11/12 w-full focus-within:font-semibold text-gray-600 focus-within:text-green-500 group focus-within:border-green-500 mt-3 h-14 px-2 flex rounded-xl border-2 <?= $data = (isset($_POST['send']) && !empty($params['errors']['user_email'])) ? "border-red-500" : " border-gray-400" ?>">
                    <input id="mail" name="user_email" class="bg-transparent w-full h-11/12 text-xl focus:text-green-500 focus:outline-none" type="email" placeholder="Entrer votre adresse mail" value="<?php echo (isset($_POST['send']) && empty($params['errors']['user_email'])) ? $_POST['user_email'] : ""; ?>" />
                </div>
                <?php if (isset($_POST['send']) && !empty($params['errors']['user_email'])) : ?>
                    <span class="text-red-500  mb-3 text-xs"><?php echo $params['errors']['user_email']; ?></span>
                <?php endif; ?>
                <div class="lg:w-11/12 w-full focus-within:font-semibold text-gray-600 focus-within:text-green-500 group focus-within:border-green-500 mt-3 h-auto px-2 flex rounded-xl border-2 <?= $data = (isset($_POST['send']) && !empty($params['errors']['message'])) ? "border-red-500" : " border-gray-400" ?>">
                    <textarea style="resize: none;" id="message" name="message" class="bg-transparent w-full p-1 text-xl resize-none focus:text-green-500 focus:outline-none h-36" placeholder="Votre message"><?php echo (isset($_POST['send']) && empty($params['errors']['message'])) ? $_POST['message'] : ""; ?></textarea>
                </div>
                <?php if (isset($_POST['send']) && !empty($params['errors']['message'])) : ?>
                    <span class="text-red-500  mb-3 text-xs"><?php echo $params['errors']['message']; ?></span>
                <?php endif; ?>
                <div class="lg:w-11/12 w-full mt-3">
                    <button type="submit" name="send" class=" bg-green-500 p-3 rounded font-semibold"> Envoyer le message <i class="fas ml-2 fa-paper-plane    "></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="lg:w-11/12 w-full flex h-60 items-center justify-center">
        <p class="text-gray-300 text-center text-2xl lg:text-3xl"> <i class="fas fa-address-card"></i> AUTRES CONTACTS</p>
    </div>
    <div class="w-11/12 mx-auto flex lg:flex-row flex-col space-x-5 mb-5 lg:h-96 ">
        <div class="lg:w-4/12 w-11/12 mx-auto lg:mx-0 mb-2 lg:mb-0 rounded border p-4 flex flex-col border-gray-900 lg:h-80 h-auto">
            <div class="w-full grid place-items-center">
                <span class="text-gray-400 font-semibold text-lg">Téléphones</span>
            </div>
            <div class="w-full grid place-items-center my-3">
                <ul class="flex flex-col">
                    <li class="hover:text-green-500 p-2 text-gray-400"><a href="tel:+19292245034">+1 929-224-5034</a></li>
                </ul>
            </div>
        </div>
        <div class="lg:w-4/12 w-11/12 mx-auto lg:mx-0 mb-2 lg:mb-0 rounded border p-4 flex flex-col border-gray-900 lg:h-80 h-auto">
            <div class="w-full grid place-items-center">
                <span class="text-gray-400 font-semibold text-lg">Adresses Mail</span>
            </div>
            <div class="w-full grid place-items-center my-3">
                <ul class="flex flex-col">
                    <li class="hover:text-green-500 p-2 text-gray-400"><a href="mailto:support@usalvagetrade.com">support@usalvagetrade.com</a></li>
                </ul>
            </div>
        </div>
        <div class="lg:w-4/12 w-11/12 mx-auto lg:mx-0 mb-2 lg:mb-0 rounded border p-4 flex flex-col border-gray-900 h-80">
            <div class="w-full grid place-items-center">
                <span class="text-gray-400 font-semibold text-lg">Réseaux sociaux</span>
            </div>
            <div class="w-full grid place-items-center my-3">
                <ul class="flex flex-col">
                    <li class="hover:text-green-500 p-2 text-gray-400"><a class="flex w-full" href="https://facebook.com/UsalvageTrade"><span class="mr-4 text-gray-500 grid place-items-center rounded-full"><i class="fab text-2xl fa-facebook"></i></span><span>Usalvagetrade</span></a></li>
                    <li class="hover:text-green-500 p-2 text-gray-400"><a class="flex w-full" href="https://instagram.com/usalvage_trade/"><span class="mr-4 text-gray-500 grid place-items-center rounded-full"><i class="fab text-2xl fa-instagram"></i></span><span>Usalvagetrade</span></a></li>
                    <li class="hover:text-green-500 p-2 text-gray-400"><a class="flex w-full" href="https://twitter.com/usalvagetrade?t=4lk73G8psZNEDPl-9K5WpQ&s=09"><span class="mr-4 text-gray-500 grid place-items-center rounded-full"><i class="fab text-2xl fa-twitter"></i></span><span>Usalvagetrade</span></a></li>
                    <li class="hover:text-green-500 p-2 text-gray-400"><a class="flex w-full" href="https://youtube.com/channel/UCJamYlht8bYE1CVOAKgA_tQ"><span class="mr-4 text-gray-500 grid place-items-center rounded-full"><i class="fab text-2xl fa-youtube"></i></span><span>Usalvagetrade</span></a></li>
                    <li class="hover:text-green-500 p-2 text-gray-400"><a class="flex w-full" href="https://wa.me/19292245034"><span class="mr-4 text-gray-500 grid place-items-center rounded-full"><i class="fab text-2xl fa-whatsapp"></i></span><span>+1 929-224-5034</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
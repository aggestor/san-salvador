<?php
$images = explode("AND", $params['user']->getPhoto());
?>

<div class="col-span-12  primary_bg">
    <div class="w-full flex justify-between lg:h-24 h-auto flex-col lg:flex-row p-2 primary_bg_ border-gray-800 border-b">
        <div class="flex lg:hidden my-2 justify-between">
            <h1 class="text-gray-200 font-semibold">USALVAGETRADE</h1>
             <button id="hamburger" class="w-8 h-8 rounded sm:hidden items-center flex justify-center border my-auto text-gray-800">
                <i class="fas fa-bars text-xl text-gray-200"></i>
            </button>
        </div>
        <nav id="mobile" class="hidden flex-col fixed w-screen h-screen z-1000 top-0 secondary_bg">
            <div class="flex justify-end w-11/12 mx-auto">
                <button id="times" class="w-8 h-8  sm:hidden flex justify-center items-center border rounded mt-4 text-white">
                    <i class="fas fa-times text-xl text-gray-200"></i>
                </button>
            </div>
            <ul class="flex w-9/12 mx-auto  justify-evenly   h-96 flex-col text-white">
            <li class="text-base"><span><span class="fas fa-school mr-3"></span><a href="/user/dashboard">Dashboard</a></span></li>
                    <li class="text-base "><span><span class="fas fa-tree mr-3"></span><a href="/user/tree">Arbre</a></span></li>
                    <li class="text-base"><span><span class="fas fa-dollar-sign mr-3"></span><a href="/user/cashout">Retrait</a></span></li>
                    <li class="text-base"><span><span class="fas fa-history mr-3"></span><a href="/user/history">Historique de retrait</a></span></li>
                    <li class="text-base"><span><span class="fas fa-upload mr-3"></span><a href="/packages">Remonter de pack</a></span></li>
                    <li class="text-base"><span><span class="fas fa-arrow-left mr-3"></span><a href="/">Acceuil</a></span></li>
                    <li class="text-base"><span><span class="fas fa-share mr-3"></span><a href="/user/share/link">Partager</a></span></li>
                    <li class="hover:text-green-500 text-base"><span class="fas fa-user mr-3"></span><a href="/user/me">Mon Compte</a></li>
                    <li class="hover:text-green-500 font-semibold text-base"><span class="fas fa-power-off mr-3"></span><a href="/user/logout">Déconnexion</a></li>
            </ul>
            <p class="text-gray-400 w-9/12 mx-auto mt-36">&#169; USALVAGETRADE <span id="year"></span></p>
        </nav>
        <div id="user-identifiers" class="lg:w-3/12 w-full h-full flex ">
            <div class="h-16 w-16 overflow-hidden grid place-items-center border-gray-800 border rounded-full primary_bg">
                <img class="object-contain" src="/assets/img/<?=$images[0]?>" alt="<?=$_SESSION["users"]->getName()?>">
            </div>
            <div class="w-7/12 flex flex-col pl-5">
                <span class="text-gray-300 font-semibold text-base lg:text-lg"><?=$_SESSION["users"]->getName()?></span>
                <span class="text-gray-400 lg:text-base text-sm"><?=$_SESSION["users"]->getEmail()?></span>
                <span class="text-green-500 border border-green-500 rounded-full w-16 text-center p-0.5 text-xs">En ligne</span>
            </div>
            <div class="w-2/12 lg:hidden flex flex-col">
                <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-6 rounded-full">
                    <span class="text-xs font-semibold mr-1"><?= $params['user']->getPack()->getName() ?></span> <i class="fas text-xs fa-check-circle "></i>
                </span>
                <span class="flex items-center border-gray-800 border mt-3 rounded-full">
                    <span class="bg-gray-300 grid mr-4 text-gray-900 place-items-center w-6 h-6 rounded-full">
                        <i class="fas text-sm fa-dollar-sign "></i>
                    </span>
                    <span class="font-semibold text-gray-300 text-sm my-auto">
                        <?= $params['user']->getSold() ?>
                    </span>
                </span>
            </div>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-gray-300 grid mr-4 ml-3 text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-dollar-sign "></i>
            </span>
            <span class="font-semibold text-gray-300 text-xl my-auto">
                <?= $params['user']->getSold() ?>
            </span>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-yellow-500 text-gray-900 place-items-center px-2 flex h-12 rounded-full">
                <span class="text-base font-semibold mr-1"><?= $params['user']->getPack()->getName() ?></span> <i class="fas fa-check-circle "></i>
            </span>
        </div>
        <div class="w-2/12 lg:flex hidden items-center h-full">
            <span class="bg-gray-300 grid text-gray-900 place-items-center w-8 h-8 rounded-full">
                <i class="fas fa-calendar "></i>
            </span>
            <span class="text-gray-300 flex pl-2 flex-col my-auto">
                <span>Membre depuis </span>
                <span><?= $params['user']->getrecordDate()->format("F Y") ?></span>
            </span>
        </div>
        <div class="lg:w-3/12 w-full border-gray-800 lg:border lg:p-2 p-1 lg:mr-3 h-full rounded-xl">
            <div class="lg:flex hidden relative">
                <span class="w-3 h-3 animate-ping rounded-full absolute bg-green-400 opacity-75"></span>
                <span class="w-2 h-2  top-1 rounded-full absolute bg-green-500"></span>
                <span class="text-green-500 absolute left-10 -top-1 "> Evolution de votre compte</span>
            </div>
            <div class="w-full h-2 overflow-hidden lg:mt-8 mt-2 mr-3 border-green-500 border rounded">
                <div style="width: calc(<?= $params['user']->getBonusToPercent() ?>%)" class="h-full bg-green-500">

                </div>
            </div>
            <div class="text-gray-500 text-sm flex justify-between">
                <span><?= $params['user']->getBonusToPercent() * 3?>%</span>
                <span class="text-green-500">300%</span>
            </div>
        </div>
    </div>
    <div class="w-full mt-4 grid grid-cols-12">
        <div class="col-span-2 hidden lg:block relative ml-1 h-screen-customer rounded border border-gray-800 primary_bg_">
            <div data-path-user="/user/dashboard" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-school"></i></span>
                    <span class="w-10/12 mt-0.5">Dashboard</span>
                </div>
            </div>
            <div data-path-user="/user/tree" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-tree"></i></span>
                    <span class="w-10/12 mt-0.5">Arbre</span>
                </div>
            </div>
            <div data-path-user="/user/me" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-user"></i></span>
                    <span class="w-10/12 mt-0.5">Mon Compte</span>
                </div>
            </div>
            <div data-path-user="/user/cashout" class="flex p-2 my-2 from-green-500 to-gray-900 text-white transition-all duration-500   cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-dollar-sign"></i></span>
                    <span class="w-10/12 mt-0.5">Retrait</span>
                </div>
            </div>
            <div data-path-user="/user/history" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-history"></i></span>
                    <span class="w-10/12 mt-0.5">Historique de retrait</span>
                </div>
            </div>
            <div data-path-user="/user/share/link" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-share"></i></span>
                    <span class="w-10/12 mt-0.5">Partager</span>
                </div>
            </div>
            <div data-path-user="/packages" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-upload"></i></span>
                    <span class="w-10/12 mt-0.5">Remonter de pack</span>
                </div>
            </div>
            <div data-path-user="/" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-arrow-left"></i></span>
                    <span class="w-10/12 mt-0.5">Retour à l'acceuil</span>
                </div>
            </div>
            <div data-path-user="/user/logout" class="flex p-2 my-2 transition-all duration-500  text-gray-500 cursor-pointer bg-gradient-to-r hover:from-green-500 hover:to-gray-900 hover:text-white">
                <div class="w-11/12 mx-auto flex ">
                    <span class="w-2/12"><i class="fas fa-power-off"></i></span>
                    <span class="w-10/12 mt-0.5">Déconnexion</span>
                </div>
            </div>
            <div class="absolute bottom-0 left-4 h-16 text-gray-500">
                <span class="text-center">Usalvagetrade &#169; <?= date("Y")?></span>
            </div>
        </div>
        <div class="lg:col-span-10 col-span-12 h-screen-customer scroll overflow-y-auto overflow-x-hidden flex p-3">
            <div class="flex flex-col w-11/12 mx-auto">
                <div class="w-full mb-3 h-10 border-b border-gray-900">
                    <h1 class="text-gray-400"> <i class="fas text-2xl fa-dollar-sign mr-2"></i> <span class="font-semibold text-2xl">Demande d'un retrait</span></h1>
                </div>
                <?php if ($params['disabled'] === false) : ?>

                    <div class="w-full flex flex-col text-center items-center justify-center my-6 h-96 primary_bg_ rounded">
                        <span class="mb-3"><i class="fas text-gray-400 fa-4x fa-info-circle "></i></span>
                        <span class="text-lg text-gray-400 w-8/12 mx-auto">Vous ne pouvez pas faire une demande d'un retrait maintenat. La demande d'un retrait s'effectue uniquement le samedi. Plus de renseignement sur le retrait cliquez <span class="_green_text font-semibold"><a href="/help#cashout">ici</a></span> </span>
                    </div>
                <?php elseif ($params['disabled'] === true) : ?>
                    <form class="w-full flex lg:flex-row flex-col justify-between my-6 primary_bg_ rounded" method="POST">
                        <div class="lg:w-1/2 h-[460px] w-full p-3">
                            <div class="flex w-11/12 mx-auto mt-5 mb-2 text-gray-200 font-semibold text-lg">
                                Formuler votre retrait enfin de nous l'envoyer
                            </div>
                            <div class="w-full flex flex-col  h-48">
                                <div class="md:w-11/12 w-full mt-2 mx-auto">
                                    <div class="mx-auto focus-within:font-semibold <?= $data = (isset($_POST['submit']) && !empty($params['errors']['amount'])) ? "border-red-500" : " border-gray-400" ?> text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                                        <input value="<?php echo (isset($_POST['submit']) && empty($params['errors']['amount'])) ? $_POST['amount'] : ""; ?>" id="amount" type="number" name="amount" placeholder="Entrer le montant à retirer" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                                    </div>
                                    <?php if (isset($_POST['submit']) && !empty($params['errors']['amount'])) : ?>
                                        <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['amount']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="md:w-11/12 w-full mx-auto mt-3 mb-2">
                                    <div class=" mx-auto focus-within:font-semibold overflow-hidden text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-56 px-2 flex flex-col rounded border  <?= $data = (isset($_POST['subscribe']) && !empty($params['errors']['source'])) ? "border-red-500" : " border-gray-400" ?>">
                                        <label for="source" class="my-1">Destination de la transaction</label>
                                        <div class="w-full bg-gray-900 rounded flex justify-between h-8">
                                            <div data-trans-type="btc" class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white rounded-l transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center text-gray-300">Bitcoin</div>
                                            <div data-trans-type="am" class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white  cursor-pointer transition-all duration-150 justify-center font-semibold text-center flex items-center text-gray-300">Airtel money</div>
                                            <div data-trans-type="mps" class="w-4/12 transaction-btn text-sm md:text-base hover:bg-blue-600 hover:text-white rounded-r transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center text-gray-300">M-Pesa</div>
                                        </div>
                                        <div id="transactionDataContainer" class="w-full  text-center mx-1 h-36">
                                            <p id="defaultTransactionData" class="my-auto h-36 text-gray-400 flex justify-center items-center flex-col">
                                                <?php if (isset($_POST['submit']) && !empty($params['errors']['phone_number'])) : ?>
                                                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['phone_number']; ?></span>
                                                <?php elseif (isset($_POST['submit']) && !empty($params['errors']['btc'])) : ?>
                                                    <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['btc']; ?></span>
                                                <?php else : ?>
                                                    <i class="fas fa-info-circle  fa-2x  "></i>
                                                    <span>Vous n'avez pas encore choisi la source de votre transaction !</span>
                                                <?php endif; ?>
                                            </p>

                                            <div style="display: none;" id="btcGraph" class="w-full text-center grid place-items-center text-xs mx-1 h-36">
                                            </div>
                                            <div style="display: none;" id="MPSAndAMTransactionData" class="my-auto h-36 justify-center flex flex-col">
                                                <p class="text-gray-500 text-center my-2">Entrer le numéro sur lequel votre argent sera envoyé.</p>
                                                <div class="md:w-11/12 md:flex w-full md:justify-left mb-2 mx-auto">
                                                    <div class="md:w-5/12 md:mt-0 mt-1 mr-1">
                                                        <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  <?= $data = (isset($_POST['submit']) && !empty($params['errors']['phone_number'])) ? "border-red-500" : " border-gray-400" ?>">
                                                            <select name="country_code" class="primary_bg text-gray-400 scroll outline-none w-56 lg:w-full">
                                                                <option data-countryCode="CD" value="243" Selected>Congo Kinshasa (+243)</option>
                                                                <option data-countryCode="US" value="1">USA (+1)</option>
                                                                <optgroup class="bg-transparent hover:bg-green-500" label="Other countries">
                                                                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                                                    <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                                                    <option data-countryCode="AO" value="244">Angola (+244)</option>
                                                                    <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                                                    <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                                                    <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                                                    <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                                                    <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                                                    <option data-countryCode="AU" value="61">Australia (+61)</option>
                                                                    <option data-countryCode="AT" value="43">Austria (+43)</option>
                                                                    <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                                                    <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                                                    <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                                                    <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                                                    <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                                                    <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                                                    <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                                                    <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                                                    <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                                                    <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                                                    <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                                                    <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                                                    <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                                                    <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                                                    <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                                                    <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                                                    <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                                                    <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                                                    <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                                                    <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                                                    <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                                                    <option data-countryCode="CA" value="1">Canada (+1)</option>
                                                                    <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                                                    <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                                                    <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                                                    <option data-countryCode="CL" value="56">Chile (+56)</option>
                                                                    <option data-countryCode="CN" value="86">China (+86)</option>
                                                                    <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                                                    <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                                                    <option data-countryCode="CG" value="242">Congo (+242)</option>
                                                                    <!-- <option data-countryCode="CD" value="243">Congo Kinshasa (+243)</option> -->
                                                                    <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                                                    <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                                                    <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                                                    <option data-countryCode="CI" value="225">Cote d'Ivoire (+225)</option>
                                                                    <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                                                    <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                                                    <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                                                    <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                                                    <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                                                    <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                                                    <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                                                    <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                                                    <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                                                    <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                                                    <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                                                    <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                                                    <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                                                    <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                                                    <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                                                    <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                                                    <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                                                    <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                                                    <option data-countryCode="FI" value="358">Finland (+358)</option>
                                                                    <option data-countryCode="FR" value="33">France (+33)</option>
                                                                    <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                                                    <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                                                    <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                                                    <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                                                    <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                                                    <option data-countryCode="DE" value="49">Germany (+49)</option>
                                                                    <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                                                    <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                                                    <option data-countryCode="GR" value="30">Greece (+30)</option>
                                                                    <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                                                    <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                                                    <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                                                    <option data-countryCode="GU" value="671">Guam (+671)</option>
                                                                    <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                                                    <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                                                    <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                                                    <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                                                    <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                                                    <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                                                    <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                                                    <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                                                    <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                                                    <option data-countryCode="IN" value="91">India (+91)</option>
                                                                    <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                                                    <option data-countryCode="IR" value="98">Iran (+98)</option>
                                                                    <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                                                    <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                                                    <option data-countryCode="IL" value="972">Israel (+972)</option>
                                                                    <option data-countryCode="IT" value="39">Italy (+39)</option>
                                                                    <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                                                    <option data-countryCode="JP" value="81">Japan (+81)</option>
                                                                    <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                                                    <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                                                    <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                                                    <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                                                    <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                                                    <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                                                    <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                                                    <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                                                    <option data-countryCode="LA" value="856">Laos (+856)</option>
                                                                    <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                                                    <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                                                    <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                                                    <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                                                    <option data-countryCode="LY" value="218">Libya (+218)</option>
                                                                    <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                                                    <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                                                    <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                                                    <option data-countryCode="MO" value="853">Macao (+853)</option>
                                                                    <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                                                    <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                                                    <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                                                    <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                                                    <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                                                    <option data-countryCode="ML" value="223">Mali (+223)</option>
                                                                    <option data-countryCode="MT" value="356">Malta (+356)</option>
                                                                    <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                                                    <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                                                    <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                                                    <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                                                    <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                                                    <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                                                    <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                                                    <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                                                    <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                                                    <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                                                    <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                                                    <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                                                    <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                                                    <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                                                    <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                                                    <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                                                    <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                                                    <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                                                    <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                                                    <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                                                    <option data-countryCode="NE" value="227">Niger (+227)</option>
                                                                    <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                                                    <option data-countryCode="NU" value="683">Niue (+683)</option>
                                                                    <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                                                    <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                                                    <option data-countryCode="NO" value="47">Norway (+47)</option>
                                                                    <option data-countryCode="OM" value="968">Oman (+968)</option>
                                                                    <option data-countryCode="PW" value="680">Palau (+680)</option>
                                                                    <option data-countryCode="PA" value="507">Panama (+507)</option>
                                                                    <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                                                    <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                                                    <option data-countryCode="PE" value="51">Peru (+51)</option>
                                                                    <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                                                    <option data-countryCode="PL" value="48">Poland (+48)</option>
                                                                    <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                                                    <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                                                    <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                                                    <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                                                    <option data-countryCode="RO" value="40">Romania (+40)</option>
                                                                    <option data-countryCode="RU" value="7">Russia (+7)</option>
                                                                    <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                                                    <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                                                    <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                                                    <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                                                    <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                                                    <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                                                    <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                                                    <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                                                    <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                                                    <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                                                    <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                                                    <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                                                    <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                                                    <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                                                    <option data-countryCode="ES" value="34">Spain (+34)</option>
                                                                    <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                                                    <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                                                    <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                                                    <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                                                    <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                                                    <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                                                    <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                                                    <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                                                    <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                                                    <option data-countryCode="SI" value="963">Syria (+963)</option>
                                                                    <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                                                    <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                                                    <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                                                    <option data-countryCode="TW" value="255">Tanzania (+255)</option>
                                                                    <option data-countryCode="TG" value="228">Togo (+228)</option>
                                                                    <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                                                    <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                                                    <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                                                    <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                                                    <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                                                    <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                                                    <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                                                    <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                                                    <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                                                    <option data-countryCode="GB" value="44">UK (+44)</option>
                                                                    <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                                                    <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                                                    <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                                                    <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                                                    <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                                                    <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                                                    <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                                                    <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                                                    <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                                                    <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                                                    <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                                                    <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                                                    <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                                                    <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                                                    <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                                                    <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <?php if (isset($_POST['submit']) && !empty($params['errors']['country_code'])) : ?>
                                                            <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['country_code']; ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="md:w-6/12 w-full md:mt-0 mt-1 mr-1">
                                                        <div class="mx-auto focus-within:font-semibold text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border <?= $data = (isset($_POST['submit']) && !empty($params['errors']['phone_number'])) ? "border-red-500" : " border-gray-400" ?>">
                                                            <input id="PhoneNumber" name="phone_number" maxlength="15" minlength="9" type="text" placeholder="Numéro de téléphone" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" value="<?php echo (isset($_POST['submit']) && empty($params['errors']['phone_number'])) ? $_POST['phone_number'] : ""; ?>" />
                                                        </div>
                                                        <?php if (isset($_POST['submit']) && !empty($params['errors']['phone_number'])) : ?>
                                                            <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['phone_number']; ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display: none;" id="BTCTransactionData" class=" mr-2 h-36 justify-center flex-col flex">
                                                <div class="md:w-11/12 w-full mt-2 mx-auto">
                                                    <div class="mx-auto focus-within:font-semibold <?= $data = (isset($_POST['submit']) && !empty($params['errors']['btc'])) ? "border-red-500" : " border-gray-400" ?> text-gray-300 focus-within:text-green-600 group focus-within:border-green-500 h-10 px-2 items-center flex rounded border  border-gray-400">
                                                        <input value="<?php echo (isset($_POST['submit']) && empty($params['errors']['btc_address'])) ? $_POST['btc_address'] : ""; ?>" id="btc" type="text" name="btc_address" placeholder="Entrer l'adresse de votre porte feuille BTC" class="bg-transparent focus:text-green-500 focus:outline-none ml-2 w-full" autocomplete="on" />
                                                    </div>
                                                    <?php if (isset($_POST['submit']) && !empty($params['errors']['btc'])) : ?>
                                                        <span class="-mt-2 text-red-500 text-xs"><?php echo $params['errors']['btc_address']; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="w-11/12 mx-auto flex ">
                                                    <span id="showBTCGraph" class="bg-blue-600 rounded w-5/12 text-sm p-1 mt-5 cursor-pointer hover:bg-blue-800 text-white">Cours d'action BTC</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-11/12 w-full mx-auto mt-4">
                                    <button type="submit" name="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"> Envoyer la demande <i class="fas ml-1 fa-paper-plane    "></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 lg:flex hidden justify-center p-2 h-full">
                            <img class="h-96" src="/assets/logos/share-link.png" alt="Share illustration">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
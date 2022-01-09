<?php

namespace Root\App\Controllers;

use Root\App\Models\BinaryModel;
use Root\App\Models\InscriptionModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\User;
use Root\App\Models\PackModel;
use Root\App\Models\ParainageModel;
use Root\App\Models\ReturnInvestModel;
use Root\App\Models\UserModel;
use Root\Core\GenerateId;

class Controller
{
    const SESSION_ADMIN = 'admin';
    const SESSION_USERS = 'users';
    /**
     * Inscrption Model
     *
     * @var InscriptionModel
     */
    private $inscriptionModel;

    /**
     * Pack Model
     *
     * @var PackModel
     */
    private $packModel;

    /**
     * Parainage Model
     *
     * @var ParainageModel
     */
    private $parainageModel;

    /**
     * Binary Model
     *
     * @var BinaryModel
     */
    private $binaryModel;

    /**
     * ReturnInvest Model
     *
     * @var ReturnInvestModel
     */
    private $returnInvestModel;

    /**
     * User Model
     *
     * @var UserModel
     */
    private $userModel;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->inscriptionModel = ModelFactory::getInstance()->getModel("Inscription");
        $this->packModel = ModelFactory::getInstance()->getModel("Pack");
        $this->parainageModel = ModelFactory::getInstance()->getModel("Parainage");
        $this->binaryModel = ModelFactory::getInstance()->getModel("Binary");
        $this->returnInvestModel = ModelFactory::getInstance()->getModel("ReturnInvest");
        $this->userModel = ModelFactory::getInstance()->getModel("User");
    }

    /**
     * La methode pour retourner le tableau des utilisateurs
     *
     * @return array
     */
    public function getAllPck()
    {
        return $this->packModel->findAll();
    }

    /**
     * La methode qui retourner l'objet utilisateur
     *
     * @return User
     */
    public function userObject()
    {
        if ($this->sessionExist($_SESSION[self::SESSION_USERS])) {
            $id = $_SESSION[self::SESSION_USERS]->getId();
            return $this->userModel->load($id);
        }
    }

    /**
     * Methode pour verifier s'il y'a un pack en attende de validation
     *
     * @return bool
     */
    public function existValidateInscription()
    {
        return $this->inscriptionModel->checkAwait($_SESSION[self::SESSION_USERS]->getId());
    }

    //Methode pour verifier si l'utilisateur au moins une inscription active
    public function existOneValidateInscription()
    {
        return $this->inscriptionModel->hasPack($_SESSION[self::SESSION_USERS]->getId());
    }

    public function allUsersHasValidateInscription()
    {
        if ($this->inscriptionModel->checkValidated()) {
            return $this->inscriptionModel->findValidated();
        }
        return array();
    }
    /**
     * Undocumented function
     *
     */
    public function allNonValidateInscription()
    {
        $return = array();
        if ($this->inscriptionModel->checkAwait()) {
            $allValidate = $this->inscriptionModel->findAwait();
            //var_dump($allValidate); exit();
            foreach ($allValidate as $validate) {
                $validate->setUser($this->userModel->findById($validate->getUser()->getId()));
                $return[] = $validate;
            }
        }
        return $return;
    }

    public function activeInscription()
    {
        $idInscription = $_GET['inscription'];
        $idAdmin = $_SESSION[self::SESSION_ADMIN]->getId();
        $idUser = $_GET['user'];
        /**
         * @var Inscription
         */
        $inscription = $this->inscriptionModel->findById($idInscription);
        if ($this->inscriptionModel->checkById($idInscription)) {
            if (!$inscription->isValidate()) {
                $this->inscriptionModel->validate($idInscription, $idAdmin);
            } else {
                Controller::redirect('/admin/dashboard');
            }
        } else {
            return $this->view("pages.static.404");
        }
    }
    /**
     * Pour rendre les views dans l'application
     * @param string $path. Le lien ou se trouve la vue a rendre dans le dossier Views
     * @param string $template. Le Container de notre views
     * @param array|null $params. Les donnees a transmettre a la vue
     *  @return void
     */
    public function view(string $path, string $template = 'layouts', array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if ($params) {
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . $template . '.php';
    }
    // /**
    //  * Pour genener un melnge de chaine de caractere
    //  *
    //  * @param integer $length. La longueur de la chaine de caractere a genener
    //  * @param string $carateres. Les caracteres a melanger
    //  * @return string
    //  */
    // public static function generate(int $length, string $carateres)
    // {
    //     return substr(str_shuffle(str_repeat($carateres, $length)), 0, $length);
    // }

    /**
     * Pour envoyer les mails d'actiavation du compte
     * @param string $to. Le destinataire du mail
     * @param mixed $lien. Le lien d'activation de compte
     */
    public function envoieMail($to, string $lien, string $sujet = null, $path,$nom)
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        // En-têtes additionnels
        $headers[] = 'From: contact@usalvagetrade.com';
        $headers[] = 'Repay-To: contact@usalvagetrade.com';
        $headers[] = 'X-Mailer: PHP/' . phpversion();

        $sujet = $sujet;
        ob_start();
        require VIEWS . $path . '.php';
        $message = ob_get_clean();

        return mail($to, $sujet, $message, implode("\r\n", $headers));
    }
    /**
     * La fonction pour redimentionner une image
     *
     * @param mixed $source. La source de l'image a redimensionner
     * @param mixed $destination. La destination du fichier redimensionner
     * @param mixed $name. Le nom du fichier redimensionner
     * @param mixed $width.La largeur du fichier redimensionner
     * @param mixed $height. La hateur du fichier redimensionner
     * @return void
     */
    public function convertImage($source, $destination, $name, $width, $height)
    {

        //[0]=>width et [1]=>height
        $imageSize = getimagesize($source);
        $extension = strrchr($imageSize['mime'], "/");
        if ($extension == '/jpeg') {
            $imageRessource = imagecreatefromjpeg($source);
            $imageFinale = imagecreatetruecolor($width, $height);
            $final = imagecopyresampled($imageFinale, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
            imagejpeg($imageFinale, $destination . "$name.jpg", 100);
            return $destination . "$name.jpg";
        } elseif ($extension == '/png') {
            $imageRessource = imagecreatefrompng($source);
            $imageFinale = imagecreatetruecolor($width, $height);
            $final = imagecopyresampled($imageFinale, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
            imagepng($imageFinale, $destination . "$name.png", 9);
            return $destination . "$name.png";
        }
    }
    /**
     * La fonction pour cree un repertoire dans le dossier assets/img/directory
     * @param mixed $directory. Le chemin de le nom du dossier a cree
     */
    public function createFolder($directory)
    {
        $path = RACINE . $directory;
        while (!is_dir($directory)) {
            mkdir($path);
            return $path . DIRECTORY_SEPARATOR;
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param mixed $nom. Le du champs du type file dans le formulaire
     */
    public function addImage($nom)
    {

        $image = $_FILES[$nom]['name'];
        $temporaire = $_FILES[$nom]['tmp_name'];
        $directory = $this->createFolder(GenerateId::generate(20, '123450ABCDEabcde'));
        $destination = $directory . $image;
        if (move_uploaded_file($temporaire, $destination)) {
            $imgOrginal = $destination;
            $imgRedi = $this->convertImage($imgOrginal, $directory, 'x320', 96, 96);
            //chemin a enreistre dans la base des donnees
            $folder = str_replace(RACINE, "", $imgOrginal . ' AND ' . $imgRedi);
            return $folder;
        }
    }
    /**
     * Undocumented function
     *
     * @param array $errors. Le tableau des erreurs
     * @param string $keys. La
     * @return void
     */
    public static function errorsViews(array $errors, string $keys)
    {
        if ((isset($errors) && !empty($errors) && key_exists($keys, $errors))) {
            foreach ($errors as $keys => $value) {
                return $value;
            }
        }
    }

    /**
     * Pour la redirection automatique
     *
     * @param string $chemin
     * @return void
     */
    public static function redirect($chemin)
    {
        header('Location:' . $chemin);
    }
    /**
     * Verifie si la session existe deja
     *
     * @param mixed $session
     * @return true
     */
    public static function sessionExist($session)
    {
        if (isset($session) && !empty($session)) {
            return true;
        }
    }
}

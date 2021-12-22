<?php

namespace Root\App\Controllers\Validators;

use Exception;
use Root\App\Controllers\Controller;
use Root\App\Models\ModelException;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\Pack;
use Root\App\Models\PackModel;
use Root\Models\InscriptionModel;

class PackValidation extends AbstractValidator
{
    const FIELD_NAME_PACK = 'pack_name';
    const FIELD_CURRENCY_PACK = 'pack_currency';
    const FIELD_AMOUNTMIN_PACK = 'pack_min_value';
    const FIELD_AMOUNTMAX_PACK = 'pack_max_value';
    const FIELD_IMAGE_PACK = 'pack_image';
    const FIELD_AMOUNT_SUCRIBE = 'montant';
    /**
     * Pack Model
     *
     * @var PackModel
     */
    private $packModel;
    /**
     * Inscription Model
     * @var InscriptionModel
     */
    private $inscriptionModel;
    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->packModel = ModelFactory::getInstance()->getModel('Pack');
        $this->inscriptionModel = ModelFactory::getInstance()->getModel('Inscription');
    }
    /**
     * Creation du pack apres validation
     *
     * @return Pack
     */
    public function createAfterValidation()
    {
        $pack = new Pack();
        $id = Controller::generate(11, "1234567890ABCDEFabcdef");
        $packname = $_POST[self::FIELD_NAME_PACK];
        $packcurrency = $_POST[self::FIELD_CURRENCY_PACK];
        $amountmin = $_POST[self::FIELD_AMOUNTMIN_PACK];
        $amountmax = $_POST[self::FIELD_AMOUNTMAX_PACK];
        $image = $_FILES[self::FIELD_IMAGE_PACK];
        $this->processingId($pack, $id, true);
        $this->processingNamePack($packname, $pack, true);
        $this->processingAmountPack($amountmin, $amountmax, $pack);
        $this->processingImagePack($image, false);
        $this->processingCurrency($packcurrency, $pack);

        if (!$this->hasError()) {
            $controller = new Controller();
            $chemin = $controller->addImage(self::FIELD_IMAGE_PACK);
            $pack->setImage($chemin);
            $pack->setRecordDate(new \DateTime());
            $pack->setRecordTime(new \DateTime());
            try {
                $this->packModel->create($pack);
            } catch (ModelException $e) {
                $this->setMessage($e->getMessage());
            }
        }
        return $pack;
    }

    public function updateAfterValidation()
    {
    }

    public function deleteAfterValidation()
    {
    }
    /**
     * Inscription au pack apres validation
     *
     * @return void
     */
    public function sucribePackAfterValidation()
    {
        $inscription = new Inscription();
        $id = Controller::generate(11, "1234567890ABCDEFabcdef");
        $this->processingId($inscription, $id, true);
        $idPack = isset($_GET['pack']) ? $_GET['pack'] : null;
        $idUsers = isset($_SESSION['users']) ? $_SESSION['users']->getUser() : null;
        $montant=$_POST[self::FIELD_AMOUNT_SUCRIBE];
        $this->processingAmountOnSucribePack($montant,$inscription);

        if (!$this->hasError()) {
           $inscription->setUser($idUsers);
           $inscription->setPack($idPack);
           $inscription->setRecordDate(new \DateTime());
           $inscription->setRecordTime(new \DateTime());
           try {
               $this->inscriptionModel->create($inscription);
           } catch (ModelException $e) {
               $this->setMessage($e->getMessage());
           }

        }
    }

    /**
     * Validation du montant lors de la souscription a un pack
     *
     * @param mixed $montant
     * @return void
     */
    protected function validationAmountOnSuscribePack($montant)
    {
        /**
         * @var Pack
         */
        $pack = $this->packModel->findById($_GET['pack']);
        $montantMin = $pack->getAmountMin();
        $montantMax = $pack->getAmountMax();
        $this->notNullable($montant);
        if (!is_numeric($montant)) {
            throw new \RuntimeException("Veuillez entrer une valeur numerique");
        }
        if ($montant < $montantMin || $montant > $montantMax) {
            throw new \RuntimeException("Veuillez entrer un montant correspondant au pack selectionner");
        }
    }

    /**
     * Traitement du montant de souscription au pack
     *
     * @param mixed $montant
     * @param Inscription $inscription
     * @return void
     */
    protected function processingAmountOnSucribePack($montant, Inscription $inscription)
    {
        try {
            $this->validationAmountOnSuscribePack($montant);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_AMOUNT_SUCRIBE, $e->getMessage());
        }
        $inscription->setAmount($montant);
    }
    /**
     * Undocumented function
     *
     * @param string $name
     * @param Pack $pack
     * @return void
     */
    protected function ValidationNamePack($name, bool $onCreate = false)
    {
        $this->notNullable($name);
        //on va verifier si le nom du pack n'existe pas dans la base des donnees 
        if ($onCreate) {
            if ($this->packModel->checkByName($name)) {
                throw new Exception("Ce nom du pack existe deja dans la base des donnees");
            }
        }
    }
    /**
     * Traitement du nom du pack
     *
     * @param string $name
     * @param Pack $pack
     * @return void
     */
    protected function processingNamePack($name, Pack $pack, $onCreate = false)
    {
        try {
            $this->ValidationNamePack($name, $onCreate);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_NAME_PACK, $e->getMessage());
        }
        $pack->setName($name);
    }

    /**
     * Validation du montant de pack
     *
     * @param  $amountMin
     * @param  $amountMax
     * @return void
     */
    protected function validationAmountPack($amountMin, $amountMax)
    {
        if (empty($amountMin) || empty($amountMax)) {
            throw new \RuntimeException("Veuillez enter Le montant du pack");
        }
        if ($amountMin >= $amountMax || $amountMax < 0 || $amountMin < 0) {
            throw new \RuntimeException("Veuillez enter les valeurs correctes");
        }
        if (!is_numeric($amountMin) || !is_numeric($amountMax)) {
            throw new \RuntimeException("Le montant doit etre numeric du type entier");
        }
    }
    /**
     * Traitement du montant du pack
     *
     * @param int $amoutMin
     * @param int $amountMax
     * @param Pack $pack
     * @return void
     */
    protected function processingAmountPack($amoutMin, $amountMax, Pack $pack)
    {
        try {
            $this->validationAmountPack($amoutMin, $amountMax);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_AMOUNTMAX_PACK, $e->getMessage());
        }
        $pack->setAmountMax($amountMax);
        $pack->setAmountMin($amoutMin);
    }
    /**
     * validation du taux du pack
     *
     * @param mixed $currency
     * @return void
     */
    protected function validationCurrency($currency)
    {
        $this->notNullable($currency);
        if (!is_numeric($currency)) {
            throw new \RuntimeException("Le taux doit etre de type numerique");
        }
        if ($currency < 0) {
            throw new \RuntimeException("Veuillez entre la valeur valide");
        }
    }
    /**
     * Traitement du taux du pack
     *
     * @param mixed $currency
     * @param Pack $pack
     * @return void
     */
    protected function processingCurrency($currency, Pack $pack)
    {
        try {
            $this->validationCurrency($currency);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_CURRENCY_PACK, $e->getMessage());
        }
        $pack->setAcurracy($currency);
    }
    /**
     * Traitement de l'image du pack
     *
     * @param array $image
     * @param boolean $nullable
     * @return void
     */
    protected function processingImagePack($image, $nullable = false)
    {
        try {
            $this->validationImage($image, $nullable);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_IMAGE_PACK, $e->getMessage());
        }
    }
}

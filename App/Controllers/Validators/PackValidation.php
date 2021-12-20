<?php

namespace Root\App\Controllers\Validators;

use Exception;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Pack;
use Root\App\Models\PackModel;

class PackValidation extends AbstractValidator
{
    const FIELD_NAME_PACK = 'packname';
    const FIELD_CURRENCY_PACK = 'packcurreny';
    const FIELD_AMOUNTMIN_PACK = 'amountmin';
    const FIELD_AMOUNTMAX_PACK = 'amountmax';
    const FIELD_IMAGE_PACK = 'image';
    /**
     * Undocumented variable
     *
     * @var PackModel
     */
    private $packModel;

    public function __construct()
    {
        $this->packModel = ModelFactory::getInstance()->getModel('Pack');
    }
    public function createAfterValidation()
    {
        $pack = new Pack();
    }

    public function updateAfterValidation()
    {
    }

    public function deleteAfterValidation()
    {
    }
    /**
     * Undocumented function
     *
     * @param string $name
     * @param Pack $pack
     * @return void
     */
    protected function ValidationNamePack($name, Pack $pack,bool $onCreate=false)
    {
        $this->isNull($name);
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
    protected function processingNamePack($name, Pack $pack,$onCreate=false)
    {
        try {
            $this->ValidationNamePack($name, $pack,$onCreate);
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_NAME_PACK, $e->getMessage());
        }
        $pack->setName($name);
    }

    /**
     * Validation du montant de pack
     *
     * @param integer $amountMin
     * @param integer $amountMax
     * @return void
     */
    protected function validationAmountPack(int $amountMin, int $amountMax)
    {
        if (empty($amountMin) || empty($amountMax)) {
            throw new \RuntimeException("Veuillez enter Le montant du pack");
        }
        if ($amountMin >= $amountMax || $amountMax < 0 || $amountMin < 0) {
            throw new \RuntimeException("Veuillez enter les valeurs correctes");
        }
        if (!is_int($amountMin) || !is_int($amountMax) || !is_numeric($amountMin) || !is_numeric($amountMax)) {
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
        $this->isNull($currency);
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
     * @param mixed $image
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

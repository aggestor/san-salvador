<?php
namespace Root\App\Models\Objects;
/**
 *
 * @author Esaie MUHASA
 *        
 */
class Pack extends DBOccurence
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * taux qu'on beneficie par jour lorsqu'on s'inscrit au paquet
     * @var number
     */
    private $acurracy;
    
    /**
     * Le montant minimum pour s'affilier au paket
     * @var number
     */
    private $amountMin;
    
    /**
     * Le montat maximum d'afiliation au packet
     * @var number
     */
    private $amountMax;
    
    /**
     * l'adresse d'icone 
     * @var string
     */
    private $image;
    
    /**
     * le niveau du paket, car ceux-ci sont classifiee
     * @var int
     */
    private $level;
    
    /**
     * l'administrateur qui aurait enregistrer l'occurence dans la BDD
     * @var Admin
     */
    private $admin;
    
    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @return number
     */
    public function getAcurracy()
    {
        return $this->acurracy;
    }

    /**
     * @return number
     */
    public function getAmountMin()
    {
        return $this->amountMin;
    }

    /**
     * @return number
     */
    public function getAmountMax()
    {
        return $this->amountMax;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return number
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Revoie la refence vers l'administreateur qui aurait enregistre l'occurence
     * @return Admin
     */
    public function getAdmin() : ?Admin
    {
        return $this->admin;
    }

    /**
     * @param string $name
     */
    public function setName($name) : void 
    {
        $this->name = $name;
    }

    /**
     * @param number $acurracy
     */
    public function setAcurracy($acurracy) : void
    {
        $this->acurracy = $acurracy;
    }

    /**
     * @param number $amountMin
     */
    public function setAmountMin($amountMin) : void
    {
        $this->amountMin = $amountMin;
    }

    /**
     * @param number $amountMax
     */
    public function setAmountMax($amountMax) : void
    {
        $this->amountMax = $amountMax;
    }

    /**
     * @param string $image
     */
    public function setImage($image) : void
    {
        $this->image = $image;
    }

    /**
     * @param number $level
     */
    public function setLevel($level) : void
    {
        $this->level = $level;
    }

    /**
     * @param Admin $admin
     */
    public function setAdmin($admin) : void
    {
        if ($admin instanceof Admin || $admin == null) {
            $this->admin = $admin;
        }else if (is_int($admin)) {
            $this->admin = new  Admin(array('id' => $admin));
        }else {
            throw new \InvalidArgumentException("Argument invalide en parametre de la methode setAdmin()");
        }
    }
    
    /**
     * verifie si le montant en parametre est pris en charge par ce packet
     * @param int $amount
     * @return bool
     */
    public function inPack (int $amount) : bool {
        return ($amount >= $this->getAmountMin() && $amount <= $this->getAmountMax());
    }

}


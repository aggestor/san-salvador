<?php

namespace Root\App\Models\Objects;


/**
 * 
 * @author Esaie MUHASA
 * 
 * Nouveau capital investie par un utilisateur
 * ========================================     
 */
class Inscription extends Operation
{

    /**
     * l'inscription predecesseur
     * @var Inscription
     */
    private $previus;

    /**
     * le code de la transaction
     * @var string
     */
    private $transactionCode;

    /**
     * l'origine de la transaction
     * @var string
     */
    private $transactionOrigi;

    /**
     * l'inscription est-elle deja ete valider par l'administrateur??
     * @var boolean
     */
    private $validate;
    /**
     * @var \DateTime
     */
    private $confirmationDate;

    /**
     * @var \DateTime
     */
    private $confirmationTime;

    /**
     * Revoie la refence vers l'administreateur qui aurait enregistre l'occurence
     * @return Admin
     */
    public function getAdmin() : ?Admin
    {
        return $this->admin;
    }

    /**
     * @return Inscription
     */
    public function gelPrevius(): ?Inscription
    {
        return $this->previus;
    }


    /**
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * @return string
     */
    public function getTransactionOrigi()
    {
        return $this->transactionOrigi;
    }

    /**
     * l'investissement est-elle deja valider par l'administrateur????
     * @return boolean
     */
    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    /**
     * @return bool|NULL
     */
    public function getValidate(): ?bool
    {
        return $this->isValidate();
    }

    /**
     * @return \DateTime
     */
    public function getConfirmationDate()
    {
        return $this->confirmationDate;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmationTime()
    {
        return $this->confirmationTime;
    }

    /**
     * @param Inscription $previus
     */
    public function selPrevius($previus): void
    {
        $this->previus = $previus;
    }

    /**
     * @param string $transactionCode
     */
    public function setTransactionCode($transactionCode): void
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * @param string $transactionOrigi
     */
    public function setTransactionOrigi($transactionOrigi): void
    {
        $this->transactionOrigi = $transactionOrigi;
    }

    /**
     * @param boolean $validate
     */
    public function setValidate($validate): void
    {
        $this->validate = $validate;
    }

    /**
     * @param \DateTime $confirmationDate
     */
    public function setConfirmationDate($confirmationDate): void
    {
        $this->confirmationDate = $confirmationDate;
    }

    /**
     * @param \DateTime $confirmationTime
     */
    public function setConfirmationTime($confirmationTime): void
    {
        $this->confirmationTime = $confirmationTime;
    }
}

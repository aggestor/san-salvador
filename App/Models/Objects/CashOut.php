<?php
namespace Root\App\Models\Objects;
use Root\App\Models\ModelException;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class CashOut extends Operation
{
    /**
     * @var Admin
     */
    private $admin;
    
    /**
     * @var bool
     */
    private $validated;

    /**
     * l'adresse de reception du montant retirer
     * (tel, btc,...)
     * @var string
     */
    private $destination;
    
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\Objects\Operation::getSurplus()
     */
    public function getSurplus()
    {
        throw new \RuntimeException("Operation non pris en charge");
    }

    /**
     * @return string
     */
    public function getDestination () : ?string {
        return $this->destination;
    }

    /**
     * @return void
     */
    public function setDestination (?string $destination) : void {
        $this->destination = $destination;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\Objects\Operation::setSurplus()
     */
    public function setSurplus($surplus)
    {
        throw new \RuntimeException("Operation non pris en charge");
    }
    
    /**
     * @return \Root\App\Models\Objects\Admin
     */
    public function getAdmin () : ?Admin
    {
        return $this->admin;
    }

    /**
     * @return boolean
     */
    public function isValidated () : ?bool
    {
        return $this->validated;
    }

    /**
     * @param \Root\App\Models\Objects\Admin|string $admin
     */
    public function setAdmin ($admin) : void
    {
        if ($admin == null || $admin instanceof Admin) {
            $this->admin = $admin;
        } else if (is_string($admin)) {
            $this->admin = new Admin(array('id' => $admin));
        } else {
            throw new ModelException("valeur invalide en parametre de la methode setAdmin() : void");
        }
    }

    /**
     * @param boolean $validated
     */
    public function setValidated($validated) : void
    {
        $this->validated = $validated;
    }
    
    
    /**
     * renvoie le 10 % de retrocomission
     * @return float|NULL
     */
    public function getRetrocomission () : ?float {
        if ($this->getAmount()!=null) {
            round(($this->getAmount()/100) * 10, 2);
        }
        return null;
    }
    
    /**
     * renvoie le montnat a retirer
     * @return float|NULL
     */
    public function getWithdrawal () : ?float {
        if ($this->getAmount()!=null) {
            round(($this->getAmount()/100) * 90, 2);
        }
        return null;
    }

    
}


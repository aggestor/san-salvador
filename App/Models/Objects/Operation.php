<?php
namespace Root\App\Models\Objects;
/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class Operation extends DBOccurence
{
    /**
     * L'utilisateur beneficiaire de l'operation
     * (proprietaire du compte qui aurait subit l'operation)
     * @var Inscription
     */
    protected $inscription;
    
    /**
     * le montant pour l'operation effectuer
     * @var number
     */
    protected $amount;
    
    /**
     * s'il un surplus, lors de l'execution de l'operation
     * @var number
     */
    protected $surplus = 0;
    
    
    /**
     * @return \Root\Models\Objects\Inscription
     */
    public function getInscription() : ?Inscription
    {
        return $this->inscription;
    }

    /**
     * @return number
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \Root\Models\Objects\Inscription $inscription
     */
    public function setInscription ($inscription) : void
    {
        if ($inscription instanceof Inscription || $inscription == null) {
            $this->inscription = $inscription;
        }else if (is_int($inscription)) {
            $this->inscription = new Inscription(array('id' => $inscription));
        }else {
            throw new \InvalidArgumentException("Argument invalide en parametre de la methode setInscription()");
        }
    }

    /**
     * @param number $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
    /**
     * @return number
     */
    public function getSurplus()
    {
        return $this->surplus;
    }

    /**
     * @param number $surplus
     */
    public function setSurplus($surplus)
    {
        $this->surplus = $surplus;
    }


}


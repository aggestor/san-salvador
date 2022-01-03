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
     * @var User
     */
    protected $user;
    
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
     * @return User
     */
    public function getUser() : ?User
    {
        return $this->user;
    }

    /**
     * @return number
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param User $user
     */
    public function setUser ($user) : void
    {
        if ($user instanceof User || $user == null) {
            $this->user = $user;
        }else if (is_string($user)) {
            $this->user = new User(array('id' => $user));
        }else {
            throw new \InvalidArgumentException("Argument invalide en parametre de la methode setUser()");
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


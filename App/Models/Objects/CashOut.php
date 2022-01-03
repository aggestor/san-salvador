<?php
namespace Root\App\Models\Objects;
/**
 *
 * @author Esaie MUHASA
 *        
 */
class CashOut extends Operation
{
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\Objects\Operation::getSurplus()
     */
    public function getSurplus()
    {
        throw new \RuntimeException("Operation non pris en charge");
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\Objects\Operation::setSurplus()
     */
    public function setSurplus($surplus)
    {
        throw new \RuntimeException("Operation non pris en charge");
    }

    
}


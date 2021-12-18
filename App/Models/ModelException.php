<?php
namespace Root\App\Models;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class ModelException extends \RuntimeException
{
    /**
     * {@inheritDoc}
     * @see \RuntimeException::__construct()
     */
    public function __construct($message, $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}


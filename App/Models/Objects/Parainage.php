<?php
namespace Root\App\Models\Objects;
/**
 *
 * @author Esaie MUHASA
 *        
 */
class Parainage extends Operation
{
    
    /**
     * l'inscription qui a generer
     * pour l'instant dans la DBB ce champ est nomee id_sponsored_inscription	
     * @var Inscription
     */
    private $generator;
    
    
    /**
     * @return Inscription
     */
    public function getGenerator() : ?Inscription
    {
        return $this->generator;
    }

    /**
     * @param Inscription $generator
     */
    public function setGenerator($generator) : void
    {
        if ($generator == null || $generator instanceof Inscription) {
            $this->generator = $generator;
        }else if (is_string($generator)) {
            $this->generator = new Inscription(array('id' => $generator));
        }else {
            throw new \InvalidArgumentException("valeur de type invalide en parametre de la methode setGenerator");
        }
    }

}


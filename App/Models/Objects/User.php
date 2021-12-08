<?php
namespace Root\Models\Objects;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class User extends Member
{
    /**
     * peid gauche
     * @var integer
     */
    const FOOT_LEFT = 1;//
    
    /**
     * peid droite
     * @var integer
     */
    const FOOT_RIGHT = 2;
    
    /**
     * pied du parent direct (cote)
     * @var int
     */
    private $foot;
    
    /**
     * parent directe d'une utilisateur
     * @var User
     */
    private $sponsor;
    
    /**
     * e parent de l'utilisateur (personne qui aurait envoyer le lien de parainage)
     * @var User
     */
    private $parent;
    
    /**
     * Liste des enfants directes
     * @var User[]
     */
    private $sides = [];
    
    /**
     * @return number
     */
    public function getFoot()
    {
        return $this->foot;
    }


    /**
     * @return\Root\Models\Objects\User
     */
    public function getSponsor() : ?User
    {
        return $this->sponsor;
    }

    /**
     * @return\Root\Models\Objects\User
     */
    public function getParent() : ?User
    {
        return $this->parent;
    }

    /**
     * @param number $foot
     */
    public function setFoot($foot) : void
    {
        $this->foot = $foot;
    }

    /**
     * @param\Root\Models\Objects\User $sponsor
     * @throws \InvalidArgumentException
     */
    public function setSponsor($sponsor) : void
    {
        if ($sponsor instanceof User || $sponsor == null) {
            $this->sponsor = $sponsor;
        }else if(is_int($sponsor)) {
            $this->sponsor = new User(array('id' => $sponsor));
        }else {
            throw new \InvalidArgumentException("Argument de type invalide en parametre de la methode setSponsor()");
        }
    }

    /**
     * @param\Root\Models\Objects\User $parent
     * @throws \InvalidArgumentException
     */
    public function setParent($parent) : void
    {
        if ($parent instanceof User || $parent == null) {
            $this->parent = $parent;
        }else if(is_int($parent)) {
            $this->parent = new User(array('id' => $parent));
        }else {
            throw new \InvalidArgumentException("Argument de type invalide en parametre de la methode setParent()");
        }
    }
    
    /**
     * @return \Root\Models\Objects\User[]
     */
    public function getSides()
    {
        return $this->sides;
    }

    /**
     * @param \Root\Models\Objects\User[]  $sides
     */
    public function setSides(array $sides)
    {
        $this->sides = $sides;
    }


}


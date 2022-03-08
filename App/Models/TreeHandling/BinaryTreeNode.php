<?php
namespace Root\App\Models\TreeHandling;

use DateTime;

/**
 *
 * @author Esaie MUHASA
 *        
 */
interface BinaryTreeNode
{
    
    /**
     * revoie le pied sur lequel l'enfant est acrocher 
     * @return int
     */
    public function getFoot () : ?int;
    
    /**
     * Oblige le noeud  de recalculer toute tout les montants sur ces peids et les pieds des enfants
     */
    public function refreshNode () : void;
    
    /**
     * renvoie le noeud enfant a gauche
     * @return BinaryTreeNode
     */
    public function getLeftNode () : BinaryTreeNode;
    
    /**
     * renvoie le noeud enfant a droite
     * @return BinaryTreeNode
     */
    public function getRightNode () : BinaryTreeNode;
    
    /**
     * verifie si le noeud a un enfant sur sa gauche
     * @return bool
     */
    public function hasLeftNode () : bool;
    
    /**
     * verifie si le noeud a un enfant sur sa droite
     * @return BinaryTreeNode
     */
    public function hasRightNode () : bool;
    
    /**
     * revoie l'adresse vers l'icone de l'utilisateur.
     * Ex: une le minuature de sa photo de profil
     * @return string|null
     */
    public function getNodeIcon () : ?string;
    
    /**
     * le noeud est toujours active???
     * @return string
     */
    public function isEnable () : bool;
    
    /**
     * le compte est-elle verouiller???
     * @return bool
     */
    public function isLocked () : ?bool;
    
    /**
     * revoie le parent s'il existe
     * @return BinaryTreeNode
     */
    public function getParentNode () : BinaryTreeNode;
    
    /**
     * Renvoie le sponsor, s'il existe
     * @return BinaryTreeNode|NULL
     */
    public function getSponsorNode () : BinaryTreeNode;
    
    /**
     * verifie si le noeud a un parent
     * @return bool
     */
    public function hasParentNode () : bool;
    
    /**
     * verifie si le noeud a un sponsor
     * @return bool
     */
    public function hasSponsorNode () : bool;
    
    /**
     * revoie les enfant d'un noeud
     * @return BinaryTreeNode[]
     */
    public function getChilds () : array;
    
    /**
     * esque ce noeud a aumoin un enfant???
     * @return bool
     */
    public function hasChilds () : bool;
    
    /**
     * renvoie la somme de tous les capitaux des enfants qui sont en-dessous de luis
     * @return int
     */
    public function getDownlineCapital () : int;
    
    /**
     * renvoie le capital d'un noeud
     * si $date != null, alors le capital renvoyer sera la somme de investissement qui ont été 
     * activer avant la date en parametre
     * @param \DateTime $date
     * @return int
     */
    public function getCapital (?\DateTime $date = null) : int;
    
    /**
     * renvoie le solde des capitaux des anfants qui sont a gauche
     * @return int
     */
    public function getLeftDownlineCapital () : int;
    
    /**
     * renvoie le solde des capitaux des enfants qui sont a droite
     * @return int
     */
    public function getRightDownlineCapital () : int;
    
    /**
     * renvoie le montant restant, que peut encore consomer un utilisateur
     * @return number
     */
    public function getRemainingAmount () ;
}


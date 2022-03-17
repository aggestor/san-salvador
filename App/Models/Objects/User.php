<?php

namespace Root\App\Models\Objects;

use Root\App\Models\ModelException;
use Root\App\Models\TreeHandling\BinaryTreeNode;

/**
 * @author Esaie MUHASA
 * classe utilitaire du compte d'un utilisateur
 * <br/>
 * <strong>POUR EFFECTUER LES CALCULS DES OPERATION DU COMPTE<strong><hr/>
 * <p>pour manipuler les operations voici les methodes principaux a utiliser: </p> 
 * <ul>
 * 
 * <li>
 * <strong>Chargement des operations du comptes</strong>
 * <ul>
 * <li>setOperations (Operation[] $operations, bool $refresh = false) : void, pour charger les operations dans le compte</li>
 * <li>addOperations (Operation ...$operation) : void, ajouter une suite d'operations dans le compte d'un utilisateur</li>
 * <li>addOperation (Operation $operation, bool $refresh = false) : void, ajouter une operation dans la collection des operations</li>
 * <li>getOperations () : Operation[], revoie tout les operations deja effectuer par un compte</li>
 * <li>getInscriptions () : Inscription[], les inscriptions d'un utilisateur </li>
 * <li>getCashOuts () : CashOut[], les operations de retraits</li>
 * <li>getParainages () : Parainage[], les operations de parainage</li>
 * <li>getBinarys () : Binary[], les bonus binaires</li>
 * <li>getReturnInvests () : ReturnInsvest[], les bonus binaires</li>
 * <li>hasInscriptions () : bool, y-a-il des operations d'inscription??</li>
 * <li>getCashOuts () : bool, y-a-il des operations de retrait d'argent??</li>
 * <li>hasParainages () : bool, y-a-il des operations de parainage??</li>
 * <li>hasBinarys () : bool, y-a-il des operations binaire??</li>
 * <li>hasReturnInvests () : bool, y-a-il des operations des bonus journalier??</li>
 * </ul>
 * </li>
 * 
 * <li>
 * <strong>Recuperations des soldes aprese calcule</strong>
 * <p></p>
 * <ul>
 * </ul>
 * </li>
 * 
 * </ul>
 */
class User extends Member implements BinaryTreeNode
{
    /**
     * peid gauche
     * @var integer
     */
    const FOOT_LEFT = 1; //

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
     * cillection des pack pour faciliter de choisir le pack auquel apartiens l'utilisateur
     * @var Pack[]
     */
    private $packs = [];

    /**
     * L'actuel packet d'un utilisateur
     * @var Pack
     */
    private $pack;

    /**
     * verouillage du compte
     * @var boolean
     */
    private $locked;

    /**
     * collection des operations deja effectuer au compte d'un utilisateur
     * @var Operation[]
     */
    private $operations = [];

    //CONSERVATION TEMPORAIRE DES RESULTAT DES CALCULS
    //===================================================

    /**
     * determie s'il y a eux changement des operations dans le compte
     * @var boolean
     */
    private $requireRefresh = true;

    /**
     * Capital investie par l'utilisateur
     * @var int
     */
    private $capital;

    /**
     * @var number
     */
    private $soldBinary;

    /**
     * @var number
     */
    private $soldParainage;

    /**
     * @var number
     */
    private $soldResturn;

    /**
     * montant deja retirer
     * @var number
     */
    private $soldWithdrawal;

    /**
     * le solde actuel du compte
     * ce solde ne prend pas en consideration tout les retrait non encore confirmer
     * @var number
     */
    private $sold;

    /**
     * solde reel actuel du compte
     * prend en cosideration tout les operations (meme le cashout non encore confirmer)
     */
    private $realSold;



    //le capitaux
    //=========================
    private $leftDownlineCapital = null;
    private $rightDownlineCapital = null;
    private $downlineCapital = null;


    /**
     * @return int
     */
    public function getSide()
    {
        return $this->getFoot();
    }


    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::isLocked()
     */
    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked): void
    {
        $this->locked = is_bool($locked) ? $locked : $locked == 1;
    }

    /**
     * @returnUser
     */
    public function getSponsor(): ?User
    {
        return $this->sponsor;
    }

    /**
     * @returnUser
     */
    public function getParent(): ?User
    {
        return $this->parent;
    }

    /**
     * aliace de la methode @method setSide()
     * @param number $foot
     * 
     */
    public function setFoot($foot): void
    {
        $this->foot = $foot;
    }

    /**
     * @param int $side
     */
    public function setSide($side): void
    {
        $this->setFoot($side);
    }

    /**
     * @paramUser $sponsor
     * @throws \InvalidArgumentException
     */
    public function setSponsor($sponsor): void
    {
        if ($sponsor instanceof User || $sponsor === null) {
            $this->sponsor = $sponsor;
        } else if (is_string($sponsor)) {
            $this->sponsor = new User(array('id' => $sponsor));
        } else {
            throw new \InvalidArgumentException("Argument de type invalide en parametre de la methode setSponsor()");
        }
    }

    /**
     * @paramUser $parent
     * @throws \InvalidArgumentException
     */
    public function setParent($parent): void
    {

        if ($parent instanceof User || $parent === null) {
            $this->parent = $parent;
        } else if (is_string($parent)) {
            $this->parent = new User(array('id' => $parent));
        } else {
            throw new \InvalidArgumentException("Argument de type invalide en parametre de la methode setParent()");
        }
    }

    /**
     * @return User[]
     */
    public function getSides()
    {
        return $this->sides;
    }

    /**
     * @param User[]  $sides
     */
    public function setSides(array $sides)
    {
        $this->sides = $sides;
    }

    /**
     * Renvoie les operations d'inscription dans le compte
     * @return \Root\App\Models\Objects\Inscription[]
     */
    public function getInscriptions(): array
    {
        $inscriptions = [];
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof Inscription) {
                $inscriptions[] = $opt;
            }
        }
        return $inscriptions;
    }

    /**
     * Renvoie les retraits de l'utiilsateur
     * @return CashOut[]
     */
    public function getCashOuts(): array
    {
        $cash = [];
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof CashOut) {
                $cash[] = $opt;
            }
        }
        return $cash;
    }

    /**
     * revoie les operations des parainage
     * @return Parainage[]
     */
    public function getParainages(): array
    {
        $parainages = [];
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof Parainage) {
                $parainages[] = $opt;
            }
        }
        return $parainages;
    }

    /**
     * renvoie la collection des operations binaires
     * @return Binary[]
     */
    public function getBinarys(): array
    {
        $binarys = [];
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof Binary) {
                $binarys[] = $opt;
            }
        }
        return $binarys;
    }

    /**
     * @return \Root\App\Models\Objects\Operation []
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * Les inscription du compte sont deja charger??
     * @return bool
     */
    public function hasInscription(?bool $validated = null): bool
    {
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof Inscription) {
                if ($validated === true) {
                    if ($opt->isValidate()) {
                        return true;
                    }
                } else if ($validated === false) {
                    if (!$opt->isValidate()) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * y-a-il une operation des retrait dans le compte ??
     * @return bool
     */
    public function hasCashOut(): bool
    {
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof CashOut) {
                return true;
            }
        }
        return false;
    }

    /**
     * y-a-il une operations de parainage dans le compte??
     * @return bool
     */
    public function hasParainage(): bool
    {
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof Parainage) {
                return true;
            }
        }
        return false;
    }

    /**
     * y-a-il une operations de bonus bunaire dans le compte???
     * @return bool
     */
    public function hasBinary(): bool
    {
        foreach ($this->getOperations() as $opt) {
            if ($opt instanceof CashOut) {
                return true;
            }
        }
        return false;
    }


    /**
     * @param \Root\App\Models\Objects\Operation[] $operations
     * @param $refresh
     * @throws ModelException l'operation dans la collection en parametre n'est pas une classe fille
     * de la classe Operation, soit une operation dont l'identifient ne fait pas reference de l'ID du proprietaire du compte 
     */
    public function setOperations(array $operations, bool $refresh = false): void
    {
        $this->operations = [];
        foreach ($operations as $operation) {
            $this->addOperation($operation);
        }

        if ($refresh) {
            $this->refresh();
        }
    }

    /**
     * ajoute une operation dans la collection d'operations
     * @param Operation $operation
     * @param bool $refresh
     * @throws ModelException
     */
    public function addOperation(Operation $operation, bool $refresh = false): void
    {
        if ($operation->getUser() == null || $operation->getUser()->getId() != $this->getId()) {
            throw new ModelException("Impossible d'integrer une operation qui ne fait pas refernce à l'actuel compte, dans la collection des operation du dit compte");
        }
        $this->operations[] = $operation;
        $this->requireRefresh = true;

        if ($refresh) {
            $this->refresh();
        }
    }

    /**
     * 
     * Ajout d'une suite d'operations.
     * assurevous que cette operation a ete effectuer par le proprietaire de ce compte
     * @param Operation ...$operations
     * @throws ModelException
     */
    public function addOperations(Operation ...$operations): void
    {
        foreach ($operations as $operation) {
            $this->addOperation($operation);
        }
    }

    /**
     * y-a-il aumoin une operation deja effectuer par l'utilisateur du compte
     * @return bool
     */
    public function hasOperations(): bool
    {
        return !empty($this->getOperations());
    }

    /**
     * initialisation des packets pour faciliter le compte de faire sa classification facilement
     * @param Pack[] $packs
     * @param boolean $refresh, doit-on directement determiner le pack du compte??
     * @throws ModelException une exception peut etre levee dans le cas ou on doit determier le Pack du compte
     */
    public function initPacks(array $packs, bool $refresh = false): void
    {
        $this->packs = $packs;

        if ($refresh) {
            $this->refresh();
        }
    }

    /**
     * est-ce que le pack de l'utilisateur est deja determiner???
     * @return bool
     */
    public function hasPack(): bool
    {
        return $this->pack != null;
    }

    /**
     * est-ce possible de choisir le packet de l'utilisateur???
     * @return bool
     */
    public function canChoosePack(): bool
    {
        return (!empty($this->hasInscription(true)) && !empty($this->packs));
    }

    /**
     * @author Esaie MUHASA
     * Revoie le packet actuel d'un utilisateur
     * @return Pack
     * @throws ModelException 
     * @tutorial <strong>Explication de l'exception suceptible d'etre lever</strong>
     * <p>L'exception peut etre elever lors de l'appel a cette methode dans les cas ci-dessous:</p>
     * <ul>
     * <li>s'il n ya auncune inscription charger dans le compte utilisateur </li>
     * <li>si les packets n'ont pas ete charger dans le compte de l'utilisateur, via la method @method initPacks</li>
     * </ul>
     * <hr/>
     * <p>Pour eviter cette erreur utiliser les methodes ci-dessous:</p>
     * <ul>
     * <li>@method hasPack() : @return bool, pour savoir si le pack de l'utiilsateur est deja determier</li>
     * <li>@method canChoosePack() : @return bool, pour savoie s'il est possible de determier le pack actuel de l'utilisateur </li>
     * </ul>
     */
    public function getPack(): Pack
    {
        if ($this->pack == null) {
            $this->pack = $this->choosePack($this->getCapital());
        }

        return $this->pack;
    }

    /**
     * determine le pack actuel  du compte de l'utilisateur
     * @param int $capital
     * @throws ModelException
     * @return Pack
     */
    protected function choosePack(int $capital): Pack
    {
        if (!$this->canChoosePack()) {
            throw new ModelException("Impossible d'effectuer l'operation de classement du compte '{$this->getId()}'");
        }
        foreach ($this->packs as $pack) {
            if ($pack->inPack($capital)) {
                return $pack;
            }
        }

        throw new ModelException("Impossible de determier le pack du compte {$this->getId()}");
    }

    /**
     * faut-il recalculer les solds des operations deja effectuer pas le compte
     * @return bool
     */
    public function requireRefresh(): bool
    {
        return $this->requireRefresh;
    }

    /**
     * oblige de recalculer tout les operations du compte de l'utlisateur.
     * @return void
     */
    public function refresh(): void
    {

        if (!$this->requireRefresh()) {
            return;
        }

        $this->capital = 0;
        $this->soldBinary = 0;
        $this->soldParainage = 0;
        $this->soldResturn = 0;
        $this->sold = 0;
        $this->realSold = 0;
        $this->soldWithdrawal = 0;

        if ($this->hasOperations()) {
            //les operations
            /**
             * @var Operation $operation
             */
            foreach ($this->getOperations() as $operation) {
                if ($operation instanceof Inscription) {
                    $this->capital += ($operation->isValidate() ? $operation->getAmount() : 0);
                } else if ($operation instanceof CashOut) {
                    if($operation->isValidated() || $operation->getAdmin() != null) {
                        $this->soldWithdrawal += $operation->getAmount();
                    } 
                    $this->realSold -= $operation->getAmount();
                } else if ($operation instanceof Parainage) {
                    $this->soldParainage += $operation->getAmount();
                } else if ($operation instanceof Binary) {
                    $this->soldBinary += $operation->getAmount();
                } else if ($operation instanceof ReturnInvest) {
                    $this->soldResturn += $operation->getAmount();
                } else {
                    throw new ModelException("Impossible de poursouvre les calculs dans le compte {$this->getId()} car une operation non prise en charge c trouve dans la collection des operations des ce compte");
                }
            }
            
            $this->sold += ($this->soldBinary + $this->soldParainage +  $this->soldResturn) - $this->soldWithdrawal;
            $this->realSold += ($this->soldBinary + $this->soldParainage +  $this->soldResturn);

            if ($this->canChoosePack()) {
                $this->pack = $this->choosePack($this->capital);
            }
        }


        $this->requireRefresh = false;
    }

    /**
     * utilitaire de verification des la mise en jours des solde calculer
     * @throws ModelException
     */
    protected function doRefreshed(): void
    {
        if ($this->requireRefresh()) {
            $this->refresh();
        }
        //         if ($this->requireRefresh() === true) {
        //             throw new ModelException("Veille appeler la methode refresh() pour calculer les soldes des operations qui touche le compte");
        //         }
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getCapital()
     * @throws ModelException
     */
    public function getCapital(?\DateTime $date = null): int
    {
        if ($date != null) {
            $capital = 0;
            foreach ($this->getInscriptions() as $in) {
                if (!$in->isValidate() || ($in->isValidate() &&
                    ($in->getConfirmationDate() != null &&  ($in->getConfirmationDate()->format('d-m-Y') == $date->format('d-m-Y') || $in->getConfirmationDate()->getTimestamp() >= $date->getTimestamp())))) {
                    continue; //on ecarte tout les inscriptions confirmer en date en parametre, est ceux des dates plus recentes que la date en parametre
                }
                $capital += intval($in->getAmount(), 10);
            }
            return $capital;
        }
        $this->doRefreshed();
        return $this->capital;
    }

    /**
     * revoie le max que peut consolmer un utilisateur
     * @return int
     */
    public function getMaxBonus(): int
    {
        return $this->getCapital() * 3;
    }

    /**
     * renvoie les soldes des montants deja consomer par l'utilisateur
     * @return number
     */
    public function getBonus()
    {
        return $this->getSoldBinary() + $this->getSoldParainage() + $this->getSoldResturn();
    }

    /**
     * renvoie le solde en pourcentage
     * @return number
     */
    public function getBonusToPercent()
    {
        if ($this->getMaxBonus() == 0) {
            return 0;
        }
        return ($this->getBonus() / $this->getMaxBonus()) * 100.0;
    }


    /**
     * Renvoei le solde de bonus binaire
     * @return number
     */
    public function getSoldBinary()
    {
        $this->doRefreshed();
        return $this->soldBinary;
    }

    /**
     * renvoie le solde des parainages
     * @return number
     */
    public function getSoldParainage()
    {
        $this->doRefreshed();
        return $this->soldParainage;
    }

    /**
     * Renvoie le solde des bonus journaliere
     * @return number
     */
    public function getSoldResturn()
    {
        $this->doRefreshed();
        return $this->soldResturn;
    }

    /**
     * amount withdrawaled by user
     * @return number
     */
    public function getSoldWithdrawal()
    {
        $this->doRefreshed();
        return $this->soldWithdrawal;
    }

    /**
     * montant retirable a l'heure actuel
     * tout les cashouts non encore confirmer ne sont pas prise en comprte par cette 
     * methode. Date le cas où vous voulez le solde reel du compte utilisez pluston la methode 
     * getReaSold
     * @return number
     */
    public function getSold()
    {
        $this->doRefreshed();
        return $this->sold;
    }

    /**
     * Renvoie le solde reel du compte.
     * cette methode a l'aventage de prende en compte meme les cashout non encore confirmer
     * @return number
     */
    public function getRealSold () {
        $this->doRefreshed();
        return $this->realSold;
    }


    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getChilds()
     */
    public function getChilds(): array
    {
        return $this->getSides();
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getLeftDownlineCapital()
     */
    public function getLeftDownlineCapital(): int
    {
        if ($this->leftDownlineCapital === null) {
            if (!$this->hasLeftNode()) {
                $this->leftDownlineCapital = 0;
            } else {
                $left = $this->getLeftNode();
                if ($this->requireRefresh()) {
                    $this->refresh();
                }
                $this->leftDownlineCapital = ($left->getCapital() + $left->getDownlineCapital());
            }
        }

        return $this->leftDownlineCapital;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getLeftNode()
     */
    public function getLeftNode(): BinaryTreeNode
    {
        foreach ($this->getChilds() as $ch) {
            if ($ch->getFoot() == self::FOOT_LEFT) {
                return $ch;
            }
        }

        throw new ModelException("Aucun noeud sur le pied gauche de cette utilisateur");
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getNodeIcon()
     */
    public function getNodeIcon(): ?string
    {
        return $this->getPhoto() == null ? '' : $this->getPhoto();
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getParentNode()
     */
    public function getParentNode(): BinaryTreeNode
    {
        if ($this->getParent() == null) {
            throw new ModelException("Aucun noeud parent pour ce noeud");
        }
        return $this->getParent();
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getRemainingAmount()
     */
    public function getRemainingAmount()
    {
        return $this->getMaxBonus() - ($this->getSold() + $this->getSoldWithdrawal());
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getRightDownlineCapital()
     */
    public function getRightDownlineCapital(): int
    {
        if ($this->rightDownlineCapital === null) {
            if (!$this->hasRightNode()) {
                $this->rightDownlineCapital = 0;
            } else {
                $right = $this->getRightNode();
                if ($this->requireRefresh()) {
                    $this->refresh();
                }
                $this->rightDownlineCapital = ($right->getCapital() + $right->getDownlineCapital());
            }
        }

        return $this->rightDownlineCapital;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getDownlineCapital()
     */
    public function getDownlineCapital(): int
    {
        if ($this->downlineCapital === null) {
            $capital =  0;
            if ($this->hasLeftNode()) {
                $left = $this->getLeftNode();
                $capital += $left->getCapital() + $left->getDownlineCapital();
            }

            if ($this->hasRightNode()) {
                $right = $this->getRightNode();
                $capital += $right->getCapital() + $right->getDownlineCapital();
            }
            $this->downlineCapital = $capital;
        }
        return $this->downlineCapital;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getRightNode()
     */
    public function getRightNode(): BinaryTreeNode
    {
        foreach ($this->getChilds() as $ch) {
            if ($ch->getFoot() == self::FOOT_RIGHT) {
                return $ch;
            }
        }

        throw new ModelException("Aucun noeud sur le pied droit de cette utilisateur");
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getSponsorNode()
     */
    public function getSponsorNode(): BinaryTreeNode
    {
        if ($this->getSponsor() == null) {
            throw new ModelException("Aucun sponsor pour ce compte");
        }

        return $this->getSponsor();
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::hasChilds()
     */
    public function hasChilds(): bool
    {
        return !empty($this->getChilds());
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::hasParentNode()
     */
    public function hasParentNode(): bool
    {
        return $this->getParent() != null;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::hasSponsorNode()
     */
    public function hasSponsorNode(): bool
    {
        return $this->getSponsor() != null;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::isEnable()
     */
    public function isEnable(): bool
    {
        return $this->getStatus() == true;
    }
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::hasLeftNode()
     */
    public function hasLeftNode(): bool
    {
        foreach ($this->getChilds() as $ch) {
            if ($ch->getFoot() == self::FOOT_LEFT) {
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::hasRightNode()
     */
    public function hasRightNode(): bool
    {
        foreach ($this->getChilds() as $ch) {
            if ($ch->getFoot() == self::FOOT_RIGHT) {
                return true;
            }
        }
        return false;
    }


    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::getFoot()
     */
    public function getFoot(): ?int
    {
        return $this->foot;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\TreeHandling\BinaryTreeNode::refreshNode()
     */
    public function refreshNode(): void
    {
        $this->downlineCapital = null;
        $this->leftDownlineCapital = null;
        $this->rightDownlineCapital = null;
        $this->refresh();
    }
}

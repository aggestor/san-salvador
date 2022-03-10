<?php
namespace Root\App\Models;

use Root\App\Models\Objects\Operation;
use Root\App\Models\Objects\User;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractOperationModel extends AbstractDbOccurenceModel
{
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::update()
     */
    public function update($object, $id): void
    {
        throw new ModelException("Operation non prise en charge");
    }
    
    /**
     * @param string $userId
     * @throws ModelException
     * @return bool
     */
    public function checkByUser ($userId)  : bool {
        $userIdName = Schema::INSCRIPTION['user'];
        $SQL = "SELECT * FROM {$this->getTableName()}  WHERE {$userIdName} = ?";
        
        $return = false;
        
        try {
            $statement = Queries::executeQuery($SQL, array($userId));
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        
        return $return;
    }

    /**
     * Comptage des operations d'un user
     * @param string $userId l'identifiant du compte d'un user
     * @return int le nombre d'operations deja faits au nom du compte dont l'id est en parametre
     * @throws ModelException, s'il y a erreur lors de la communication avec la BDD
     */
    public function countByUser (string $userId)  : int {
        $userIdName = Schema::INSCRIPTION['user'];
        $SQL = "SELECT COUNT(*) AS nombre FROM {$this->getTableName()}  WHERE {$userIdName} = ?";
        
        $return = 0;
        
        try {
            $statement = Queries::executeQuery($SQL, array($userId));
            if ($row = $statement->fetch()) {
                $return = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        
        return $return;
    }
    
    
    /**
     * revoie la collection des operation d'un utilisateur
     * @param string $userId
     * @throws ModelException
     * @return Operation[]
     */
    public function findByUser ($userId)  : array {
        
        $userIdName = Schema::INSCRIPTION['user'];
        $recordDate = Schema::INSCRIPTION['recordDate'];

        $SQL = "SELECT * FROM {$this->getTableName()} WHERE {$userIdName} = ? ORDER BY {$recordDate} DESC ";
        
        $return = array();
        
        try {
            $statement = Queries::executeQuery($SQL, array($userId));
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            }else {
                $statement->closeCursor();
                throw new ModelException("Aucune operation dans le compte {$userId}");
            }
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        
        return $return;
    }

    /**
     * Calcule le motant maximum admissible pour le compte du user en premier parametre.
     * En supposant que vous avez un compte utilisateur, et vous avez bien charger tout les operations 
     * deja effectuer par ce compte.
     * Vous voulez effectuer une operation d'ajout d'un montant (bonus binaire, parainage, etc.) sur ce compte:
     * en premier vue, voue devez savoir combiens le compte a deja eu et combiens il peut recevoie au max, 
     * sans depasser le 300% du capital investie.
     * => Cette methode fait de petit calculs et vous renvoie le montant max sur la valeur de $amount
     *    que peut recevoie le compte. Et donc en faisant $amount - la valeur retourner par cette fonction,
     *    on trouve  le reste (autrement la valeur a affecter a l'arrtibut $surplus d'un operation)
     * => Si le compte utilisateur en premier parametre n'est pas charger, alors cette methode s'en occuper.
     *    S'il est charger partielement, alors cela posera pobleme au niveau des calcules car le chargement du compte n'aura pas liex
     * @param User $user
     * @param float $amount, le montrant qu'on pretant ajouter au compte
     * @return float le montant admisssible
     * @throws ModelException
     */
    public function getMaxAdmissible (User $user, $amount) : float{
        if(!$user->hasOperations()){
            /**
             * @var UserModel $userModel */
            $userModel = $this->getFactory()->getModel('User');
            $userModel->load($user);
        }

        $solde = $amount + $user->getSold();
        // die("=> {$solde} => {$user->getId()}");
        if( $solde >= $user->getMaxBonus()) {
            $reste = $solde - $user->getMaxBonus();
            return $amount - $reste;
        }

        return $amount;
    }

}


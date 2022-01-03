<?php
namespace Root\App\Models;

use Root\App\Models\Objects\Member;
use Root\App\Models\Objects\DBOccurence;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractMemberModel extends AbstractDbOccurenceModel
{
    
    /**
     * cette email existe????
     * @param string $email
     * @return bool
     * @throws ModelException s'il y a erreur lors la communication avec ladd
     */
    public function checkByMail (string $email) : bool {
         return $this->check(Schema::USER['email'], $email);
    }
    
    
    /**
     * Ce numero telephonique existe??
     * @param string $phone
     * @return bool
     * @throws ModelException s'il y a erreur lors de la communication avec la BDD
     */
    public function checkByPhone (string $phone) : bool {
        return $this->check(Schema::USER['phone'], $phone);
    }
    
    /**
     * Revoie l'utilisateur dont le mail est en parametre
     * @param string $email
     * @return Member
     */
    public function findByMail (string $email) {
        return $this->find(Schema::USER['email'], $email);
    }
    
    
    /**
     * Renvoie le proprietaire du numero de telephone en parametre
     * @param string $phone
     * @return DBOccurence
     */
    public function findByPhone (string $phone) {
        return $this->find(Schema::USER['phone'], $phone);
    }
}


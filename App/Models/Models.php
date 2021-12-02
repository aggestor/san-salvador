<?php

namespace Root\App\Models;

use PDO;
use Root\Core\Db;

class Models extends Db
{
    protected $table;
    protected $id;
    private $Db;

    /**
     * la fonction pour les requettes findAll de notre application
     */
    public function findAll()
    {
        return $this->requete("SELECT * FROM {$this->table}")->fetchAll();
    }
    public function lastId()
    {
        return $this->lastInsertId();
    }
    /**
     * La fonction de selection des donnees de la base des donnees par criteres
     * @param array $criteres
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $key => $value) {
            $champs[] = "$key = ?";
            $valeurs[] = $value;
        }
        /**
         * pour avoir des critere ex.WHERE champs1=? AND champs1=?
         * dans notre function findBy(['$champs1'=>valeur,'$champs2'=>valeur])
         * nous allons transformer notre tableau en une chaine de caractere
         * en ulisant la methode implode de PHP qui prend deux parametre
         * le premier est le separateur pour notre cas c'est AND
         * le deuxieme est le tableau
         * implode(' AND ', $tableau);
         */

        $list_champs = implode(' AND ', $champs);

        //var_dump($list_champs);
        return $this->requete("SELECT * FROM $this->table WHERE $list_champs", $valeurs)->fetchAll();
    }
    /**
     * Fonction pour recuperer les donnees dela bd par id comme critere
     * @param integer $id
     * @return  mixed
     */
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id=?", [$id])->fetch();
    }
    /**
     * La fonction pour l'enregistrement des donnees dans la base des donnees
     * @return void
     */
    public function create()
    {

        $champs = []; //un tableu dynamique qui contiendra les champs de la requete
        $inter = []; //un tableau qui contiendra les points d'interrogation
        $valeurs = []; //un tableau qui contiendra les valeurs ou VALUES
        //on boucle sur notre object 
        foreach ($this as $key => $value) {
            if ($value !== null && $key != 'Db' && $key != 'table') {
                //INSERT INTO table (list_champs) VALUES (?,?,?,?);
                $champs[] = $key;
                $inter[] = "?";
                $valeurs[] = $value;
            }
        }
        //on transforme le deux tableaux en chaine de caractere
        $list_champs = implode(', ', $champs);
        $list_inter = implode(', ', $inter);
        //on ecrit notre requette
        return $this->requete("INSERT INTO {$this->table} ({$list_champs}) VALUES ({$list_inter})", $valeurs);
    }
    /**
     * La fonction de mise en jour des informations de la base des donnees
     * @return void
     */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        foreach ($this as $key => $value) {
            if ($value !== null && $key != 'Db' && $key != 'table') {
                //UPDATE Table SET list_champ=? WHERE id=?
                $champs[] = "$key = ?";
                $valeurs[] = $value;
            }
        }
        //l'id de notre table
        $valeurs[] = $this->id;

        //on converti notre tableau en chaine de caractere
        $list_champs = implode(', ', $champs);

        //on lance notre requette

        return $this->requete("UPDATE {$this->table} SET $list_champs WHERE id=?", $valeurs);
    }
    /**
     * La fonction pour supprimer les donnees dans notre base des donnees
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id=?", [$id]);
    }

    /**
     * La fonction pour l'execution de nos requettes (prepare ou query)
     * @param string $sql La requette 
     * @param array|null $attribut les attributs de la requette
     * @return PDOStatement
     */
    public function requete(string $sql, array $attribut = null)
    {
        $this->Db = Db::getIstance();

        if ($attribut !== null) {
            $query = $this->Db->prepare($sql);
            $query->execute($attribut);
            return $query;
        } else {
            $query = $this->Db->query($sql);
            return $query;
        }
    }
    /**
     * La fonction d'hydratation des nos objets
     *
     * @param mixed $donnees
     * @return $this
     */
    public function hydrate($donnees)
    {
        //on recupere le setter correspondant a la cle e.g titre->setTitre()
        foreach ($donnees as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}

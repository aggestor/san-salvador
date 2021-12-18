<?php

namespace Root\App\Models;

/**
 * Classe de base du mode.
 * @author Esaie MUHASA
 * @tutorial 
 * Dans le modele il est question d'utiliser le <strong>pattern Factory</strong>
 * Ainsi pour avoir une instace de l'une des classe du model, nous recomendons d'utiliser la @method getMode(@param $name)
 * <br/>Pour avoir une instance du Factory du model utiliser la @method @static getInstance ()  
 */
final class ModelFactory
{
    /**
     * @var ModelFactory
     */
    private static $instance;

    /**
     * Collection des instances des models
     * @var AbstractDbOccurenceModel[]
     */
    private $models = array();

    /**
     */
    private function __construct()
    {
    }

    /**
     * Revoie une reference vers l'instance de la fabrique de base du modele des donnees
     * @return ModelFactory
     */
    public static function getInstance(): ModelFactory
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * revoie une reference vers le model dont le nom est en parametre
     * @param string $name le nom du model doit etre un nom simple de la classe du namespace \Root\Models\Objects\
     * @throws ModelException
     * @return \Root\Models\AbstractDbOccurenceModel
     */
    public function getModel(string $name)
    {

        foreach ($this->models as $key => $model) { //Recherche d'une reference
            if ($key == $name) {
                return $model;
            }
        }

        //$className = '\\Root\\Models\\'.ucfirst($name).'Model';
        $className = '\\Root\\App\\Models\\' . ucfirst($name) . 'Model';
        $classFileName = (__DIR__) . '\\' . ucfirst($name) . 'Model.php';
        // var_dump($classFileName);
        // die();

        if (!file_exists($classFileName)) {
            throw new ModelException("Aucun modele pour {$name} n'est accessible");
        }

        $this->models[$name] = new $className();
        return $this->models[$name];
    }
}

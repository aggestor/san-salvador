<?php
namespace Root\Controllers\Validators;

use Root\Models\Objects\DBOccurence;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractValidator
{
    
    const DEFAULT_IMAGE_MAX_SIZE = 1024 * 1024;
    
    const FIELD_ID = "id";
    /**
     * collection des messages d'erreurs
     * un tableau associatif
     * @var array
     */
    protected $errors = [];
    
    /**
     * message final apres validation
     * @var string
     */
    protected $caption;
    
    /**
     * message specifique apre validation soit lors de la validation d'un formulaire
     * @var string
     */
    protected $message;
    
    /**
     * creation d'une occurence apres validation des donnees en provenance d'un formulaire
     * @return DBOccurence
     */
    public abstract function createAfterValidation ();
    
    
    /**
     * Mis en jours d'une occurence apre validation des donnees envoyer depuis le formulaire
     * @return DBOccurence
     */
    public abstract function updateAfterValidation ();
    
    /**
     * supression d'un occurence dans la bdd.
     * @return DBOccurence l'occurence suprimeee
     */
    public abstract function deleteAfterValidation ();
    
    /**
     * revoie la collection d'erreurs
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    
    /**
     * Ajour d'un message d'erreur dans le dictionnaire des message d'erreurs
     * @param string $name clee du message
     * @param string $message message d'erreur
     * @return AbstractValidator
     */
    protected function addError (string $name, string $message) : AbstractValidator {
        $this->errors[$name] = $message;
        return $this;
    }
    
    /**
     * verification d'un message d'erreur.
     * dans le cas ou @param $name == null, alors verifie s'il y a aumoin un message d'erreur
     * @param string $name
     * @return bool
     */
    public function hasError (?string $name = null) : bool {
        if ($name == null) {
            return !empty($this->getErrors());
        }
        return array_key_exists($name, $this->getErrors());;
    }

    /**
     * @return string
     */
    public function getCaption() : ?string
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getMessage() : ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message) : void
    {
        $this->message = $message;
    }
    
    /**
     * ce champ est obligaoire
     * @param mixed $value
     * @throws \RuntimeException
     */
    protected function notNullable ($value) : void {
        if ($this->isNull($value)) {
            throw new \RuntimeException("Ce champ est obligatoire");
        }
    }
    
    /**
     * cette valeur est-elle null ou vide????
     * @param mixed $value
     * @return bool
     */
    protected function isNull ($value) : bool {
        if ($value == null || ((is_string($value) || is_array($value)) && empty($value))) {
            return true;
        }
        
        return false;
    }
    
    /**
     * validation d'un identifiant
     * @param string $id
     * @throws \RuntimeException
     */
    protected function validationId ($id ) : void {
        $this->notNullable($id);
    }
    
    /**
     * 
     * @param DBOccurence $object
     * @param string $id
     */
    protected function processingId (DBOccurence $object, $id) : void {
        try {
            $this->validationId($id);//validation du contenue de ID
        } catch (\RuntimeException $e) {
            $this->addError(self::FIELD_ID, $e->getMessage());//capture du message d'erreurr lors dela validation
        }
        
        $object->setId($id);
    }
    
    /**
     * @param array $image
     * @param bool $nullable
     */
    protected function validationImage ($image, bool $nullable=false) : void {
        $img = new UploadFile($image);
        
        if(!$nullable && !$img->isFile()) {
            throw new \RuntimeException("Assurez-vous d'avoir uploader une image");
        }
        
        if (!$nullable && !$img->isImage()) {
            throw new \RuntimeException("le fichier uploader doit être une image");
        }
        
        if (!$nullable && $img->getSize() > self::DEFAULT_IMAGE_MAX_SIZE) {
            throw new \RuntimeException("Le fichier est trop volumineux");
        }
        
    }

}


<?php

namespace Root\App\Controllers\Validators;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class UploadFile
{

    const IMG_EXTENSIONS = ['.jpg', '.png', '.jpeg'];
    /**
     * table des information concernant le fichier uploader
     * @var array
     */
    private $metadata = [];

    /**
     * constrctueur d'initialisation
     * @param array $metadata
     */
    public function __construct(?array $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * est-ce une image???
     * @return bool
     */
    public function isImage(): bool
    {
        if ($this->isFile()) {
            foreach (self::IMG_EXTENSIONS as $ext) {
                if ($this->getExtension() == strtolower($ext) || $this->getExtension() == strtoupper($ext)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * est-ce un fichier???
     * @return bool
     */
    public function isFile(): bool
    {
        if (($this->metadata != null && !empty($this->metadata)) && array_key_exists("name", $this->metadata)
            && array_key_exists("tmp_name", $this->metadata)  && array_key_exists("size", $this->metadata)
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * revoie la taille du fichier
     * @return int
     */
    public function getSize(): int
    {
        if ($this->isFile()) {
            return $this->metadata['size'];
        }
        return 0;
    }

    /**
     * revoie le nom du fichier dans le dossier tmp du serveur
     * @return string|NULL
     */
    public function getTmpName(): ?string
    {
        if ($this->isFile()) {
            return $this->metadata['tmp_name'];
        }
        return null;
    }

    /**
     * revoie le nom du ficheir
     * @return string|NULL
     */
    public function getName(): ?string
    {
        if ($this->isFile()) {
            return $this->metadata["name"];
        }
        return null;
    }

    /**
     * Revoie l'extension du fichier
     * @return string|NULL
     */
    public function getExtension(): ?string
    {
        if ($this->isFile()) {
            return strrchr($this->getName(), ".");
        }
        return null;
    }
}

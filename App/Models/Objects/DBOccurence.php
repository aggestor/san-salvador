<?php

namespace Root\App\Models\Objects;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class DBOccurence
{
    const MYSQL_FORMATED_DATE = "Y-m-d";
    const MYSQL_FORMATED_TIME = "H:i:s";
    
    /**
     * l'identifiant de l'occurence dans la bdd
     * @var string
     */
    protected  $id;

    /**
     * La date de creation de l'occurence
     * @var \DateTime
     */
    protected $recordDate;

    /**
     * l'heure de creation de l'ocurence
     * @var \DateTime
     */
    protected $timeRecord;

    /**
     * dernier date de modification
     * @var \DateTime
     */
    protected $lastModifDate;

    /**
     * @var \DateTime
     */
    protected $lastModifTime;

    /**
     */
    public function __construct(array $data = array())
    {
        $this->readData($data);
    }

    /**
     * pour charger les donnees en provenance de l'exterieur dans l'objet (l'hydratation de l'objet)
     * on peut directement passer par un tableau associeatif
     * @param array $data
     */
    protected function readData(array $data = array()): void
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    /**
     * Lecture d'une date ou heure (la date doit etre soit un objet de type DateTime)
     * @param string|\DateTime $date
     * @return \DateTime|NULL
     */
    protected function readDate($date): ?\DateTime
    {
        if ($date instanceof \DateTime || $date == null) {
            return $date;
        }
        return new \DateTime($date);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getRecordDate(): ?\DateTime
    {
        return $this->recordDate;
    }
    
    /**
     * renvoie la date d'enregistrement formater
     * @param string $format
     * @return string|NULL
     */
    public function getFormatedRecordDate (?string $format=null) : ?string  {
        $format = $format === null? self::MYSQL_FORMATED_DATE : $format;
        return $this->getRecordDate()!=null? $this->getRecordDate()->format($format) : null;
    }

    /**
     * @return \DateTime
     */
    public function getTimeRecord(): ?\DateTime
    {
        return $this->timeRecord;
    }
    
    /**
     * renvoie l'heure d'enregistrement formater
     * @param string $format
     * @return string|NULL
     */
    public function getFormatedTimeRecord (?string $format=null) : ?string  {
        $format = $format === null? self::MYSQL_FORMATED_TIME : $format;
        return $this->getTimeRecord()!=null? $this->getTimeRecord()->format($format) : null;
    }

    /**
     * @return \DateTime
     */
    public function getLastModifDate(): ?\DateTime
    {
        return $this->lastModifDate;
    }
    
    /**
     * Renvoie la date de modification deja formater
     * @param string $format
     * @return string|NULL
     */
    public function getFormatedLastModifDate (?string $format=null) : ?string  {
        $format = $format === null? self::MYSQL_FORMATED_DATE : $format;
        return $this->getLastModifDate()!=null? $this->getLastModifDate()->format($format) : null;
    }

    /**
     * @return \DateTime
     */
    public function getLastModifTime(): ?\DateTime
    {
        return $this->lastModifTime;
    }
    
    /**
     * renvoie l'heure du derniere modification, formater
     * @param string $format
     * @return string|NULL
     */
    public function getFormatedLastModifTime (?string $format=null) : ?string  {
        $format = $format === null? self::MYSQL_FORMATED_TIME : $format;
        return $this->getLastModifTime()!=null? $this->getLastModifTime()->format($format) : null;
    }

    /**
     * @param string $id
     */
    public function setId ($id) : void
    {
        $this->id = $id;
    }

    /**
     * @param \DateTime $recordDate
     */
    public function setRecordDate($recordDate) : void
    {
        $this->recordDate = $this->readDate($recordDate);
    }

    /**
     * @param \DateTime $timeRecord
     */
    public function setTimeRecord($timeRecord) : void
    {
        $this->timeRecord = $this->readDate($timeRecord);
    }

    /**
     * @param \DateTime $lastModifDate
     */
    public function setLastModifDate($lastModifDate) : void
    {
        $this->lastModifDate = $this->readDate($lastModifDate);
    }

    /**
     * @param \DateTime $lastModifTime
     */
    public function setLastModifTime($lastModifTime) : void
    {
        $this->lastModifTime = $this->readDate($lastModifTime);
    }
    
    /**
     * @return string
     */
    public function __toString () : string {
        return $this->getId()!=null? $this->getId() : "";
    }
}

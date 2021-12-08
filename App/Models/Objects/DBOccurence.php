<?php
namespace Root\Models\Objects;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class DBOccurence
{
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
    protected $recordTime;
    
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
    protected function readData (array $data = array()) : void {
        foreach ($data as $key => $value) {
            $method = "set".ucfirst($key);
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
    protected function readDate($date) : ?\DateTime {
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
    public function getRecordDate() : ?\DateTime
    {
        return $this->recordDate;
    }

    /**
     * @return \DateTime
     */
    public function getRecordTime() : ?\DateTime
    {
        return $this->recordTime;
    }

    /**
     * @return \DateTime
     */
    public function getLastModifDate() : ?\DateTime
    {
        return $this->lastModifDate;
    }

    /**
     * @return \DateTime
     */
    public function getLastModifTime() : ?\DateTime
    {
        return $this->lastModifTime;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \DateTime $recordDate
     */
    public function setRecordDate($recordDate)
    {
        $this->recordDate = $this->readDate($recordDate);
    }

    /**
     * @param \DateTime $recordTime
     */
    public function setRecordTime($recordTime)
    {
        $this->recordTime = $this->readDate($recordTime);
    }

    /**
     * @param \DateTime $lastModifDate
     */
    public function setLastModifDate($lastModifDate)
    {
        $this->lastModifDate = $this->readDate($lastModifDate);
    }

    /**
     * @param \DateTime $lastModifTime
     */
    public function setLastModifTime($lastModifTime)
    {
        $this->lastModifTime = $this->readDate($lastModifTime);
    }

}


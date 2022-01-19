<?php
namespace Root\App\Models\Objects;
/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class Member extends DBOccurence
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $email;
    
    /**
     * @var string
     */
    protected $phone;
    
    /**
     * @var string
     */
    protected $password;
    
    /**
     * confirmation de reception du mail
     * @var boolean
     */
    protected $validationEmail;
    
    /**
     * @var string
     */
    protected $photo;
    
    
    /**
     * L'etat du compte. bor savoir si le compte est activee/ou pas du tout
     * @var boolean
     */
    protected $status;
    /**
     * token pour la confirmation du compte
     * @var string
     */
    protected $token;
    
    
    /**
     * @param boolean $status
     */
    public function setStatus($status) : void
    {
        $this->status = $status;
    }
    
    
    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }
    
    /**
     * aliace de @method isStatus()
     * @return bool|NULL
     */
    public function getStatus () : ?bool {
        return $this->isStatus();
    }    
    
    
    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * @return boolean
     */
    public function isValidationEmail() :?bool
    {
        return $this->validationEmail;
    }
    
    /**
     * alias de la @method isValidationEmail
     * @return bool|NULL
     */
    public function getValidationEmail ()  : ?bool {
        return $this->isValidationEmail();
    }

    /**
     * @param string $name
     */
    public function setName($name) : void
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) : void
    {
        $this->password = $password;
    }

    /**
     * @param boolean $validationEmail
     */
    public function setValidationEmail($validationEmail) : void
    {
        $this->validationEmail = $validationEmail;
    }
    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\Objects\DBOccurence::__toString()
     */
    public function __toString(): string
    {
        return "{$this->getName()} : {$this->getEmail()}";
    }


}


<?php

namespace Root\App\Models;

class UserModel extends Models
{
    protected $id;
    protected $user_name;
    protected $email;
    protected $phone;
    protected $user_password;
    protected $sponsor;
    protected $side;
    protected $status;
    protected $record_date;
    protected $record_time;
    protected $accountStatus;

    public function __construct()
    {
        $this->table = "users";
    }

    public function findByName(string $nom)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE user_name=?", [$nom])->fetch();
    }
    public function findByMail(string $mail)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE email=?", [$mail])->fetch();
    }
    public function findByPhone(string $phone)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE phone=?", [$phone])->fetch();
    }
    public function setSession()
    {
        $_SESSION['users'] = [
            'id' => $this->id,
            'name' => $this->user_name,
            'mail' => $this->email
        ];
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_name
     */
    public function getUser_name()
    {
        return $this->user_name;
    }

    /**
     * Set the value of user_name
     *
     * @return  self
     */
    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of sponsor
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set the value of sponsor
     *
     * @return  self
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get the value of side
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Set the value of side
     *
     * @return  self
     */
    public function setSide($side)
    {
        $this->side = $side;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of record_date
     */
    public function getRecord_date()
    {
        return $this->record_date;
    }

    /**
     * Set the value of record_date
     *
     * @return  self
     */
    public function setRecord_date($record_date)
    {
        $this->record_date = $record_date;

        return $this;
    }

    /**
     * Get the value of record_time
     */
    public function getRecord_time()
    {
        return $this->record_time;
    }

    /**
     * Set the value of record_time
     *
     * @return  self
     */
    public function setRecord_time($record_time)
    {
        $this->record_time = $record_time;

        return $this;
    }

    /**
     * Get the value of accountStatus
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }

    /**
     * Set the value of accountStatus
     *
     * @return  self
     */
    public function setAccountStatus($accountStatus)
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    /**
     * Get the value of user_password
     */
    public function getUser_password()
    {
        return $this->user_password;
    }

    /**
     * Set the value of user_password
     *
     * @return  self
     */
    public function setUser_password($user_password)
    {
        $this->user_password = $user_password;

        return $this;
    }
}

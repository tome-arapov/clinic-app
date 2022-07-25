<?php

namespace clinic;
require_once __DIR__."/DB.php";
use clinic\DB;

class User extends DB 
{
    protected $id;
    private $email;
    private $password;
    protected $table = ['user'];
    protected $columns = ['email','password'];

    public function __construct($fields)
    {
        $this->setEmail($fields['email'] ?? '');
        $this->setPassword($fields['password'] ?? '');
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
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
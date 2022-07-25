<?php

namespace clinic;
require_once __DIR__."/DB.php";
use clinic\DB;

class Patient extends DB {

    protected $id;
    private $clinic_id;
    private $name;
    private $email;
    private $phone_number;
    private $address;
    private $medical_condition;
    private $blood_type;
    protected $table = 'patient';
    protected $columns = ['clinic_id','name','email','phone_number','address','medical_condition','blood_type'];

    public function __construct($fields)
    {
        $this->setClinic_id($fields['clinic_id'] ?? '');
        $this->setName($fields['name'] ?? '');
        $this->setEmail($fields['email'] ?? '');
        $this->setPhone_number($fields['phone_number'] ?? '');
        $this->setAddress($fields['address'] ?? '');
        $this->setMedical_condition($fields['medical_condition'] ?? '');
        $this->setBlood_type($fields['blood_type'] ?? '');
    }

    /**
     * Get the value of clinic_id
     */ 
    public function getClinic_id()
    {
        return $this->clinic_id;
    }

    /**
     * Set the value of clinic_id
     *
     * @return  self
     */ 
    public function setClinic_id($clinic_id)
    {
        $this->clinic_id = $clinic_id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

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
     * Get the value of phone_number
     */ 
    public function getPhone_number()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @return  self
     */ 
    public function setPhone_number($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of medical_condition
     */ 
    public function getMedical_condition()
    {
        return $this->medical_condition;
    }

    /**
     * Set the value of medical_condition
     *
     * @return  self
     */ 
    public function setMedical_condition($medical_condition)
    {
        $this->medical_condition = $medical_condition;

        return $this;
    }

    /**
     * Get the value of blood_type
     */ 
    public function getBlood_type()
    {
        return $this->blood_type;
    }

    /**
     * Set the value of blood_type
     *
     * @return  self
     */ 
    public function setBlood_type($blood_type)
    {
        $this->blood_type = $blood_type;

        return $this;
    }
}
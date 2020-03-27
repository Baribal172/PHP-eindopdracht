<?php

class User{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    
    

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
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

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

    public function registerUser()
    {
        /**connect to database */
        /**echo $con ? 'connected' : 'not connected'; */
        $conn = new PDO('mysql:host=www29.totaalholding.nl;dbname=bariba1q_PHP buddy', "bariba1q_Glenn", "Ne6aT*fBMp7&");
        /**TO ADD PDO EXCEPTION CONNECTION FAILED */

        $sql = "INSERT INTO users (first_name, last_name, email) VALUES (:firstname, :lastname, :email)";

    }
}
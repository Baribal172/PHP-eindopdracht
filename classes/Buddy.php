<?php 
include_once(__DIR__ . "/Db.php");

class Buddy{
    private $user_one;
    private $user_two;
    public $status;
    

    /**
     * Get the value of user_one
     */ 
    public function getUser_one()
    {
        return $this->user_one;
    }

    /**
     * Set the value of user_one
     *
     * @return  self
     */ 
    public function setUser_one($user_one)
    {
        $this->user_one = $user_one;

        return $this;
    }

    /**
     * Get the value of user_two
     */ 
    public function getUser_two()
    {
        return $this->user_two;
    }

    /**
     * Set the value of user_two
     *
     * @return  self
     */ 
    public function setUser_two($user_two)
    {
        $this->user_two = $user_two;

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
}
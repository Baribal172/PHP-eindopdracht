<?php 
include_once(__DIR__ . "/Db.php");

class Buddy{
    private $user_one;
    private $user_two;
    public $status;
    //status is 
    //0 	Pending
    //1 	Accepted
    //2 	Declined
    //https://www.codedodle.com/2014/12/social-network-friends-database.html
    
    public $actionUserId;
    
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

    /**
     * Get the value of actionUserId
     */ 
    public function getActionUserId()
    {
        return $this->actionUserId;
    }

    /**
     * Set the value of actionUserId
     *
     * @return  self
     */ 
    public function setActionUserId($actionUserId)
    {
        $this->actionUserId = $actionUserId;

        return $this;
    }
    public function sendBuddyRequest(){
        $user_one = $this->getUser_one();
        $user_two = $this->getUser_two();
        $conn = Db::getConnection();

        $statement = $conn->prepare("INSERT into Buddy (user_one_id, user_two_id, action_user_id) VALUES (:userOneId, :userTwoId, :actionUserId)");
        $statement->bindValue(":userOneId",$user_one);
        $statement->bindValue(":userTwoId",$user_two);
        $statement->bindValue(":actionUserId",$user_one);
        $statement->execute();

    }
}
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

    public function getBuddyStatus(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * from Buddy where user_one_id = '".$_SESSION['id']."' OR user_two_id = '".$_SESSION['id']."';");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['status'];
    }

    public function getBuddyActionUserId(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * from Buddy where user_one_id = '".$_SESSION['id']."' OR user_two_id = '".$_SESSION['id']."';");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['action_user_id'];
    }
    public function checkBuddyRequest(){
        $status = $this->getBuddyStatus();
        $actionUserId = $this->getBuddyActionUserId();
        $result = $this->getBuddyName();
        $reason = $this->getDeclineReason();
        if($status == '2'){
            if(isset($reason)){
                echo "Je bent geen buddy geworden met $result omdat $reason";
            }else{
                echo "Je bent geen buddy geworden met $result";
            }
        }else{
            if($status == '0'){
                if($actionUserId == $_SESSION['id']){
                    echo "Je wacht op het antwoord van $result";
                }
                else{
                    echo "Je hebt een verzoek van $result, je kan in de tekstbalk een reden geven waarom je decline duwt, maar niet verplicht";
                    echo '<input type="submit" id="btnAccept" name="btnAccept" value="accept" />';
                    echo '<input type="submit" id="btnDecline" name="btnDecline" value="decline" />';
                    echo '<input type="text" id="reason" name="reason">';
                }
            }
            elseif($status == '1'){
                echo "Je bent een buddy met  $result";
            }
        }
     
        
    }
    public function getDeclineReason(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("Select declineReason From Buddy WHERE user_two_id = '".$_SESSION['id']."' or user_one_id = '".$_SESSION['id']."';");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['declineReason'];

    }
    public function acceptRequest(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE Buddy set status = '1' WHERE user_two_id = '".$_SESSION['id']."';");
        $statement->execute();
    }

    public function declineRequest(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE Buddy set status = '2' WHERE user_two_id = '".$_SESSION['id']."';");
        $statement->execute();
    }
    public function getBuddyName(){
        $actionUserId = $this->getBuddyActionUserId();
        $conn = Db::getConnection();

        if($actionUserId == $_SESSION['id']){
            $statement = $conn->prepare("SELECT first_name
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_two_id = u1.id
            WHERE Buddy.user_one_id ='".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $result = $result['first_name'];
        }else{
            $statement = $conn->prepare("SELECT first_name
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_one_id = u1.id
            WHERE Buddy.user_two_id = '".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            $result = $result['first_name'];
        }
        return $result;
    }

}
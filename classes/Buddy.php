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
        $result = $this->getBuddy();
        $result = $result['first_name'];
        $reason = $this->getDeclineReason();
        if($status == '2'){
            if(isset($reason)){
                echo "Je bent geen buddy geworden met $result omdat $reason";
                echo '<input type="submit" id="btnDelete" name="btnDelete" value="delete request" />';

            }else{
                echo "Je bent geen buddy geworden met $result";
                echo '<input type="submit" id="btnDelete" name="btnDelete" value="delete" />';

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
    public function deleteRequest(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("DELETE FROM Buddy WHERE user_two_id = '".$_SESSION['id']."'or user_one_id = '".$_SESSION['id']."';");
        $statement->execute();
    }
    public function getRelationId(){
        $conn = Db::getConnection();
        $actionUserId = $this->getBuddyActionUserId();

        if($actionUserId == $_SESSION['id']){
            $statement = $conn->prepare("SELECT Buddy.id
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_two_id = u1.id
            WHERE Buddy.user_one_id ='".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }else{
            $statement = $conn->prepare("SELECT Buddy.id
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_one_id = u1.id
            WHERE Buddy.user_two_id = '".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);                
        }
            return $result;
    }
    public function getBuddy(){
        $actionUserId = $this->getBuddyActionUserId();
        $conn = Db::getConnection();

        if($actionUserId == $_SESSION['id']){
            $statement = $conn->prepare("SELECT *
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_two_id = u1.id
            WHERE Buddy.user_one_id ='".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }else{
            $statement = $conn->prepare("SELECT *
            FROM Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_one_id = u1.id
            WHERE Buddy.user_two_id = '".$_SESSION['id']."';");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);                
        }
        return $result;
    }
    public function searchBuddy(){
        $query = htmlspecialchars($_GET['query']);
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT *
        FROM Interests
        LEFT JOIN user_interest ON Interests.interest_id = user_interest.interest_id
        LEFT JOIN Users ON user_interest.user_interest_id = Users.user_interest_id
        WHERE interest_name LIKE '%' :setQuery '%'");
        $statement->bindValue(":setQuery",$query);
        $statement->execute();
        $result = '';
        while($row = $statement->fetch()) {
            $result .= '<li>' . $row['first_name'] . " " . $row['last_name'] .'</li>' .
            '<form action="" method="post">
                <button type="submit" name="buddyRequest" value='.$row['id'] . '>Send buddy request</button>
            </form>';
    }
    echo $result;
    }
}
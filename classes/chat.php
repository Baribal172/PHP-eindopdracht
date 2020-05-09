<?php 
include_once(__DIR__ . "/Db.php");

class Chat{
    private $sender;
    private $reciever;
    private $timestamp;
    private $message;
    private $buddyId;

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of reciever
     */ 
    public function getReciever()
    {
        return $this->reciever;
    }

    /**
     * Set the value of reciever
     *
     * @return  self
     */ 
    public function setReciever($reciever)
    {
        $this->reciever = $reciever;

        return $this;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @return  self
     */ 
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
        /**
     * Get the value of buddyId
     */ 
    public function getBuddyId()
    {
        return $this->buddyId;
    }

    /**
     * Set the value of buddyId
     *
     * @return  self
     */ 
    public function setBuddyId($buddyId)
    {
        $this->buddyId = $buddyId;

        return $this;
    }
    public function addMessage(){
        $sender = $this->getSender();
        $reciever = $this->getReciever();
        $message = $this->getMessage();
        $timestamp = $this->getTimestamp();
        $buddyId = $this->getBuddyId();
        $conn = Db::getConnection();

        $statement = $conn->prepare("INSERT into Chat (sender, reciever, timestamp, message,buddyId) VALUES (:sender, :reciever, :timestamp, :message, $buddyId)");
        $statement->bindValue(":sender",$sender);
        $statement->bindValue(":reciever",$reciever);
        $statement->bindValue(":message",$message);
        $statement->bindValue(":timestamp",$timestamp);
        $statement->execute();
    }

    public function getConversation(){
        $buddyId = $this->getBuddyId();
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * from Chat where buddyId = $buddyId");
        $statement->execute();
        $message = '';

       
        while($row = $statement->fetch()) {
            $stm = $conn->prepare("SELECT first_name from Users where id = :sender");
            $stm->bindValue(":sender",$row['sender']);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $message .= '<li class="message">' . $result['first_name'] . ': ' . $row['message'] . '</li><span>(' . $row['timestamp'] . ')</span>';
            
         } 
        echo $message;
    }
}
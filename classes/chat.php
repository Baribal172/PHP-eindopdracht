<?php 
include_once(__DIR__ . "/Db.php");

class Chat{
    private $id;
    private $sender;
    private $reciever;
    private $timestamp;
    private $message;
    private $buddyId;
    private $emoji;

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
      /**
     * Get the value of emoji
     */ 
    public function getEmoji()
    {
        return $this->emoji;
    }

    /**
     * Set the value of emoji
     *
     * @return  self
     */ 
    public function setEmoji($emoji)
    {
        $this->emoji = $emoji;

        return $this;
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
            $message .= '<div class="message" > <h5>'. $result['first_name'] . ':</h5>
            <p> ' . $row['message'] . $row['emoji'] . '</p> 
            <div class="emojis">
            <a class="emoji" id='. $row['id'] . ' href="">😊</a>
            <a class="emoji" id='. $row['id'] . ' href="">😂</a>
            <a class="emoji" id='. $row['id'] . ' href="">❤</a>
            <a class="emoji" id='. $row['id'] . ' href="">😍</a>
            <a class="emoji" id='. $row['id'] . ' href="">😒</a>
            <span class="tmp">(' . $row['timestamp'] . ')</span> 
            <br>
            -----------------------------------------------------------
            </div></div>';
         } 
        echo $message;
    }

    public function saveEmoji(){
        $emoji = $this->getEmoji();
        $id = $this->getId();
        $conn = Db::getConnection();
       
        $statement = $conn->prepare("UPDATE Chat set emoji = :emoji WHERE id = :id");
        $statement->bindValue(":id",$id);
        $statement->bindValue(":emoji",$emoji);
        $statement->execute();

    }

 
}
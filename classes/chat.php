<?php 
include_once(__DIR__ . "/Db.php");

class Message{
    private $sender;
    private $reciever;
    private $timestamp;
    private $message;

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
}
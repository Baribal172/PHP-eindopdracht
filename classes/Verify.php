<?php
include_once(__DIR__ . "/Db.php");

class Verify {

    private $email;
    private $hash;


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
     * Get the value of hash
     */ 
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */ 
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    public function verifyEmail(){
    
        $email = $this->getEmail();
        $hash = $this->getHash();

        if(!$email == '' && !$hash == ''){
            $conn = Db::getConnection();
            $email = $this->getEmail();
            $hash = $this->getHash();

            $statement = $conn->prepare("select email, hash, activated FROM Users WHERE email = :email AND hash = :hash AND activated = 0");
            $statement->bindValue(":email", $email);
            $statement->bindValue(":hash", $hash);
            $statement->execute();

            $match = $statement->fetch(PDO::FETCH_ASSOC);

            if ($statement->rowCount() > 0) {
            $statement = $conn->prepare("update Users set activated = 1 where email = :email AND hash = :hash");
            $statement->bindValue(":email", $email);
            $statement->bindValue(":hash", $hash);
            $statement->execute();

            header('Location: login.php');

            }
        }
}
}
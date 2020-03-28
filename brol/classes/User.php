<?php

class User
{
  
    public function save()
    {
        $conn = new PDO('mysql:host=www29.totaalholding.nl;dbname=bariba1q_PHP buddy', "bariba1q_Glenn", "Ne6aT*fBMp7&");
        $sql = "INSERT INTO users (id) VALUES ('1')";
        $result = $conn->query($sql);
        var_dump($result);
    }

    // public function getAllPosts()
    // {

    //     $conn = new PDO("mysql:host=localhost;dbname=imdstagram;port=3306", "root", "root");
    //     $statement = $conn->prepare("select * from posts where user_id = :userid");
    //     $userid = $this->getId();
    //     $statement->bindParam(":userid", $userid);
    //     $statement->execute();

    //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
    public function checkEmail()
    {
        // connection and query email 
        $statement_e = $this->db->prepare("
        SELECT * FROM users WHERE email ='" . $this->getEmail() . "'
        ");

        //check if email is already in database
        if (($statement_e->rowCount()) > 0) {
            throw new Exception("Email already in use!"); //not in use 
        }
        return true; //already in use
    }
    public function checkUser()
    {
        // connection and query email 
        $statement_u = $this->db->prepare("
        SELECT * FROM users WHERE username ='" . $this->getUsername() . "'
        ");

        //check if email is already in database
        if (($statement_u->rowCount()) > 0) {
            throw new Exception("Username already in use!"); //not in use
        }
        return true; //already in use
    }
}

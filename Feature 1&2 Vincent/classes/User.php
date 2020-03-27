<?php

class User
{
    private $username;
    private $id;
    private $email;
    private $password;


    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

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
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
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

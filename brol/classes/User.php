<?php

class User
{
  

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

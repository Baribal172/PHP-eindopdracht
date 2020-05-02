<?php

include_once(__DIR__ . "/Db.php");


class Match {
    
    private $arrCurrentUser;
    private $arrOtherUser;


    /**
     * Get the value of arrCurrentUser
     */ 
    public function getArrCurrentUser()
    {
        return $this->arrCurrentUser;
    }

    /**
     * Set the value of arrCurrentUser
     *
     * @return  self
     */ 
    public function setArrCurrentUser($arrCurrentUser)
    {
        $this->arrCurrentUser = $arrCurrentUser;

        return $this;
    }

    /**
     * Get the value of arrOtherUser
     */ 
    public function getArrOtherUser()
    {
        return $this->arrOtherUser;
    }

    /**
     * Set the value of arrOtherUser
     *
     * @return  self
     */ 
    public function setArrOtherUser($arrOtherUser)
    {
        $this->arrOtherUser = $arrOtherUser;

        return $this;
    }



    public function getUserInterests() {
        /**connect to database */
        $conn = Db::getConnection();


        $query = "SELECT interest_id FROM user_interest, Users WHERE user_interest.user_interest_id = Users.user_interest_id";
        $statement = $conn->prepare($query);
        $statement->execute();

        $arrCurrentUser = $this->getArrCurrentUser();
        $arrCurrentUser = $statement->fetchall(); 

        return $arrCurrentUser;
    }
    


    public function calculateMatch() {
        $arrCurrentUser = $this->getUserInterests();
        # $arrOtherUser = $this->getArrOtherUser();
        # $arrCurrentUser = array('1', '2', '4', '7');
        $arrOtherUser = array('1', '3', '4', '8');

        var_dump($arrCurrentUser);
        var_dump($arrOtherUser);
        
        # $arr1 = array("Mobile","shop","software","hardware");
        # $arrOtherUser = array(1, 3, 4, 8);

        // Get values from arr2 which exist in arr1
        $overlap = array_intersect($arrCurrentUser, $arrOtherUser);

        // Count how many times each value exists
        $length = count($overlap);
        
        return $length;
        
    }

    
}
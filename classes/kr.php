<?php
include_once(_DIR_ . "/Db.php");

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $interests;

    private $emailUsedError; // email is al in gebruik
    private $emailNotStudentError; // email is geen studentenemail
    private $globalError; // algemene error

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
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

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


    /**
     * Get the value of interests
     */ 
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Set the value of interests
     *
     * @return  self
     */ 
    public function setInterests($interests)
    {
        $this->interests = $interests;

        return $this;
    }

    
    /**
     * Get the value of emailUsedError
     */ 
    public function getEmailUsedError()
    {
        return $this->emailUsedError;
    }

    /**
     * Set the value of emailUsedError
     *
     * @return  self
     */ 
    public function setEmailUsedError($emailUsedError)
    {
        $this->emailUsedError = $emailUsedError;

        return $this;
    }


    /**
     * Get the value of emailNotStudentError
     */ 
    public function getEmailNotStudentError()
    {
        return $this->emailNotStudentError;
    }

    /**
     * Set the value of emailNotStudentError
     *
     * @return  self
     */ 
    public function setEmailNotStudentError($emailNotStudentError)
    {
        $this->emailNotStudentError = $emailNotStudentError;

        return $this;
    }


    /**
     * Get the value of globalError
     */ 
    public function getGlobalError()
    {
        return $this->globalError;
    }

    /**
     * Set the value of globalError
     *
     * @return  self
     */ 
    public function setGlobalError($globalError)
    {
        $this->globalError = $globalError;

        return $this;
    }

    




    public function exportInterests () {

        $interest1 = $this->getInterests();

        $userDetails = array(61, "Mats", "Thys", "mats@email.com", "mijnpassword", "mijnbio", 0);

        // SEND INTERESTS TO DATABASE - TABLE USER

        // READ WHICH ONES ARE SELECTED
        if(!empty($_POST)){
            if (is_array($_POST['myinterests']) || is_object($_POST['myinterests'])) {
                
                try {
                    $conn = Db::getConnection();
                    echo "there is a connection!";
                } catch(Exception $error) {
                    echo $error;
                }

                /* 
                $getUserQuery = "SELECT * FROM Users WHERE id = $userId";

                $stmt = $conn->prepare($getUserQuery); 
                $stmt->execute(); 
                $userDetails = $stmt->fetch();
                

                foreach($userDetails as $user){
                    echo $user;
                }
                */
                # echo "Mijn id is = " .  $userDetails[0];

                
                
                
                
                # TOEVOEGEN VAN USER_INTEREST_ID AAN USER

                # We moeten de laatste id krijgen van tabel USER_INTEREST zodat we de volgende 
                # user_interest_id + 1 kunnen doen zodat we deze kunnen linken aan de volgende persoon die aangemaakt word

                # krijgen van aller laatste gebruikte id in tabel USER_INTEREST
                $lastUsedIdQuery = "SELECT IFNULL(MAX(user_interest_id), 0) AS last_used_id FROM user_interest;";
                $stmt = $conn->prepare($lastUsedIdQuery);
                $stmt->execute(); 
                $lastUsedId = $stmt->fetch();
                    
                # laatste id + 1
                $userInterestId = $lastUsedId[0] + 1;


                

                
                echo "hello this works :)))))))";
                foreach($_POST['myinterests'] as $selected_id){
                    echo "</br>UserInterestId=" . $userInterestId;
                    echo "</br>Selected_id=" . $selected_id;
                    $arrayInterests[] = $selected_id;
                    var_dump($arrayInterests);


                    # TOEVOEGEN VAN USER_INTEREST_ID/INTEREST_ID AAN USER_INTEREST
                    
                    $userInterestQuery = "INSERT INTO user_interest(user_interest_id, interest_id) VALUES (:setuserinterestid, :setinterestid);";
                    $statement = $conn->prepare($userInterestQuery);

                    $statement->bindValue(":setuserinterestid", $userInterestId);
                    $statement->bindValue(":setinterestid", $selected_id);
                    
                    
                    $statement->execute();


                    /*
                    $userInterestQuery = "INSERT INTO Users(interests) VALUES (:setuserinterestid, :setinterestid);";
                    $statement = $conn->prepare($userInterestQuery);

                    $statement->bindValue(":setuserinterestid", $userInterestId);
                    $statement->bindValue(":setinterestid", $selected_id);
                    
                    
                    $statement->execute();*/
                    
                }
                

                # toevoegen aan tabel
                
                $userAddUserInterestIdQuery = "UPDATE Users SET user_interest_id=:setuserinterestid WHERE id=:setuserid";
                $statement = $conn->prepare($userAddUserInterestIdQuery);
                    
                $statement->bindValue(":setuserinterestid", $userInterestId);
                $statement->bindValue(":setuserid", $userDetails[0]);
                    
                $statement->execute();

                /*
                # toevoegen aan tabel
                $addInterestIdQuery = "UPDATE Users SET interests='1' WHERE id='60'";
                $statement = $conn->prepare($addInterestIdQuery);
                    
                $statement->bindValue(":setuserinterestid", $userInterestId);
                $statement->bindValue(":setuserid", $userDetails[0]);
                $statement->bindValue(":setinterestsname", $arrayInterests);
                    
                $statement->execute()*/
                       
            }
            
        }

    }


    


}
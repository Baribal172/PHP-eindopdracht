<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $interests;
    private $newPassword;
    private $bio;
  
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
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }
      /**
     * Get the value of newPassword
     */ 
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @return  self
     */ 
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

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

    public function registerUser()
    {
        /**connect to database */
        /**echo $con ? 'connected' : 'not connected'; */
        $conn = Db::getConnection();
        /**TO ADD PDO EXCEPTION CONNECTION FAILED */

        /**bind values */
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $bio = $this->getBio();
        /*password encryption*/
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT);


        /******START VALIDATION STEPS BEFORE SUBMIT******/
        /*check if form has been submitted before starting validation*/
        /*this method is better than !empty because it checks if there has been a post request to the server, not possible if post request is empty*/
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            /*check if email is valid (and filled in)*/
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                /*check if email ends with student adress*/
                /*separate string at the # character*/
                $parts = explode('@', $email);
                /*use array_pop to define the domain as part of $domain and not $email anymore*/
                $domain = array_pop($parts);
                /*check if domain is student.thomasMore.be*/
                if ($domain == "student.thomasmore.be") {
                    /*check if email already exists*/
                    $statement = $conn->prepare("
                    SELECT email FROM Users WHERE email = ?");
                    $statement->bindValue(1, $email);
                    $statement->execute();

                    if ($statement->rowCount() > 0) {

                        echo "Emailadres is al in gebruik";
                        $this->setEmailUsedError("Emailadres is al in gebruik") ;

                    } else {

                        /*prepare to insert form input into database*/
                        $statement = $conn->prepare("insert into Users (first_name, last_name, email, password, bio) values (:firstname, :lastname, :email, :password, :bio)");

                        /* bind values from var to sql*/
                        $statement->bindValue(":firstname", $firstname);
                        $statement->bindValue(":lastname", $lastname);
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":password", $password);
                        $statement->bindValue(":bio", $bio);

                        /*execute input from fields to database*/
                        $result = $statement->execute();

                        //var_dump($result);
                    }
                } else {
                    echo "geen studenten email";
                    $this->setEmailNotStudentError("This is not a student mail") ;
                }
            } else {

                /*mail format invalid, create error message for user*/
                $this->setEmailNotStudentError("This is not a student mail") ;
                //$this->setError("Email is ongeldig") ;
            }

            /*check if submit worked*/

            /*submit didn't work, create error for user*/
        }
    }

    public function checkLogin()
    {
        /**connect to database */
        $conn = Db::getConnection();

        /**bind value */
        $email = $this->getEmail();
        $password = $this->getPassword();

        $statement = $conn->prepare("
        SELECT id, email, password FROM Users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();

        $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);

        if ($checkEmail !== false) {
            $checkPassword = password_verify($password, $checkEmail['password']);

            if ($checkPassword) {
                //log in
                header("Location: index.php");
                echo "ingelogd";
            } else {

            if($checkPassword){
                //log in & create session
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                //redirect user
                header("Location: home.php");
            }
            else {

                echo "password and email doesnt match";
            }
        }
    }
    public function updateUser()
    {
        $conn = Db::getConnection();

        $firstName = $this->getFirstname();
        $lastName = $this->getLastname();
        $bio = $this->getBio();
        $email = $this->getEmail();

        $statement = $conn->prepare("update Users set bio = :bio where email = :email;");
        $statement->bindValue(":bio", $bio);
        $statement->bindValue(":email",$email);
        $statement->execute();
    }


    public function checkPassword(){
        /**connect to database */
        $conn = Db::getConnection();

        /**bind value */
        $email = $this->getEmail();
        $password = $this->getPassword();
        $statement = $conn->prepare("
        SELECT password FROM Users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();

        $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);
        // echo $checkEmail['password'];
        // echo $this->getPassword();
       
        if ($checkEmail !== false) {
            $result = false;
            $checkPassword = password_verify($password, $checkEmail['password']);
            if ($checkPassword) {
                echo "true";
                $result = true;
            } else {
                echo "false";
            }    
            return $result;
        }
       
    }

    public function updatePassword(){
        if(!$this->checkPassword()){
            echo "passwoord mag niet geupdated worden";
        }else{
            $conn = Db::getConnection();

            /**bind value */
            $email = $this->getEmail();
            $newPassword = password_hash($this->getNewPassword(), PASSWORD_BCRYPT);
            $statement = $conn->prepare("
            UPDATE Users SET password = :newPassword WHERE email = :email");
            $statement->bindValue(':email', $email);
            $statement->bindValue(":newPassword", $newPassword);
            $statement->execute();
        }
       
    }


}


    public function exportInterests () {

        $interest1 = $this->getInterests();

        $userDetails = array(1, "Mats", "Thys", "mats@email.com", "mijnpassword", "mijnbio", 0);

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

                # krijgen van aller laatste gebruikte id in tabel USER_INTEREST
                $lastUsedIdQuery = "SELECT IFNULL(MAX(interest_id), 0) AS last_used_id FROM user_interest;";
                $stmt = $conn->prepare($lastUsedIdQuery);
                $stmt->execute(); 
                $lastUsedId = $stmt->fetch();
                    
                # laatste id + 1
                $userInterestId = $lastUsedId[0] + 1;

                
                echo "hello this works :)))))))";
                foreach($_POST['myinterests'] as $selected_id){
                    echo "</br>UserInterestId=" . $userInterestId;
                    echo "</br>Selected_id=" . $selected_id;


                    # TOEVOEGEN VAN USER_INTEREST_ID/INTEREST_ID AAN USER_INTEREST
                    $userInterestQuery = "INSERT INTO user_interest(user_interest_id, interest_id) VALUES (:setuserinterestid, :setinterestid);";
                    $statement = $conn->prepare($userInterestQuery);

                    $statement->bindValue(":setuserinterestid", $userInterestId);
                    $statement->bindValue(":setinterestid", $selected_id);
                    
                    
                    $statement->execute();
                    
                }

                # toevoegen aan tabel
                $userAddUserInterestIdQuery = "UPDATE Users SET user_interest_id=:setuserinterestid WHERE id=:setuserid";
                $statement = $conn->prepare($userAddUserInterestIdQuery);
                    
                $statement->bindValue(":setuserinterestid", $userInterestId);
                $statement->bindValue(":setuserid", $userDetails[0]);
                    
                $statement->execute();
                       
            }
            
        }

    }


    


}


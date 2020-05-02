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
        SELECT * FROM Users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();

        $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);

        if ($checkEmail !== false) {
            $checkPassword = password_verify($password, $checkEmail['password']);

            if($checkPassword !== false){
                //log in & create session
                session_start();
                $_SESSION['id'] = $checkEmail['id'];
                //redirect user
                header("Location: home.php");
            }
            else {

                echo "password and email doesnt match";
            }
        }
    }

    public function fetchUserData(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from Users where id = '".$_SESSION['id']."';");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $_SESSION['first_name'] = $result['first_name'];
        $_SESSION['last_name'] = $result['last_name'];
        $_SESSION['bio'] = $result['bio'];
        

    }

    public function updateUser(){
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
public function checkAvatarSize(){
    if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            return true;
        }
}
public function setAvatar(){
    $image = basename($_FILES['fileToUpload']['name']);
    $testSession = "33";
    $fileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $newName = "uploads/" . $testSession . "." . $fileType;
    $support = array('jpg','jpeg','png');
    // $fileNewName = "uploads/".$thi;
    if(in_array($fileType,$support)){
        echo "img toegelaten";
        echo $newName;
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)){
            // echo $_FILES["fileToUpload"]["name"] . "has been uploaded";
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE Users SET avatar = :avatarPath WHERE email = 'test3@student.thomasmore.be'");
            $statement->bindValue(":avatarPath",$newName);
            $statement->execute();
        } else{
            echo "fout";
        }
       
    } else{
        echo "Avatar has to be a jpg, jpeg or png file";
    }
    }
}

    



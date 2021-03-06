<?php
include_once(__DIR__ . "/Db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

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
    private $buddy;
    private $gender;
    private $role;
  
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

    /**
     * Get the value of buddy
     */ 
    public function getBuddy()
    {
        return $this->buddy;
    }

    /**
     * Set the value of buddy
     *
     * @return  self
     */ 
    public function setBuddy($buddy)
    {
        $this->buddy = $buddy;

        return $this;
    }

        /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

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
        $hash = md5( rand(0,1000) ); //hash for validation email URL


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
                        $statement = $conn->prepare("insert into Users (first_name, last_name, email, hash, password) values (:firstname, :lastname, :email, :hash, :password)");
                        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $this->getPassword()))
                        {
                            echo "Passwoord moet min. 8 karakters lang zijn en een cijfer (0-9) bevatten";
                        }
                        else {
                        /* bind values from var to sql*/
                        $statement->bindValue(":firstname", $firstname);
                        $statement->bindValue(":lastname", $lastname);
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":hash", $hash);
                        $statement->bindValue(":password", $password);
                        //$statement->bindValue(":bio", $bio);

                        /*execute input from fields to database*/
                        $result = $statement->execute();

                        $mail = new PHPMailer(true);

                            //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
                                $mail->isSMTP();                                            // Send using SMTP
                                $mail->Host       = 'php.baribal.me';                    // Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'noreply@php.baribal.me';                     // SMTP username
                                $mail->Password   = 'Ditisvoorphp';                               // SMTP password
                                $mail->SMTPSecure = "ssl"; 
                                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above

                                //Recipients
                                $mail->setFrom('noreply@php.baribal.me', 'GO BUD');
                                $mail->addAddress($email);     // Add a recipient

                                // Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Verify your email for GO BUD';
                                $mail->Body    = '
                
                                Thanks for signing up!
                                Your account has been created, you can login with the following credentials after you have activated your account by clicking the url below.
                                    
                                Please click this link to activate your account:
                                http://baribal.me/verify.php?email='.$email.'&hash='.$hash.'';
                                //CHANGE URL FOR NEW URL

                                $mail->send();
                                header("Location: thanks.php");
                        }
                    }
                } else {
                    echo "geen studenten email";
                    $this->setEmailNotStudentError("This is not a student mail") ;
                }
            } else {

                /*mail format invalid, create error message for user*/
                $this->setEmailNotStudentError("This is not a valid mail format") ;
                //$this->setError("Email is ongeldig") ;
            }

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

        $statement = $conn->prepare("select * FROM Users WHERE email = :email AND activated = 1");
        $statement->bindValue(':email', $email);
        $statement->execute();

        $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);

        if ($checkEmail !== false) {
            $checkPassword = password_verify($password, $checkEmail['password']);

            if($checkPassword !== false){
                //log in & create session
                session_start();
                $_SESSION['id'] = $checkEmail['id'];

                //redirect if profile empty
                $statement = $conn->prepare("select * from Users where id = '".$_SESSION['id']."';");
                $statement->execute();

                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if ($result['user_interest_id'] === NULL) {
                //redirect user
                header("Location: completeProfile.php");
                } 
                else {
                    header("Location: home.php");
                    }
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
        $_SESSION['email'] = $result['email'];
        $_SESSION['gender'] = $result['gender'];
        $_SESSION['role'] = $result['role'];
        

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
        $conn = Db::getConnection();
        $password = $this->getPassword();
        $statement = $conn->prepare("
        SELECT password FROM Users WHERE id = '".$_SESSION['id']."';");
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
            $newPassword = password_hash($this->getNewPassword(), PASSWORD_BCRYPT);
            $statement = $conn->prepare("
            UPDATE Users SET password = :newPassword  WHERE id = '".$_SESSION['id']."';");
            $statement->bindValue(":newPassword", $newPassword);
            $statement->execute();
        }
       
    }
    public function checkAvatarSize(){
        if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large. Max 500kb";
        return true;
            }
    }

    public function setAvatar(){
    $image = basename($_FILES['fileToUpload']['name']);
    $fileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $newName = "uploads/" . $_SESSION['id'] . "." . $fileType;
    $support = array('jpg','jpeg','png');
        if(in_array($fileType,$support)){
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)){
                echo $_FILES["fileToUpload"]["name"] . "has been uploaded";
                $conn = Db::getConnection();
                $statement = $conn->prepare("UPDATE Users SET avatar = :avatarPath WHERE id = '".$_SESSION['id']."';");
                $statement->bindValue(":avatarPath",$newName);
                $statement->execute();
        } else{
            echo "There was an error uploading, try again";
            }
       
    } else{
    echo "Avatar has to be a jpg, jpeg or png file";
    }
    }

    public static function getAvatar() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("Select avatar from Users WHERE id = '".$_SESSION['id']."';");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        echo $result['avatar'];
    }

    public function exportInterests () {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn = Db::getConnection();
            $userid = $_SESSION['id'];
            $userInterestId = $_SESSION['id'];

            $gender = $this->getGender();
            $role = $this->getRole();
            $buddy = $this->getBuddy();

            if (is_array($_POST['myinterests']) || is_object($_POST['myinterests'])) {
            
                foreach($_POST['myinterests'] as $selected_id){
                    $arrayInterests[] = $selected_id;

                    # TOEVOEGEN VAN USER_INTEREST_ID/INTEREST_ID AAN USER_INTEREST
                    $statement = $conn->prepare("iNSERT INTO user_interest(user_interest_id, interest_id) VALUES (:setuserinterestid, :setinterestid);");
                    $statement->bindValue(":setuserinterestid", $userInterestId);
                    $statement->bindValue(":setinterestid", $selected_id);
                    $statement->execute();
                    
                }
                
                # toevoegen aan tabel
                $statement = $conn->prepare("update Users SET user_interest_id=:setuserinterestid WHERE id=:setuserid");
                $statement->bindValue(":setuserinterestid", $userInterestId);
                $statement->bindValue(":setuserid", $userid);
                $statement->execute();
            }

            if (isset($_POST['gender'])) {
                $statement = $conn->prepare("update Users set gender=:gender WHERE id = '".$_SESSION['id']."';");
                $statement->bindValue(":gender", $gender);
                $statement->execute();
            }

            if (isset($_POST['role'])) {
                $statement = $conn->prepare("update Users set role=:role WHERE id = '".$_SESSION['id']."';");
                $statement->bindValue(":role", $role);
                $statement->execute();
            }
            if (isset($_POST['buddy'])){
                $statement = $conn->prepare("UPDATE Users SET buddy = :buddy WHERE id = '".$_SESSION['id']."';");
                $statement->bindValue(":buddy",$buddy);
                $statement->execute();

            }
            
        }
        header("Location: home.php");
    }



    public function fetchMatchFirstName(){
        $id = $this->matchUserId();
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT first_name from Users where id = :userId");
        $statement->bindValue(":userId",$id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        echo $result['first_name'];
    }
    public function matchUserId(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT u2.user_interest_id, COUNT(u1.interest_id) AS aantal
            FROM user_interest AS u1 INNER JOIN user_interest AS u2 ON (u1.interest_id = u2.interest_id) AND u1.user_interest_id = '".$_SESSION['id']."' AND '".$_SESSION['id']."' <> u2.user_interest_id
            GROUP BY u2.user_interest_id
            ORDER BY aantal DESC");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $resultId = $result['user_interest_id'];
            return $resultId;
    }
    public function matchUserAantal(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT u2.user_interest_id, COUNT(u1.interest_id) AS aantal
        FROM user_interest AS u1 INNER JOIN user_interest AS u2 ON (u1.interest_id = u2.interest_id) AND u1.user_interest_id = '".$_SESSION['id']."' AND '".$_SESSION['id']."' <> u2.user_interest_id
        GROUP BY u2.user_interest_id
        ORDER BY aantal DESC");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $resultAantal = $result['aantal'];
        echo $resultAantal;
}

    public function showNumbers(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select COUNT(*) usernumber from Users where activated = 1; select COUNT(*) matchnumber from Buddy where status = 1");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $_SERVER['usernumber'] = $result['usernumber'];

        $statement = $conn->prepare("select COUNT(*) matchnumber from Buddy where status = 1;");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $_SERVER['matchnumber'] = $result['matchnumber'];
    }


}



    



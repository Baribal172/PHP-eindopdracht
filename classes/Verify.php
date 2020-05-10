<?php
include_once(__DIR__ . "/Db.php");

class Verify {

    public function verifyEmail(){
        $conn = Db::getConnection();
        $email = ($_GET['email']);
        $hash = ($_GET['hash']);

        if(isset($_GET['email']) AND isset($_GET['hash'])){
            //Bind variables

            $statement = $conn->prepare("select email, hash, activated FROM Users WHERE email = :email AND hash =:hash AND activated = 0;");
            $statement->bindValue(":email",$email);
            $statement->bindValue(":hash", $hash);
            $result = $statement->execute;

        }else{
            echo "no get";
        }
    }
}




/**class Verify
{
    private $email;
    private $hash;


    public function sendEmail(){
        $host = "php.baribal.me";
        $username = "noreply@php.baribal.me";
        $password = "Ditisvoorphp";
        

        $to      = 'yaiza.ng@gmail.com'; // Send email to our user
        $subject = 'Verify your email for BUDDY'; // Give the email a subject 
        $message = '
                
        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by clicking the url below.
            
        Please click this link to activate your account:
        http://localhost:8887/PHP-eindopdracht/verify.php?email='.$email.'&hash='.$hash.'';
        //CHANGE URL FOR NEW URL
                                    
        $headers = 'From:noreply@php.baribal.me' . "\r\n"; // Set from headers
        $smtp = Mail::factory('smtp', array ('host' => $host,'auth' => true,'username' => $username,'password' => $password));
        mail($to, $subject, $message, $headers); // Send our email
    }
}*/


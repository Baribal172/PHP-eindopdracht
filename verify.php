<?php

include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. 
require 'vendor/autoload.php';

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'php.baribal.me';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'noreply@php.baribal.me';                     // SMTP username
    $mail->Password   = 'Ditisvoorphp';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('noreply@php.baribal.me', 'GO BUD');
    $mail->addAddress('yaiza.ng@gmail.com');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify your email for GO BUD';
    $mail->Body    = '
                
    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by clicking the url below.
        
    Please click this link to activate your account:
    http://localhost:8887/PHP-eindopdracht/verify.php?email='.$email.'&hash='.$hashVerify.'';
    //CHANGE URL FOR NEW URL

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_real_escape_string($_GET['hash']); // Set hash variable
}
else {
    echo "Oops something went wrong with validating your account ! Please try again.";
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your account</title>
</head>
<body>
    Email is verzonden.
</body>
</html>
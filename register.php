<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

/*check if form is empty or not*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1->setFirstname($_POST['firstName']);
    $user1->setLastname($_POST['lastName']);
    $user1->setEmail($_POST['email']);
    $user1->setPassword($_POST['password']);

    if($user1->registerUser()){
        $mail = new PHPMailer(true);

                            try {
                            //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                $mail->isSMTP();                                            // Send using SMTP
                                $mail->Host       = 'php.baribal.me';                    // Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'noreply@php.baribal.me';                     // SMTP username
                                $mail->Password   = 'Ditisvoorphp';                               // SMTP password
                                $mail->SMTPSecure = "ssl"; 
                                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above

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
                                header("Location: verify.php");
                            }
                                catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
    }
}

$emailUsedError = $user1->getEmailUsedError();
$emailNotStudentError = $user1->getEmailNotStudentError();
$globalError = $user1->getGlobalError();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creat an account</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
</head>

<body><div class="navbar">
    <ul>
        <li><a href="login.php">Log in</a></li>
    </ul>
</div>
<div id="register--page">
    <div class="backgroundContent">
        <img src="images/mockup.png" alt="mockup">
    </div>
    <div id="loginForm">
        <h1>Join GO BUD Today!</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
            <input type="text" name="firstName" id="firstname" placeholder="First name" value="<?php echo htmlspecialchars(!empty($_POST["firstName"]) ? $_POST["firstName"] : ''); ?>" class="textfield" required>
            <br>
            <input type="text" name="lastName" id="lastname" placeholder="Last name" value="<?php echo htmlspecialchars(!empty($_POST["lastName"]) ? $_POST["lastName"] : ''); ?>" class="textfield" required>
            <br>
            <!--<input type="text" name="bio" id="bio" value="<?php echo htmlspecialchars(!empty($_POST["bio"]) ? $_POST["bio"] : ''); ?>" class="textfield" required>-->
            <br>
            <input type="text" name="email" id="email" placeholder="Student email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
            <?php if(isset($emailUsedError)) :?>
            <p class="email--error"><?php echo $emailUsedError ?></p>
            <?php endif ?>
            <input type="password" placeholder="Password (min. 8 characters and one letter)" value="<?php echo htmlspecialchars(!empty($_POST["password"]) ? $_POST["password"] : ''); ?>" name="password" id="password" class="textfield" required>
            <br>
            <?php if(isset($globalError)) :?>
            <p class="email--error"><?php echo $globalError ?></p>
            <br>
            <?php endif ?>
            <input type="submit" id="submit">
        </form>
    </div>
    </div>
</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</script>
<?php

include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

/*check if form is empty or not*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1->setFirstname($_POST['firstName']);
    $user1->setLastname($_POST['lastName']);
    $user1->setEmail($_POST['email']);
    $user1->setPassword($_POST['password']);
    $user1->registerUser();
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
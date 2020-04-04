<?php
include_once(__DIR__ . "/classes/User.php");
$update = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update->setFirstname($_POST['firstName']);
    $update->setLastname($_POST['lastName']);
    $update->setEmail($_POST['email']);
    $update->setBio($_POST['bio']);
    $update->updateUser();
}
//Q: Can you update an e-mail? because we use the E-mail kind of like a key to match data in the db


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div id="profileForm">
        <h1>Edit profile</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
            <label for="firstName" class="label">First name</label>
            <input type="text" name="firstName" id="firstname" value="<?php echo htmlspecialchars(!empty($_POST["firstName"]) ? $_POST["firstName"] : ''); ?>" class="textfield" required>
            <br>
            <label for="lastName" class="label">Last name</label>
            <input type="text" name="lastName" id="lastname" value="<?php echo htmlspecialchars(!empty($_POST["lastName"]) ? $_POST["lastName"] : ''); ?>" class="textfield" required>
            <br>
            <label for="bio" class="label">Bio</label>
            <input type="text" name="bio" id="bio" value="<?php echo htmlspecialchars(!empty($_POST["bio"]) ? $_POST["bio"] : ''); ?>" class="textfield" required>
            <br>
            <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
            <br>
            <label for="password" class="label">Password</label>
            <input type="password" name="password" id="password" class="textfield" required>
            <br>
            <input type="submit" id="submit">
        </form>
    </div>



</body>

</html>
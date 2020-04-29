<?php
include_once(__DIR__ . "/classes/User.php");


if (isset($_POST["profile"])){
    $updateProfile = new User();
    $updateProfile->setEmail($_POST['email']);
    $updateProfile->setBio($_POST['bio']);
    $updateProfile->updateUser();
}

if (isset($_POST["password"])){
    $updatePassword = new User();
    $updatePassword->setEmail($_POST['email']);
    $updatePassword->setPassword($_POST['oldPassword']);
    $updatePassword->setNewPassword($_POST['newPassword']);
    $updatePassword->checkPassword();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
<h1>Profile page</h1>
<div class="profile">
<h1>voornaam</h1>
<h2>achternaam</h2>
<h2>email</h2>
<h2>bio </h2>


</div>
    <div id="profileForm">
        <h1>Edit profile</h1>
        <form method="post" action="" class="">
            <br>
            <label for="bio" class="label">Bio</label>
            <input type="text" name="bio" id="bio" value="<?php echo htmlspecialchars(!empty($_POST["bio"]) ? $_POST["bio"] : ''); ?>" class="textfield" >
            <br>
            <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
            <br>
            <input type="submit" id="submit" name="profile">
            <br>
        </form>
        <form method="post" action="" class="">
        <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
        <br>
            <label for="password" class="label">Old-Password</label>
            <input type="password" name="oldPassword" id="oldPassword" value="<?php echo htmlspecialchars(!empty($_POST["oldPassword"]) ? $_POST["oldPassword"] : ''); ?>" class="textfield" required>
        <br>
            <label for="password" class="label">New-Password</label>
            <input type="password" name="newPassword" id="newPassword" value="<?php echo htmlspecialchars(!empty($_POST["newPassword"]) ? $_POST["newPassword"] : ''); ?>" class="textfield" required>
        <br>
            <input type="submit" id="submit" name="password">
        </form>
    </div>



</body>

</html>
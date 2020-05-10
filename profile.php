<?php
include_once(__DIR__ . "/classes/User.php");
session_start();

if (isset($_SESSION['id'])) {

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
    // $updatePassword->checkPassword();
    $updatePassword->updatePassword();
}
if(isset($_POST['submitAvatar'])) {
    $avatar = new User();
    if(!$avatar->checkAvatarSize()){
        $avatar->setAvatar();
    }
   
}
$user = new User();
$showAvatar = $user->getAvatar();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
    <title>Profile</title>
</head>

<body>
<div class="navbar">
    <ul>
    <span class="welkom"><img src="<?php echo $howAvatar; ?>" alt="Uw avatar" height="20px"/> Welkom <?php echo $_SESSION['first_name']; ?></span>
        <li><a href="completeProfile.php">My profile</a></li><li><a href="logout.php">Log out</a></li>
</ul>
</div>
<div id="register--page">
<div class="container--page">

<h1>My profile</h1>
<div class="profile">
First name: <?php echo $_SESSION['first_name']?><br>
Last name: <?php echo $_SESSION['last_name']?><br>
Email: <?php echo $_SESSION['email']?><br>
Bio: <?php echo $_SESSION['bio']?><br>

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
    <div class="upload">
    <form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitAvatar">
</form>
</div>
</div>
<img src="<?php echo $showAvatar; ?>" alt="" />
</div>


    <?php
}
else {
    header("Location: login.php");
}
?>
</body>
</html>
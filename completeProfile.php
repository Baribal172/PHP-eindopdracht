<?php
session_start();
include_once(__DIR__ . "/classes/Interests.php");
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");

if (isset($_SESSION['id'])) {

$result = new Interests();
$user = new User();
$result = $result -> showInterests();
$showAvatar = $user->getAvatar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user -> setInterests($_POST ["myinterests"]);
    $user -> getInterests();
    $user->setGender($_POST['gender']);
    $user->setRole($_POST['role']);
    $user->setBuddy(($_POST['buddy']));
    $interest = $user -> exportInterests();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
    <title>Complete profile</title>
</head>
<body>
<?php
        include_once("nav.php");
?>
<div id="register--page">
<div class="container--page">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
            <h1>Complete your profile to find the best buddy</h1>

            <div class="characteristic characteristic-gender">
                <label for="gender" class="title">Gender</label>
                <div id="gender">
                    <input type="radio" id="male" class="radio-btn" name="gender" value="male" required>
                    <label for="male" class="lbl-gender">Male</label>
                    <input type="radio" id="female" class="radio-btn" name="gender" value="female">
                    <label for="female" class="lbl-gender">Female</label>
                    <input type="radio" id="other" class="radio-btn" name="gender" value="other">
                    <label for="other" class="lbl-gender">Other</label>
                </div>
            </div>
            
            <div class="characteristic characteristic-study">
                <label for="study" class="title">Are you a designer or developper?</label>
                <select name="role" id="role" required>
                    <option value="">Please select</option>
                    <option value="designer">Designer</option>
                    <option value="developer">Developer</option>
                </select>
            </div> 

            <div class="characteristic characteristic-study">
                <label for="buddy" class="title">Are you looking for a buddy or do you want to be a buddy?</label>
                <select name="buddy" id="buddy" required>
                    <option value="">Please select</option>
                    <option value="searching">I am looking for a buddy</option>
                    <option value="offering">I want to be a buddy</option>
                </select>
            </div>
            
            <div class="characteristic-hobby">
                <label for="hobby" class="title">Select your interests</label>
                <div id="hobby">
                    <?php foreach ($result as $row) : ?>
                    <input class="checkbox" type="checkbox" value="<?php echo $row['interest_id']; ?>" name="myinterests[]" id="<?php echo "checkid" . $row['interest_id']; ?>">
                    <label class="checklabel" for="<?php echo "checkid" . $row['interest_id']; ?>"><?php echo $row['interest_name']; ?></label>
                    <?php endforeach;?>
                </div>
            </div>
            <br>
            <input type="submit" id="completeProfileSubmit">
        </form>
    </div>
</div>
    <?php
}
else {
    header("Location: login.php");
}
?>
</body>
</html>
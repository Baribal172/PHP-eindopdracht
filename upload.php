<?php
    session_start();

include_once(__DIR__ . "/classes/User.php");

$user = new User();
if(isset($_POST['submitAvatar'])) {
     if(!$user->checkAvatarSize()){
 $user->setAvatar();
     }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitAvatar">
</form>
<?php 
echo User::getAvatar();
?>
<img src="<?php echo User::getAvatar(); ?>" alt="" />
</body>
</html>
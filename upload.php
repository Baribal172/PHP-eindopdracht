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
$conn = Db::getConnection();

$statement = $conn->prepare("SELECT avatar FROM Users WHERE email = 'test3@student.thomasmore.be'");
$statement->execute();
$img = $statement->fetch();
echo $img['avatar'];

?>
<img src="<?php echo $img['avatar']; ?>" alt="" />
</body>
</html>
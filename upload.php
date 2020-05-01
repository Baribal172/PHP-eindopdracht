<?php
    session_start();

include_once(__DIR__ . "/classes/User.php");

// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//     echo "Sorry, only JPG, JPEG & PNG files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//         $conn = Db::getConnection();
//         $statement = $conn->prepare("UPDATE Users SET avatar = 'uploads/eend.jpg' WHERE email = 'test3@student.thomasmore.be'");
//         $statement->execute();
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
// }
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
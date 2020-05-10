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

</body>
</html>
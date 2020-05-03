<?php
include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_real_escape_string($_GET['hash']); // Set hash variable
}
else {
    echo "Oops something went wrong with validating your account ! Please try again.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your account</title>
</head>
<body>
    
</body>
</html>
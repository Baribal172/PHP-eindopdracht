<?php
session_start();
include_once(__DIR__ . "/classes/User.php");

if (isset($_SESSION['id'])) {
    $user1 = new User();
    $id = $_SESSION['id'];

    echo ($_SESSION['id']);

?>   
    Welcome <b><?php echo $firstname; ?></b>, You have successfully logged in!<br>
                Click to <a href="./logout.php" class="logout-button">Logout</a>

<?php
}
else {
?> 
    <h1>sessie niet gemaakt</h1>
<?php
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
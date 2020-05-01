<?php
session_start();
include_once(__DIR__ . "/classes/User.php");

if (isset($_SESSION['id'])) {

    $conn = Db::getConnection();
    $statement = $conn->prepare("
    SELECT * FROM Users WHERE email = :email");
    $firstname = $statement->fetch(PDO::FETCH_ASSOC);

?>   
    Welcome <b><?php echo $firstname; ?></b>, You have successfully logged in!<br>
                Click to <a href="./logout.php" class="logout-button">Logout</a>

<?php
}
else {
?> 
    <h1>niet ingelogd</h1>
<?php
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
You are connected
</head>
<body>
    
</body>
</html>
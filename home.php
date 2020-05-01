<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    
    echo '<a href="./logout.php">Déconnection</a>';
}
else {
    echo "test werk niet";
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
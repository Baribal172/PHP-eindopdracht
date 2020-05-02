<?php
session_start();
include_once(__DIR__ . "/classes/User.php");

if (isset($_SESSION['id'])) {

   echo ($_SESSION['id']);
}
else {
    echo "geen sessie";
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
<?php
include_once(__DIR__ . "/classes/User.php");
session_start();

echo $_SESSION['id'];

if(isset($_GET['query'])){
        $query = $_GET['query'];

        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM Users WHERE (first_name LIKE '%".$query."%') OR (last_name LIKE '%".$query."%')");
        $statement->execute();
        // $result = $statement->fetchAll();
        // var_dump($result);
        while($row = $statement->fetch()) {
            
            echo "<li>".$row['first_name'].$row['last_name']."</li>";
           
        }
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search</title>
    </head>
    <body>
        <form action="" method="GET">
            <input type="text" name="query"/>
            <input type="submit" value="search"/>
        </form>
    </body>
</html>
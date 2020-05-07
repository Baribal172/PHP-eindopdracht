<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");

session_start();

// echo $_SESSION['id'];

if(isset($_GET['query'])){
        $query = htmlspecialchars($_GET['query']);
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM Users WHERE (first_name LIKE '%' :setQuery '%') OR (last_name LIKE '%' :setQuery '%')");
        $statement->bindValue(":setQuery",$query);
        $statement->execute();
        // $result = $statement->fetchAll();
        // var_dump($result);
      
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    echo $_POST['buddyRequest'];
    $buddy = new Buddy();
   
    $userOne = $_SESSION['id'];
    $userTwo = $_POST['buddyRequest'];
   
    $buddy->setUser_one($userOne);
    $buddy->setUser_two($userTwo);
    echo $userOne;
    echo $userTwo;
    $buddy->sendBuddyRequest();

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
        <?php 
        while($row = $statement->fetch()) {?>

        <li><?php echo $row['first_name'].$row['last_name'].$row['id']?></li>
        <form action="" method="post">
            <button type="submit" name="buddyRequest" value="<?php echo $row['id']?>">Send buddy request</button>
        </form>
        <?php } ?>
        </body>
</html>
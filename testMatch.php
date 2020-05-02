<?php
    include_once(__DIR__ . "/classes/match.php");


    $arrCurrentUser = new Match();
    $arrCurrentUser = $arrCurrentUser -> getUserInterests();


    foreach ($arrCurrentUser as $row) {
        var_dump($row);
    }


    $calculateMatch = new Match();
    $calculateMatch = $calculateMatch -> calculateMatch();
    echo $calculateMatch;    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
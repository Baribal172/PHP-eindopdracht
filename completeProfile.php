<?php

    include_once(__DIR__ . "/classes/Interests.php");
    include_once(__DIR__ . "/index.php");

    $result = new Interests();
    $result = $result -> showInterests();
    
    if (isset($_POST['submit'])) {
        $result = $result -> exportInterests();
    }

    /* 
    Om te kijken of de variabelen binnen komen

    foreach($result as $row) {
        echo $row['interest_id'];
        echo $row['interest_name'];
    }
    */


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Complete profile</title>
</head>
<body>
    <div class="completeProfile--content">
        <form action="index.php" method="post">
            <h1>Complete your profile</h1>

            <div class="characteristic characteristic-gender">
                <label for="gender" class="title">Gender</label>
                <div id="gender">
                    <input type="radio" id="male" class="radio-btn" name="gender" value="male">
                    <label for="male" class="lbl-gender">Male</label>
                    <input type="radio" id="female" class="radio-btn" name="gender" value="female">
                    <label for="female" class="lbl-gender">Female</label>
                    <input type="radio" id="other" class="radio-btn" name="gender" value="other">
                    <label for="other" class="lbl-gender">Other</label>
                </div>
            </div>
            
            <div class="characteristic characteristic-study">
                <label for="study" class="title">Designer of developper?</label>
                <select name="study" id="study">
                    <option value="designer">Designer</option>
                    <option value="developer">Developer</option>
                </select>
            </div>
            
            <div class="characteristic-hobby">
                <label for="hobby" class="title">Interests</label>
                <div id="hobby">
                    <?php foreach ($result as $row) : ?>
                    <input class="checkbox" type="checkbox" name="<?php echo "checkname" . $row['interest_id']; ?>" id="<?php echo "checkid" . $row['interest_id']; ?>">
                    <label class="checklabel" for="<?php echo "checkid" . $row['interest_id']; ?>"><?php echo $row['interest_name']; ?></label>
                    <?php endforeach;?>
                </div>
            </div>
            <input type="submit" id="completeProfileSubmit">
        </form>
    </div>
</body>
</html>
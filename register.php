<?php
include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

/*check if form is empty or not*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1->setFirstname($_POST['firstName']);
    $user1->setLastname($_POST['lastName']);
    $user1->setEmail($_POST['email']);
    $user1->setPassword($_POST['password']);
}

$user1->registerUser();
header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registerUser</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="loginForm">
        <h1>Create account</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
            <label for="firstName" class="label">First name</label>
            <input type="text" name="firstName" id="firstname" value="<?php echo htmlspecialchars(!empty($_POST["firstName"]) ? $_POST["firstName"] : ''); ?>" class="textfield" required>
            <br>
            <label for="lastName" class="label">Last name</label>
            <input type="text" name="lastName" id="lastname" value="<?php echo htmlspecialchars(!empty($_POST["lastName"]) ? $_POST["lastName"] : ''); ?>" class="textfield" required>
            <br>
            <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
            <br>
            <label for="password" class="label">Password</label>
            <input type="text" name="password" id="password" class="textfield" required>
            <br>
            <input type="submit" id="submit">
        </form>
    </div>
</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
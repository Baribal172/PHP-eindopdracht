<?php
include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1->setEmail($_POST['email']);
    $user1->setPassword($_POST['password']);
    $user1->checkLogin();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP buddyApp</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
</head>

<body>
    <div class="navbar">
    <ul>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Log in</a></li>
    </ul>
</div>
<div id="register--page">
    <div class="backgroundContent">
        <img src="images/mockup.png" alt="mockup">
    </div>
    <div id="loginForm">
                <h1>Login</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
            <?php if (isset($error)) : ?>
                <div class="form__error">
                    <p>
                        <?php echo $error ?>
                    </p>
                </div>
            <?php endif ?>

            <div class="form__field">
                <label for="Email">Studentenmail</label>
                <input type="text" id="Email" name="email" placeholder="Jouw email" value="<?php echo htmlspecialchars(!empty($_POST["email"]) ? $_POST["email"] : ''); ?>" class="textfield" required>
            </div>
            <div class="form__field">
                <label for="Password">Paswoord</label>
                <input type="password" id="Password"  placeholder="Jouw password" value="<?php echo htmlspecialchars(!empty($_POST["password"]) ? $_POST["password"] : ''); ?>" name="password" class="textfield" required>
            </div>

            <div class="form__field">
<br>
            <input type="submit" id="submit">
        </form>
    </div>
    </div>
</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('_reCAPTCHA_site_key_', {action: 'homepage'}).then(function(token) {
    ...
    });
});
</script>

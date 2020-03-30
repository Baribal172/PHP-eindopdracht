<?php
include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1->setEmail($_POST['email']);
    $user1->setPassword($_POST['password']);
    $user1->checkLogin();}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP buddyApp</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="loginForm">
        <div class="form form--login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 form__title>Login</h2>

                <?php if (isset($error)) : ?>
                    <div class="form__error">
                        <p>
                            <?php echo $error ?>
                        </p>
                    </div>
                <?php endif ?>

                <div class="form__field">
                    <label for="Email">Studentenmail</label>
                    <input type="text" id="Email" name="email" required> 
                </div>
                <div class="form__field">
                    <label for="Password">Password</label>
                    <input type="password" id="Password" name="password" required>
                </div>

                <div class="form__field">

                    <button type="submit">Login</button>

                </div>
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
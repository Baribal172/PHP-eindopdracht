<?php
include_once(__DIR__ . "/classes/User.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = Db::getConnection();
    $user = new User($conn);
    $user->setEmail($email);
    $user->setPassword($password);
    if ($user->checkLogin()) {
        header("Location: index.php");
    } else {
        echo "password and email doesnt match";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP buddyApp</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="netflixLogin">
        <div class="form form--login">
            <form action="" method="post">
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
                    <input type="text" id="Email" name="email">
                </div>
                <div class="form__field">
                    <label for="Password">Password</label>
                    <input type="password" id="Password" name="password">
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
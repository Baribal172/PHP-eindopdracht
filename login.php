<?php
include_once(__DIR__ . "/classes/User.php");

$user1 = new User();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        if ($user1->checkLogin($email, $password)) {
            echo "werkt";
            header("Location: index.php");
        } else {
            $error = "wachtwoord en email komen niet overeen";
        }
    } else {
        $error = "email en wachtwoord invullen";
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
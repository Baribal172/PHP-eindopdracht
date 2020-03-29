<?php

//nakijken of formulier verzonden is
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];

    try {
        //nakijken of de wachtwoorden correct zijn
        if ($security->passwordsAreSecure()) {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            echo "check";
            //check if email is in use
            if ($user->checkEmail()) {
                echo "email availbable";
                //check if username is already in use
                if ($user->checkUser()) {
                    echo "user available";
                    //register user
                    if ($user->register()) {
                        echo "registered";
                        $user->login();
                    }
                }
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

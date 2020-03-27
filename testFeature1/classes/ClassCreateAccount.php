<?php

    class CreateAccount {

        private $email;
        private $fullName;
        private $password;  

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of fullName
         */ 
        public function getFullName()
        {
                return $this->fullName;
        }

        /**
         * Set the value of fullName
         *
         * @return  self
         */ 
        public function setFullName($fullName)
        {
                $this->fullName = $fullName;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }



        //$user = new CreateAccount();
        // include_once('config.php'); // connection to database
        public function create() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // check if email is empty
                if (empty(trim($_POST["email"]))) {
                    $usernameError = "Please enter username!";
                } else {
                    $username = trim($_POST["email"]);
                    header ("location: /testIndex.php");
                }
    
                // check if full name is empty
                if (empty(trim($_POST["fullName"]))) {
                    $fullNameError = "Please enter full name!";
                } else {
                    $fullName = trim($_POST["fullName"]);
                }
    
                // check if password is empty
                if (empty(trim($_POST["password"]))) {
                    $passwordError = "Please enter password!";
                } else {
                    $password = trim($_POST["password"]);
                }
    
    
    
                
                // als er waarden zitten in email, fullName en password
                // (als deze velden zijn ingevuld)
                /*if (!empty($email) && !empty($fullName) && !empty($password)) {
                    try {
                        $conn = new PDO('mysql:host=localhost;dbname=buddyapptest', "root", "");
                        echo "Connection succes!";
                    }
                    catch (PDOException $error) {
                        echo "Not able to estabish connection :(";
                    }
                    
                }*/
            } 
        }
        

    }
    
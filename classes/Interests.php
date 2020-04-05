<?php

    include_once(__DIR__ . "/Db.php");
    include_once(__DIR__ . "/../completeProfile.php");
    class Interests {
        private $interestsId;
        private $interestsName;



        /**
         * Get the value of interestsId
         */ 
        public function getInterestsId()
        {
                return $this->interestsId;
        }

        /**
         * Set the value of interestsId
         *
         * @return  self
         */ 
        public function setInterestsId($interestsId)
        {
            $this->interestsId = $interestsId;

            return $this;
        }

        /**
         * Get the value of interestsName
         */ 
        public function getInterestsName()
        {
            return $this->interestsName;
        }

        /**
         * Set the value of interestsName
         *
         * @return  self
         */ 
        public function setInterestsName($interestsName)
        {
            $this->interestsName = $interestsName;

            return $this;
        }

        public function showInterests () {
            /**connect to database */
            /**echo $con ? 'connected' : 'not connected'; */
            try {
                $conn = Db::getConnection();
                echo "there is a connection!";
            } catch(Exception $error) {
                echo $error;
            }
            
            
            //aanmaken van de query (bedoeling = om alle interest namen uit de db te krijgen)
            $query = "SELECT * FROM Interests";
            $statement = $conn->prepare($query);
            //echo $statement;
            $statement->execute();

            $result = $statement->fetchall(); 

            return $result;
                
        }

        public function exportInterests () {
            // SEND INTERESTS TO DATABASE - TABLE USER

            // READ WHICH ONES ARE SELECTED
            if(isset($_POST['submit'])){
                foreach($_POST['checkname' . 1] as $selected){
                    echo $selected."</br>";

                    try {
                        $conn = Db::getConnection();
                        echo "there is a connection!";
                    } catch(Exception $error) {
                        echo $error;
                    }

                    $query = "UPDATE User SET interests=checkname1 WHERE id = interest_id";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                }
            }



            /*try {
                $conn = Db::getConnection();
                echo "there is a connection!";
            } catch(Exception $error) {
                echo $error;
            }

            $query = "INSERT INTO User (interests) VALUES ()";
            $statement = $conn->prepare($query);*/
        }
    }



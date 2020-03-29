<?php

    include_once(__DIR__ . "/Db.php");

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
                echo "cyka";
                /**connect to database */
                /**echo $con ? 'connected' : 'not connected'; */
                $conn = Db::getConnection();
                
                /**TO ADD PDO EXCEPTION CONNECTION FAILED */
                
                //aanmaken van de query (bedoeling = om alle interest namen uit de db te krijgen)
                $query = "SELECT interest_name FROM interests";
                
                
                $result = $conn->query($query);
                //loop om elke rij af te gaan, bij elke rij print de interest naam
                
                while($row = $result -> fetch_assoc()) { //problemen met fetch_assoc --> krijg deze niet inorde
                        echo "Name: " . $row["interest_name"];
                }

                
        }


    }



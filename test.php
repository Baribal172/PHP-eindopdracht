$user = new User();
    $user->setInterests($_POST['myInterests']);
    $user->getInterests();
    $user->setGender($_POST['gender']);
    $user->setRole($_POST['buddy']);

    $user-> exportInterests();


    public function exportInterests () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = Db::getConnection();
            session_start();
            $userid = $_SESSION['id'];
            $userInterestId = $_SESSION['id'];

            $gender = $this->getGender();
            $role = $this->getRole();

            if (isset($_POST['myInterests'])) {

                foreach($_POST['myInterests'] as $selected_id){
                    $arrayInterests[] = $selected_id;

                    # TOEVOEGEN VAN USER_INTEREST_ID/INTEREST_ID AAN USER_INTEREST
                    $statement = $conn->prepare("iNSERT INTO user_interest(user_interest_id, interest_id) VALUES (:setuserinterestid, :setinterestid);");

                    $statement->bindValue(":setuserinterestid", $userInterestId);
                    $statement->bindValue(":setinterestid", $selected_id);
                    $statement->execute();
                    
                }
                

                # toevoegen aan tabel
                $statement = $conn->prepare("update Users SET user_interest_id=:setuserinterestid WHERE id=:setuserid");
                    
                $statement->bindValue(":setuserinterestid", $userInterestId);
                $statement->bindValue(":setuserid", $userid);
                    
                $statement->execute();
            }

            if (isset($_POST['gender'])) {
                $statement = $conn->prepare("insert into Users (gender) values (:gender)");
                $statement->bindValue(":gender", $gender);
                $statement->execute();
            }

            if (isset($_POST['buddy'])) {
                $statement = $conn->prepare("insert into Users (role) values (:role)");
                $statement->bindValue(":role", $role);
                $statement->execute();
            }
            
        }

    }
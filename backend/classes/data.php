<?php 
    class Data {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        function getAccountList(){
            $key = "SELECT id, username, email, profile_picture, activated, role, date_created, company_name, contact_no, first_logged, is_pending, zip_code, country, state, city, address FROM accounts";


            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            
            return json_encode($rows);
        }

        function getAccountById($id){
            $key = "SELECT id, username, email, profile_picture, activated, role, date_created, company_name, contact_no, first_logged, is_pending, zip_code, country, state, city, address FROM accounts WHERE id='$id'";


            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();
            
            return $rows;
        }

        function getSuppliers(){
            $key = "SELECT id, username, email, profile_picture, activated, role, date_created, company_name, contact_no, first_logged, is_pending, zip_code, country, state, city, address FROM accounts WHERE role=2";


            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            
            return json_encode($rows);
        }


        function approveAccount($id){
            $key = "SELECT * FROM accounts WHERE id = BINARY '$id'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();

            if($count > 0){
                $key2 = "UPDATE accounts SET is_pending = 0 WHERE id = ?";
                $statement2 = $this->database->prepare($key2);
                $statement2->bind_param("i", $id);
                return $statement2->execute();
            }
        }

        function activateAccount($id){
            $key = "SELECT * FROM accounts WHERE id = BINARY '$id'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();
            
            if($count > 0){
                $key2 = "UPDATE accounts SET activated = 1 WHERE id = ?";
                $statement2 = $this->database->prepare($key2);
                $statement2->bind_param("i", $id);
                return $statement2->execute();
            }
        }

        function disableAccount($id){
            $key = "SELECT * FROM accounts WHERE id = BINARY '$id'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();
            
            if($count > 0){
                $key2 = "UPDATE accounts SET activated = 0 WHERE id = ?";
                $statement2 = $this->database->prepare($key2);
                $statement2->bind_param("i", $id);
                return $statement2->execute();
            }
        }


        function updateAccount($business, $street, $contact, $country, $city, $state, $zip){
            $id = $_SESSION['id'];
            $key = "UPDATE accounts SET company_name = ?, address = ?, contact_no = ?, country = ?, city = ?, state = ?, zip_code = ? WHERE id = $id";
            $statement = $this->database->prepare($key);
            $statement->bind_param("ssssssi", $business, $street, $contact, $country, $city, $state, $zip);
            return $statement->execute();
        }

        function getDocuments(){
            $id = $_SESSION['id'];
            $key = "SELECT * FROM authenticity where acc_id = $id";


            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            if ($count > 0) {
                $rows = $result->fetch_assoc();
                return $rows;
            }
            return 0;
        }

        public function addDocument($name, $date, $image){
            $target_dir = "assets/src/";
            $upload_status = false; 
            
            $file_type = strtolower(pathinfo($image['image']['name'], PATHINFO_EXTENSION));
            $file_name = "file-".uniqid(rand(), true) .".". $file_type;
            $target_file = $target_dir . $file_name;

            $check = getimagesize($image["image"]["tmp_name"]);

            if($check !== false){
                $upload_status = true;
            }else{
                $upload_status = false;
            }
            $id = $_SESSION['id'];
            if($upload_status){
                if(move_uploaded_file($image['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] ."/". $target_file)){
                    $row = $this->getDocuments(); 
                    if($row){
                        $files = json_decode($row['files'], true);
                        array_push($files, array("name" => $name, "image" => $file_name, "date" => $date, "verify" => 0));
                        $final = json_encode($files);
                        $key = "UPDATE authenticity SET files = '$final' WHERE acc_id = $id";

                        $statement = $this->database->prepare($key);
                        return $statement->execute();   
                        
                    }else{
                        $files = array();
                        array_push($files, array("name" => $name, "image" => $file_name, "date" => $date, "verify" => 0));
                        $final = json_encode($files);
                        $key = "INSERT INTO authenticity(acc_id, files) VALUES($id, '$final')";
                        $statement = $this->database->prepare($key);
                        return $statement->execute();   
                    }
                }
            }      
            
            return false;
        }

        function approvePO($id){
            $key = "UPDATE purchase_orders SET status = 1 WHERE id = $id";
            $statement = $this->database->prepare($key);
            return $statement->execute();
        }

        function declinePO($id){
            $key = "UPDATE purchase_orders SET status = 2 WHERE id = $id";
            $statement = $this->database->prepare($key);
            return $statement->execute();
        }

        function cancellPO($id){
            $key = "UPDATE purchase_orders SET status = 3 WHERE id = $id";
            $statement = $this->database->prepare($key);
            return $statement->execute();
        }
    }
?>
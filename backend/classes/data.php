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
    }
?>
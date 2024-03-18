<?php 
    class Authenticate {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        public function Login($username, $password){
            $password = hash_hmac('sha256', $password, 'transtrack');
            $key = "SELECT * FROM accounts WHERE username = BINARY '$username' AND password = BINARY '$password'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();
            if($count >= 1){
                if($rows['password'] == $password){
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['role'] = $rows['role'];
                    $_SESSION['ispending'] = $rows['is_pending'];
                    $_SESSION['activated'] = $rows['activated'];
                    return true;
                }
            }
            return false;
        }

        public function Apply($u, $e, $p, $cp, $bn, $pn, $country, $st, $city, $state, $zip){
            $key = "SELECT * FROM accounts WHERE username = BINARY '$u' OR email = BINARY '$e'";


            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if($count >= 1){
                foreach($rows as $row){
                    if($row['username'] == $u) {
                        return 2;
                    }
                }
                foreach($rows as $row){
                    if($row['email'] == $e) {
                        return 4;
                    }
                }
            }else{
                if($p == $cp) {
                    $key2 = "INSERT INTO accounts(username, password, email, company_name, contact_no, country, address, city, state, zip_code) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $statement2 = $this->database->prepare($key2);
                    $p = hash_hmac('sha256', $p, 'transtrack');
                    $statement2->bind_param("sssssssssi", $u, $p, $e, $bn, $pn, $country, $st, $city, $state, $zip);
                    if($statement2->execute()){
                        $_SESSION['username'] = $u;
                        $_SESSION['ispending'] = 1;
                        $_SESSION['activated'] = 0;
                        $_SESSION['role'] = 2;  
                        return true;
                    }
                }else{
                    return 3;
                }
            }
        }
    }
?>
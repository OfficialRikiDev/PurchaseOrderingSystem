<?php 
    class Authenticate {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        public function Login($username, $password){
            $key = "SELECT * FROM accounts WHERE username = BINARY '$username' AND password = BINARY '$password'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();
            if($count >= 1){
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $rows['id'];
                $_SESSION['role'] = $rows['role'];
                return true;
            }else{
                return false;
            }
        }
    }
?>
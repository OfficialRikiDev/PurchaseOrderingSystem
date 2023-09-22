<?php 
    class Authenticate {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        public function Login($username, $password){
            $key = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($this->database, $key);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if($count >= 1){
                $_SESSION['username'] = $username;
                return true;
            }else{
                return false;
            }
        }
    }

    class Website {
        private $database;

        function __construct($db){
            $this->database = $db;
        }

        public function getSettings(){
            $key = "SELECT * FROM settings WHERE id=1";
            $result = mysqli_query($this->database, $key);
            $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);

            return $rows;
        }
    }
?>
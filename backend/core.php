<?php 
    class Authenticate {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        public function Login($username, $password){
            $key = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;

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
            $key = "SELECT * FROM settings WHERE id = 1";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }


    class Notification {
        private $database;

        function __construct($db) {
            $this->database = $db;
        }

        
        public function timeElapsedSinceNow( $datetime, $full = false )
        {
            $now = new DateTime;
            $then = new DateTime( $datetime );
            $diff = (array) $now->diff( $then );
        
            $diff['w']  = floor( $diff['d'] / 7 );
            $diff['d'] -= $diff['w'] * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
        
            foreach( $string as $k => & $v )
            {
                if ( $diff[$k] )
                {
                    $v = $diff[$k] . ' ' . $v .( $diff[$k] > 1 ? 's' : '' );
                }
                else
                {
                    unset( $string[$k] );
                }
            }
        
            if ( ! $full ) $string = array_slice( $string, 0, 1 );
            return $string ? implode( ', ', $string ) . ' ago' : 'just now';
        }
        
        public function getNotifications($range){
            $key = "SELECT * FROM notifications WHERE id > ? ORDER BY id ASC LIMIT 5";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $range);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }
    }

    class Views {
        public function getView($name) {
            $name = preg_replace('/\s+/', '', $name);
            return @file_get_contents($_SERVER['DOCUMENT_ROOT']. "/views/{$name}.php") ? file_get_contents($_SERVER['DOCUMENT_ROOT']. "/views/{$name}.php") : "No content found.";
        }
    }
?>
<?php 
    

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

    class Account {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
        public function addAccount($user, $pass, $email, $role){
            $key = "SELECT COUNT(id) as c FROM accounts WHERE username = ? OR email = ?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("ss", $user, $email);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            if($rows['c'] == 0){
                $key2 = "INSERT INTO accounts(username, password, email, role) VALUES(?, ?, ?, ?)";
                $statement2 = $this->database->prepare($key2);
                $statement2->bind_param("sssi", $user, $pass, $email, $role);
                return $statement2->execute();
            }elseif($rows > 0){
                return 2;
            }else{
                return 0;
            }
        }

        public function getAccounts(){
            $key = "SELECT * FROM accounts ORDER BY role ASC";
            $statement = $this->database->prepare($key);
           // $statement->bind_param("i", $_SESSION['id']);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
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

    class Products {
        private $database;
        function __construct($db) {
            $this->database = $db;
        }

        public function getProducts(){
            $key = "SELECT products.*, accounts.id as aid, accounts.company_name, accounts.contact_no FROM products INNER JOIN accounts ON products.supplier = accounts.id WHERE products.supplier = ? ORDER BY products.quantity ASC";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $_SESSION['id']);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function listProducts(){
            $key = "SELECT products.*, accounts.id as aid, accounts.company_name, accounts.contact_no FROM products INNER JOIN accounts ON products.supplier = accounts.id ORDER BY products.quantity ASC";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function getProductInfo($id){
            $key = "SELECT * FROM products WHERE id = ?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            return $row;
        }

        public function updateProduct($id, $qty, $name, $desc, $brand, $price){
            $key = "UPDATE products SET quantity = ?, name = ?, description = ?, brand = ?, price = ? WHERE id = $id";
            $statement = $this->database->prepare($key);
            $statement->bind_param("isssd", $qty, $name, $desc, $brand, $price);
            return $statement->execute();
        }

        public function insertProductToList($qty, $brand, $nm, $desc, $price){
            $key = "SELECT COUNT(id) as c FROM products WHERE name = ? ";
            $statement = $this->database->prepare($key);
            $statement->bind_param("s", $nm);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            if($rows['c'] == 0){
                $key = "INSERT INTO products(supplier, quantity, brand, name, description, price) VALUES(?, ?, ?, ?, ?, ?)";
                $statement = $this->database->prepare($key);
                $statement->bind_param("iisssd", $_SESSION["id"], $qty, $brand, $nm, $desc, $price);
                return $statement->execute();
            }elseif($rows['c'] >= 1){
                return 2;
            }else{
                return 0;
            }
        }
    }

    class Inventory {
        private $database;
        function __construct($db) {
            $this->database = $db;
        }

        public function getUserInventory(){
            $key = "SELECT inventory.*, accounts.id as aid, accounts.company_name, accounts.contact_no FROM inventory INNER JOIN accounts ON inventory.current_holder = accounts.id ORDER BY inventory.date ASC";
            $statement = $this->database->prepare($key);
           // $statement->bind_param("i", $_SESSION['id']);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function insertItemInventory($qty, $brand, $nm, $desc){
            $key = "SELECT COUNT(id) as c FROM inventory WHERE name = ? ";
            $statement = $this->database->prepare($key);
            $statement->bind_param("s", $nm);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            if($rows['c'] == 0){
                $key = "INSERT INTO inventory(current_holder, quantity, brand, name, description) VALUES(?, ?, ?, ?, ?)";
                $statement = $this->database->prepare($key);
                $statement->bind_param("iisss", $_SESSION["id"], $qty, $brand, $nm, $desc);
                return $statement->execute();
            }elseif($rows['c'] >= 1){
                return 2;
            }else{
                return 0;
            }
        }

        public function getItemInfo($id){
            $key = "SELECT * FROM inventory WHERE id = ?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            return $row;
        }

        public function updateItemInventory($id, $qty, $name, $desc, $brand){
            $key = "UPDATE inventory SET quantity = ?, name = ?, description = ?, brand = ? WHERE id = $id";
            $statement = $this->database->prepare($key);
            $statement->bind_param("isss", $qty, $name, $desc, $brand);
            return $statement->execute();
        }
    }

    class Order {
        private $database;
        function __construct($db) {
            $this->database = $db;
        }

        public function insertRequest($data){
            $key = "INSERT INTO requests(itemData, created_by) VALUES('".$data."', ?)";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $_SESSION["id"]);
            return $statement->execute();
        }

        public function insertPO($data, $porfID){
            $key = "INSERT INTO purchase_orders(itemData, created_by, rf_id) VALUES('$data', ?, ?)";
            $statement = $this->database->prepare($key);
            $statement->bind_param("is", $_SESSION["id"], $porfID);
            if($statement->execute()){
                $key2 ="UPDATE requests SET status=1 WHERE id=?";
                $statement2 = $this->database->prepare($key2);
                $statement2->bind_param("i", $porfID);
                return $statement2->execute();
            }
            return false;
        }

        public function getRFS(){
            $key = "SELECT requests.*, accounts.username, accounts.company_name, accounts.contact_no FROM requests INNER JOIN accounts ON accounts.id=requests.created_by ORDER BY status ASC   ";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function getPOS(){
            $key = "SELECT purchase_orders.*, accounts.username, accounts.company_name, accounts.contact_no FROM purchase_orders INNER JOIN accounts ON accounts.id=purchase_orders.created_by ORDER BY status DESC   ";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function getFormData($id){
            $key = "SELECT requests.*, accounts.username, accounts.company_name, accounts.contact_no FROM requests INNER JOIN accounts ON accounts.id=requests.created_by WHERE requests.id = ? ORDER BY status ASC   ";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            return $rows;
        }
        public function getPOSFormData($id){
            $key = "SELECT * FROM purchase_orders WHERE id = ? ORDER BY status ASC   ";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            return $rows;
        }

        

        public function getItemData($id){
            $key = "SELECT * FROM products WHERE id = ?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            return $rows;
        }

        public function declineRequest($id){
            $key ="UPDATE requests SET status=2 WHERE id=?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $id);
            return $statement->execute();;
        }
    }

    class Views {
        public function getView($name) {
            $name = preg_replace('/\s+/', '', $name);
            return @file_get_contents($_SERVER['DOCUMENT_ROOT']. "/views/{$name}.php") ? file_get_contents($_SERVER['DOCUMENT_ROOT']. "/views/{$name}.php") : "No content found.";
        }
    }
    
?>
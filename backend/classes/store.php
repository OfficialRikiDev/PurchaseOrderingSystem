<?php 
    class Store {
        private $database;
        
        function __construct($db){
            $this->database = $db;
        }
    
        public function addItem($name, $price, $supplier, $description, $image){
            $target_dir = "assets/src/";
            $upload_status = false; 
            
            $file_type = strtolower(pathinfo($image['image']['name'], PATHINFO_EXTENSION));
            $file_name = uniqid(rand(), true) .".". $file_type;
            $target_file = $target_dir . $file_name;

            $check = getimagesize($image["image"]["tmp_name"]);

            if($check !== false){
                $upload_status = true;
            }else{
                $upload_status = false;
            }

            if($upload_status){
                if(move_uploaded_file($image['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] ."/". $target_file)){
                    $key = "INSERT INTO products(name, price, supplier, description, image) VALUES(?, ?, ?, ?, ?)";

                    $statement = $this->database->prepare($key);
                    $statement->bind_param("sssss", $name, $price, $supplier, $description, $file_name);
                    return $statement->execute();   
                }
            }      
            
            return false;
        }

        public function getAddedProducts(){
            $key = "SELECT * FROM products WHERE supplier = ?";
            $statement = $this->database->prepare($key);
            $statement->bind_param("i", $_SESSION['id']);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function getAllProducts(){
            $key = "SELECT * FROM products WHERE is_available = 1";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }

        public function getProductInfo($id){
            $key = "SELECT products.*, supplier.id, supplier.company_name FROM products INNER JOIN accounts as supplier ON supplier.id=products.supplier WHERE products.id = $id";
            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }
?>
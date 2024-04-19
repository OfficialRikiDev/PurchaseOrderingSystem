<?php 

    class Product {

        public $database;

        function __construct($db){
            $this->database = $db;
        }

        public function getProduct($id){
            $key = "SELECT * FROM products WHERE id = BINARY '$id'";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();

            if($count > 0){
                return $rows;
            }
        }
    }

?>
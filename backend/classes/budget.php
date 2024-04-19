<?php 

    class Budget extends Product {


        public function getBudget(){
            $key = "SELECT *,LAG(allocation, 1) OVER (ORDER BY id) AS prev_alloc FROM budget";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                return $rows;
            }
        }


        public function getThisMonthBudget(){
            $key = "SELECT * FROM budget WHERE id=(SELECT MAX(id) FROM `budget` WHERE MONTH(date) = MONTH(CURRENT_DATE()) LIMIT 1)";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();

            if($count > 0){
                return $rows;
            }
        }

        

        public function setMonthlyBudget($amount, $date){
            $id = $_SESSION['id'];
            $key = "INSERT INTO budget(allocation, date, set_by) VALUES ($amount, '$date', $id)";

            $statement = $this->database->prepare($key);
            return $statement->execute();
        }


        public function getAllocated(){
            $id = $_SESSION['id'];
            $key = "SELECT * FROM purchase_orders WHERE MONTH(date_created) = MONTH(CURRENT_DATE())";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                $allocated = 0;
                foreach($rows as $row){
                    $list = json_decode($row['itemData'], true);
                    foreach($list as $p){
                        $product = $this->getProduct($p['item_id']);
                        $allocated += $product['price'] * $p['amount'];
                    }
                    
                }
                return $allocated;
            }

            return 0;
        }

        public function getTodayAllocation(){
            $id = $_SESSION['id'];
            $key = "SELECT * FROM purchase_orders WHERE DAY(date_created) = DAY(CURRENT_DATE())";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                $allocated = 0;
                foreach($rows as $row){
                    $list = json_decode($row['itemData'], true);
                    foreach($list as $p){
                        $product = $this->getProduct($p['item_id']);
                        $allocated += $product['price'] * $p['amount'];
                    }
                    
                }
                return $allocated;
            }

            return 0;
        }
    }

?>
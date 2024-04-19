<?php 

    class Quota extends Product {


        public function getQuota(){
            $id = $_SESSION['id'];
            $key = "SELECT *,LAG(quota, 1) OVER (ORDER BY id) AS prev_alloc FROM quotations WHERE set_by = $id";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                return $rows;
            }
        }


        public function getThisMonthQuota(){
            $id = $_SESSION['id'];
            $key = "SELECT * FROM quotations WHERE id=(SELECT MAX(id) FROM `quotations` WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND set_by = $id  LIMIT 1) AND set_by = $id";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();

            if($count > 0){
                return $rows;
            }
        }

        

        public function setMonthlyQuota($amount, $date){
            $id = $_SESSION['id'];
            $key = "INSERT INTO quotations(quota, date, set_by) VALUES ($amount, '$date', $id)";

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
<?php 

    class Orders extends Product {
        public $database;
        
        function __construct($db){
            $this->database = $db;
        }

        public function getPurchaseOrder($id)
        {
            $key = "SELECT * FROM purchase_orders WHERE id = $id";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_assoc();

            if($count > 0){
                return $rows['itemData'];
            }
        }


        public function getPurchaseOrders2()
        {
            $sess_id = $_SESSION['id'];
            $key = "SELECT * FROM purchase_orders WHERE created_by = $sess_id ORDER BY id DESC";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                return $rows;
            }
            return;
        }

        public function getPurchaseOrders()
        {
            $sess_id = $_SESSION['id'];
            $key = "SELECT * FROM purchase_orders ORDER BY id DESC";

            $statement = $this->database->prepare($key);
            $statement->execute();
            $result = $statement->get_result();
            $count = $result->num_rows;
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if($count > 0){
                return $rows;
            }
            return;
        }
    
        public function getPOS($id)
        {
            $list = json_decode($this->getPurchaseOrder($id), true);
            if($list){
                foreach ($list as $a) {
                    $product = $this->getProduct($a['item_id']);
                    if($product){
                        echo '<tr class="hover">
                        <td class="flex">
                            <a href="/store/product/?prod_id='.$a['item_id'].'">
                            <div class="avatar">
                            <div class="w-24 rounded">
                                <img src="/assets/src/'.$product['image'].'" />
                            </div>
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                        
                            <div class="flex flex-col">
                                <span class="font-bold text-sm">'.$product['name'].'</span>
                                <span class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex gap-2">
                                <a></a>
                            </div>
                        </div>
                            </a>
                        </td>
                        <td>'.number_format($a['amount']).'</td>
                        <td>₱'.number_format($product['price'], 2).'</td>
                        <td class="prod_total">₱'.number_format($product['price'] * $a['amount'], 2).'</td>
                    </tr>';
                    };
                }
            }
        }

        public function getTotal($id){
            $list = json_decode($this->getPurchaseOrder($id), true);
            $total = 0;
            foreach ($list as $a) {
                $product = $this->getProduct($a['item_id']);
                $total += $product['price'] * $a['amount'];
            }
            return $total;
        }

    }
?>
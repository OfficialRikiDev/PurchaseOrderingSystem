<?php

class Cart extends Product
{
    public function getCart()
    {
        $id = $_SESSION['id'];
        $key = "SELECT * FROM cart WHERE id = BINARY '$id'";

        $statement = $this->database->prepare($key);
        $statement->execute();
        $result = $statement->get_result();
        $count = $result->num_rows;
        $rows = $result->fetch_assoc();

        if ($count > 0) {
            return json_encode(json_decode($rows['list'], true));
        } else {
            return json_encode(array());
        }
    }



    public function addToCart($item_id, $amount)
    {
        $id = $_SESSION['id'];
        $key = "SELECT * FROM cart WHERE id = BINARY '$id'";

        $statement = $this->database->prepare($key);
        $statement->execute();
        $result = $statement->get_result();
        $count = $result->num_rows;
        $rows = $result->fetch_assoc();

        if ($count > 0) {
            $list = json_decode($rows['list'], true);
            $found = false;
            for ($i = 0; $i < count($list); $i++) {
                if ($list[$i]['item_id'] == $item_id) {
                    $list[$i]['amount'] += $amount;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                array_push($list, array("item_id" => $item_id, "amount" => $amount));
            }

            $json = json_encode($list);
            $key2 = "UPDATE cart SET list = '$json' WHERE id = $id";
            $statement2 = $this->database->prepare($key2);
            if ($statement2->execute()) {
                return true;
            }
        } else {
            $list = array();

            array_push($list, array("item_id" => $item_id, "amount" => $amount));
            $json = json_encode($list);
            $key2 = "INSERT INTO cart(id, list) VALUES($id, '$json')";
            $statement2 = $this->database->prepare($key2);
            if ($statement2->execute()) {
                return true;
            }
        }
        return false;
    }

    public function getTotalCart(){
        $list = json_decode($this->getCart(), true);
        $total = 0;
        foreach ($list as $a) {
            $product = $this->getProduct($a['item_id']);
            $total += $product['price'] * $a['amount'];
        }
        return $total;
    }

    public function updateCart($item_id, $amount){
        $id = $_SESSION['id'];
        $key = "SELECT * FROM cart WHERE id = BINARY '$id'";

        $statement = $this->database->prepare($key);
        $statement->execute();
        $result = $statement->get_result();
        $count = $result->num_rows;
        $rows = $result->fetch_assoc();

        if ($count > 0) {
            $list = json_decode($rows['list'], true);
            $found = false;
            for ($i = 0; $i < count($list); $i++) {
                if ($list[$i]['item_id'] == $item_id) {
                    $list[$i]['amount'] = $amount;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                array_push($list, array("item_id" => $item_id, "amount" => $amount));
            }

            $json = json_encode($list);
            $key2 = "UPDATE cart SET list = '$json' WHERE id = $id";
            $statement2 = $this->database->prepare($key2);
            if ($statement2->execute()) {
                return true;
            }
        }
    }

    public function removeItemInCart($item_id){
        $id = $_SESSION['id'];
        $key = "SELECT * FROM cart WHERE id = BINARY '$id'";

        $statement = $this->database->prepare($key);
        $statement->execute();
        $result = $statement->get_result();
        $count = $result->num_rows;
        $rows = $result->fetch_assoc();

        if ($count > 0) {
            $list = json_decode($rows['list'], true);
            for ($i = 0; $i <= count($list); $i++) {
                if ($list[$i]['item_id'] == $item_id) {
                    array_splice($list, $i, 1);
                    break;
                }
            }

            $json = json_encode($list);
            $key2 = "UPDATE cart SET list = '$json' WHERE id = $id";
            $statement2 = $this->database->prepare($key2);
            if ($statement2->execute()) {
                return true;
            }
        }
    }

    public function showCart()
    {
        $list = json_decode($this->getCart(), true);
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
                        <a href="#" onclick="editQty('.$a['amount'].', '.$a['item_id'].')" class="font-semibold hover:text-red-500 text-ghost text-xs">Edit</a>
                        <a href="#" onclick="removeProductCart('.$a['item_id'].')" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
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

    public function submitCart()
    {
        $budget = new Budget($this->database);
        if($budget->getThisMonthBudget()['allocation'] >= $this->getTotalCart() + $budget->getAllocated()){
            $id = $_SESSION['id'];
            $cart = $this->getCart();
            if(count(json_decode($cart, true)) > 0){
                $key = "INSERT INTO purchase_orders(created_by, itemData) VALUES($id, '$cart')";

                $statement = $this->database->prepare($key);

                $key2 = "DELETE FROM cart WHERE id=$id";

                $statement2 = $this->database->prepare($key2);
                return  $statement->execute() && $statement2->execute();
            }else{
                return 0;
            }
        }else{
            return 3;
        }
    }
}

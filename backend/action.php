<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');

    /*ACCOUNT*/
        
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['login'])){
            $username = mysqli_real_escape_string($database->connection,$_POST['luser']);
            $password = mysqli_real_escape_string($database->connection,$_POST['lpass']);

            if($authenticate->Login($username, $password)){

                $_SESSION['isLoggedIn'] = true;
                header("Content-Type: application/json");
                echo json_encode(array('code' => 200, 'message' => 'Successful logged in.'));
                return;
            }else{
                header("Content-Type: application/json");
                echo json_encode(array('code' => 401, 'message' => 'Error. Wrong credentials.'));
                return;
            }
        }


        
        if(isset($_POST['apply'])){
            $username = mysqli_real_escape_string($database->connection,$_POST['username']);
            $email = mysqli_real_escape_string($database->connection,$_POST['email']);
            $password = mysqli_real_escape_string($database->connection,$_POST['password']);
            $repass = mysqli_real_escape_string($database->connection,$_POST['repassword']);
            $business = mysqli_real_escape_string($database->connection,$_POST['business_name']);
            $phone = mysqli_real_escape_string($database->connection,$_POST['phone']);
            $country = mysqli_real_escape_string($database->connection,$_POST['country']);
            $street = mysqli_real_escape_string($database->connection,$_POST['street']);
            $city = mysqli_real_escape_string($database->connection,$_POST['city']);
            $state = mysqli_real_escape_string($database->connection,$_POST['state']);
            $zip = mysqli_real_escape_string($database->connection,$_POST['zip']);

            $query = $authenticate->Apply($username, $email, $password, $repass, $business, $phone, $country, $street, $city, $state, $zip);
            if($query == 1){
                header("Content-Type: application/json");
                echo json_encode(array('code' => 200, 'message' => 'Application successful.'));
                return;
            }else if($query == 3){
                header("Content-Type: application/json");
                echo json_encode(array('code' => 401, 'message' => 'Password and confirm password did not match.'));
                return;
            }else if($query == 2){
                header("Content-Type: application/json");
                echo json_encode(array('code' => 401, 'message' => 'Username already exists.'));
                return;
            }else if($query == 4){
                header("Content-Type: application/json");
                echo json_encode(array('code' => 401, 'message' => 'Email already exists.'));
                return;
            }
        }

        if(isset($_POST['getSuppliers'])){
            echo $data->getSuppliers();
            return;
        }

        if(isset($_POST['approveAccount'])){
            if($data->approveAccount($_POST['id'])){
                echo json_encode(array('code' => 200, 'message' => 'Success.'));
            }else{
                echo json_encode(array('code' => 401, 'message' => 'Error occured.'));
            }
            return;
        }


        if(isset($_POST['addProductListing'])){
            $name = mysqli_real_escape_string($database->connection,$_POST['product_name']);
            $price = mysqli_real_escape_string($database->connection,$_POST['product_price']);
            $supplier = mysqli_real_escape_string($database->connection,$_SESSION['id']);
            $description = mysqli_real_escape_string($database->connection,$_POST['description']);
            $image = $_FILES;
            if($store->addItem($name, $price, $supplier, $description, $image)){
                echo json_encode(array('code' => 200, 'message' => 'Success.'));
            }else{
                echo json_encode(array('code' => 401, 'message' => 'Error occured.'));
                
            }
            return;
        }








        /* Request Form */

        if(isset($_POST['declineRF'])){
            $rfid = mysqli_real_escape_string($database->connection, $_POST['id']);
            try {
                if($orders->declineRequest($rfid)){
                    echo json_encode(array("status" => 200));
                    return;
                }else{
                    echo json_encode(array("status" => 400));
                    return;
                }
            }catch(Exception $e){
                echo json_encode(array("status" => 400));
                return;
            }
        }

        if(isset($_POST['getRFS'])){
            $data = $orders->getRFS();
            $status = array("Pending", "Approved", "Declined");
            $badge = array("info", "success", "error");
            $content = "";
            foreach($data as $pos){
                $content .= '<tr>
                <th>'.$pos['id'].'</th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="https://source.boringavatars.com/pixel/120/'.$pos["username"].'" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold ms-1">'.$pos["username"].'</div>
                            <span class="badge badge-ghost badge-sm">'.($pos["contact_no"] != "" ? $pos["contact_no"] : "Contact unavailable").'</span>
                        </div>
                    </div>
                </td>
                <td>
                    '.date_format(date_create($pos['date_created']),"M d, Y h:i A").'
                </td>
                <td><span class="badge badge-'.$badge[$pos["status"]].' badge-sm">'.$status[$pos["status"]].'</span></td>
                <td data-id="'.$pos['id'].'">';

                if($pos['status'] != 0) {
                    $content .= '<button class="btn btn-ghost btn-xs">View</button>
                    ';
                }else{
                    $content .= '
                    <button class="btn btn-success btn-xs rfApprove">Approve</button>
                    <button class="btn btn-error btn-xs rfDecline">Decline</button>'; 
                }

                    
                $content .= '</td>
            </tr>';
            }
            echo $content;
            return;
        }


        if(isset($_POST['getPOS'])){
            $data = $orders->getPOS();
            $status = array("Pending", "Approved", "Cancelled","Delivering");
            $badge = array("info", "success", "error", "warning");
            $content = "";
            foreach($data as $pos){
                $content .= '<tr>
                <th>'.$pos['id'].'</th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="https://source.boringavatars.com/pixel/120/'.$pos["username"].'" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold ms-1">'.$pos["username"].'</div>
                            <span class="badge badge-ghost badge-sm">'.($pos["contact_no"] != "" ? $pos["contact_no"] : "Contact unavailable").'</span>
                        </div>
                    </div>
                </td>
                <td class="rfVendor p-1 text-center ">Vendor</td>
                <td>
                    '.date_format(date_create($pos['date_created']),"M d, Y h:i A").'
                </td>
                <td><span class="badge badge-'.$badge[$pos["status"]].' badge-sm">'.$status[$pos["status"]].'</span></td>
                <td data-id="'.$pos['id'].'">';

                if($pos['status'] != 0) {
                    $content .= '<button class="btn btn-ghost btn-xs">View Delivery Status</button>';
                }else if($_SESSION['role'] == "2"){
                    $content .= '
                    <button class="btn btn-success btn-xs rfApprove">Approve</button>
                    <button class="btn btn-error btn-xs rfDecline">Decline</button>'; 
                }else{
                    $content .= '<button class="btn btn-ghost rfviewPDF btn-xs">View</button>';
                }

                    
                $content .= '</td>
            </tr>';
            }
            echo $content;
            return;
        }


        if(isset($_POST['getFormData'])){
            $id = mysqli_real_escape_string($database->connection, $_POST['id']);
            $data = $orders->getFormData($id);
            $objects = json_decode($data['itemData']);
            $content = "";
            foreach($objects as $item){     
                $itemData = $orders->getItemData($item->id);
                $content .= '<tr class="rfRow editable flex h-9 hover:bg-gray-700 text-sm table-row flex-col w-full flex-wrap" data-price="0" data-hidden="true" data-id="">
                <input type="hidden" name="rfItemId[]" value="'.$item->id.'" id="rfItemId">
                <input type="hidden" name="rfQty[]" value="'.$item->quantity.'" id="rfQty">    
                <input type="hidden" name="rfDescription[]" value="'.$item->desc.'" id="rfDescription" class="rfDescription" required>
                <td class="rfEditableNum p-1 text-center rfQty">'.$item->quantity.'</td>
                <td class="rfDropDownUnits p-1 text-center ">-</td>
                <td class="rfDropDownItems rfItem p-1 text-center ">'.$itemData['name'].'</td>
                <td class="rfVendor p-1 text-center ">Vendor</td>
                <td class="rfEditable p-1 rfDesc">'.$item->desc.'</td>
                <td class="p-1 rfPrice text-center">₱'.number_format($itemData['price'], 2).'</td>
                <td class="p-1 font-bold rfItemTotal text-center" data-total="'.$item->quantity * $itemData['price'].'">₱'.number_format($item->quantity * $itemData['price'], 2).'</td>
            </tr>';
            }
            echo $content; 
            return; 
        }










        /* PRODUCTS */

        if(isset($_POST['getProductData'])){
            $id = mysqli_real_escape_string($database->connection, $_POST['item_id']);
            $data = $products->getProductInfo($id);
            if($data){
                echo json_encode($data);
            }
            return;
        }


        if(isset($_POST['listProducts'])){
            $data = $products->listProducts();
            $content = '<select class="select select-xs w-full max-w-xs chosen-select"  id="rfProds" name="rfProduct">';
            foreach($data as $product){
                $content .= "<option value='".$product['id']."' 
                data-price='".$product['price']."'
                data-vendor='".$product['company_name']."'
                data-desc='".$product['description']."'
                data-descprice='₱".number_format($product['price'], 2)."'
                data-item='".$product['name']."'>[".$product['company_name']."] ".$product['name']."</option>";
            }
            $content .= '</select">';
            echo $content;
            return;
        }

        if(isset($_POST['getProduct'])){
            $data = $products->getProducts();
            $content = "";
            foreach($data as $p){
                $content .= '
                <tr>
                <th>
                    '.$p['id'].'
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-circle w-12 h-12">
                                <img src="/assets/ligid.webp" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">'.$p['name'].'</div>
                            <div class="text-sm opacity-50">'.$p['brand'].'</div>
                        </div>
                    </div>
                </td>
                <td>
                    '.$p['company_name'].'
                    <br />
                    <span class="badge badge-ghost badge-sm">'.$p['contact_no'].'</span>
                </td>
                <td>'.$p['quantity'].'</td>
                <th>
                    <button class="btn btn-ghost btn-xs" onClick="editItem('.$p['id'].');">Edit</button>
                </th>
            </tr>';
            }
            echo $content;
            return;
        }

        /* INVENTORY */

        if(isset($_POST['getInventoryItemData'])){
            $id = mysqli_real_escape_string($database->connection, $_POST['item_id']);
            $data = $inventory->getItemInfo($id);
            if($data){
                echo json_encode($data);
            }
            return;
        }

        if(isset($_POST['getInventoryItems'])){
            $data = $inventory->getUserInventory();
            $content = "";
            foreach($data as $p){
                $content .= '
                <tr>
                <th>
                    '.$p['id'].'
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-circle w-12 h-12">
                                <img src="/assets/ligid.webp" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">'.$p['name'].'</div>
                            <div class="text-sm opacity-50">'.$p['brand'].'</div>
                        </div>
                    </div>
                </td>
                <td>
                    '.$p['company_name'].'
                    <br />
                    <span class="badge badge-ghost badge-sm">'.$p['contact_no'].'</span>
                </td>
                <td>'.$p['quantity'].'</td>
                <th>
                    <button onclick="openEditBox('.$p['id'].')" class="itemEditBtn btn btn-ghost btn-xs">Edit</button>
                </th>
            </tr>';
            }
            echo $content;
            return;
        }

        if(isset($_POST['getAccountList'])){
            $data = $accounts->getAccounts();
            $roles = array("Super Admin", "Admin", "Supplier", "Property Custodian");
            $content = "";
            foreach($data as $p){
                $content .= '
                <tr>
                <th>
                    
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-circle w-12 h-12">
                                <img src="https://source.boringavatars.com/pixel/60/'.$p['username'].'?colors=26a653,2a1d8f,79646a"" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">'.$p['username'].'</div>
                        </div>
                    </div>
                </td>
                <td>
                    '.$p['email'].'
                    <br />
                    <span class="badge badge-ghost badge-sm">'.$roles[$p['role']].'</span>
                </td>
                <th>
                    <button onclick="openEditBox('.$p['id'].')" class="itemEditBtn btn btn-ghost btn-xs"></button>
                </th>
            </tr>';
            }
            echo $content;
            return;
        }




        /* FORM SUBMISSION */
        if(isset($_POST['editProduct'])){
            unset($_POST['editProduct']);
            $id = mysqli_real_escape_string($database->connection, $_POST['editItemId']);
            $nm = mysqli_real_escape_string($database->connection, $_POST['invItemName']);
            $qty = mysqli_real_escape_string($database->connection, $_POST['invItemQty']);
            $brand = mysqli_real_escape_string($database->connection, $_POST['invItemBrand']);
            $price = mysqli_real_escape_string($database->connection, $_POST['invItemPrice']);
            $desc = mysqli_real_escape_string($database->connection, $_POST['invItemDescription']);
            if($products->updateProduct($id, $qty, $nm, $desc, $brand, $price)){
                echo json_encode(array("status" => 200));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        if(isset($_POST['rfFormSubmit'])){
            unset($_POST['rfFormSubmit']);
           // $tax = mysqli_real_escape_string($database->connection, $_POST['rfTax']);
           // $discount = mysqli_real_escape_string($database->connection, $_POST['rfDiscount']);
            $items = array();
            foreach($_POST['rfItemId'] as $key=>$value){
                $data = array();
                $data['id'] = mysqli_real_escape_string($database->connection, $value);
                $data['quantity'] = mysqli_real_escape_string($database->connection, $_POST['rfQty'][$key]); 
                $data['desc'] = mysqli_real_escape_string($database->connection, $_POST['rfDescription'][$key]);
                array_push($items, $data);  
            }
            $items = json_encode($items);
            $items = mysqli_real_escape_string($database->connection, $items);
            if($orders->insertRequest($items)){
                echo json_encode(array("status" => 200));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        if(isset($_POST['approvePurchaseOrderSubmit'])){
            unset($_POST['approvePurchaseOrderSubmit']);
            //$tax = mysqli_real_escape_string($database->connection, $_POST['rfTax']);
            //$discount = mysqli_real_escape_string($database->connection, $_POST['rfDiscount']);
            $porfID = $_POST['porfID'];
            $items = array();
            foreach($_POST['rfItemId'] as $key=>$value){
                $data = array();
                $data['id'] = $value;
                $data['quantity'] = $_POST['rfQty'][$key]; 
                $data['desc'] = $_POST['rfDescription'][$key];
                array_push($items, $data);  
            }
            $items = json_encode($items);
            if($orders->insertPO($items, $porfID)){
                echo json_encode(array("status" => 200));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }


        if(isset($_POST['addItemInventory'])){
            unset($_POST['addItemInventory']);
            $nm = mysqli_real_escape_string($database->connection, $_POST['invItemName']);
            $qty = mysqli_real_escape_string($database->connection, $_POST['invItemQty']);
            $brand = mysqli_real_escape_string($database->connection, $_POST['invItemBrand']);
            $desc = mysqli_real_escape_string($database->connection, $_POST['invItemDescription']);

            if($inventory->insertItemInventory($qty, $brand, $nm, $desc) == 1){
                echo json_encode(array("status" => 200));
            }elseif($inventory->insertItemInventory($qty, $brand, $nm, $desc) == 2){
                echo json_encode(array("status" => 402));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        if(isset($_POST['editItemInventory'])){
            unset($_POST['editItemInventory']);
            $id = mysqli_real_escape_string($database->connection, $_POST['editItemId']);
            $nm = mysqli_real_escape_string($database->connection, $_POST['invItemName']);
            $qty = mysqli_real_escape_string($database->connection, $_POST['invItemQty']);
            $brand = mysqli_real_escape_string($database->connection, $_POST['invItemBrand']);
            $desc = mysqli_real_escape_string($database->connection, $_POST['invItemDescription']);
            if($inventory->updateItemInventory($id, $qty, $nm, $desc, $brand)){
                echo json_encode(array("status" => 200));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        if(isset($_POST['addProductToList'])){
            unset($_POST['addProductToList']);
            $nm = mysqli_real_escape_string($database->connection, $_POST['invItemName']);
            $qty = mysqli_real_escape_string($database->connection, $_POST['invItemQty']);
            $brand = mysqli_real_escape_string($database->connection, $_POST['invItemBrand']);
            $desc = mysqli_real_escape_string($database->connection, $_POST['invItemDescription']);
            $price = mysqli_real_escape_string($database->connection, $_POST['invItemPrice']);
            if($products->insertProductToList($qty, $brand, $nm, $desc, $price)==1){
                echo json_encode(array("status" => 200));
            }elseif($products->insertProductToList($qty, $brand, $nm, $desc, $price)==2){
                echo json_encode(array("status" => 402));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        if(isset($_POST['addAccount'])){
            unset($_POST['addAccount']);
            $user = mysqli_real_escape_string($database->connection, $_POST['accountUser']);
            $email = mysqli_real_escape_string($database->connection, $_POST['accountEmail']);
            $pass = mysqli_real_escape_string($database->connection, $_POST['accountPassword']);
            $role = mysqli_real_escape_string($database->connection, $_POST['accountRole']);
            if($accounts->addAccount($user, $pass, $email, $role) == 1){
                echo json_encode(array("status" => 200));
            }elseif($accounts->addAccount($user, $pass, $email, $role) == 2){
                echo json_encode(array("status" => 402));
            }else{
                echo json_encode(array("status" => 400));
            }
            return;
        }

        /*Notification */

        if(isset($_POST['view'])){
            $range = mysqli_real_escape_string($database->connection, $_POST['range']);
            $data = $notifications->getNotifications($range);
            $notifs = '';
            $count = 0;
            $notifs = [];
            foreach($data as $notification){
                $content = '<a href="#" class="notif-fr flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex-shrink-0">
                        <img class="rounded-full w-11 h-11" src="https://source.boringavatars.com/pixel/120/test" alt="Jese image">
                        <div class="relative flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                            <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full pl-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New order from <span class="font-semibold text-gray-900 dark:text-white">El Pardo Corporation</span>: <br> "Click to view now"</div>
                        <div class="notif-elapse text-xs text-blue-600 dark:text-blue-500">..</div>
                    </div>
                </a>';
                $notifs[] = array('status' => $notification['status'], 'timestamp' => $notifications->timeElapsedSinceNow($notification['timestamp']), 'viewed' => $notification['viewed'], 'content' => $content);
                if($notification['status'] == 0){
                    $count++;
                }
            }
            header("Content-Type: application/json");
            echo json_encode(array('count' => $count, 'notifications' => array_reverse($notifs)));
            return;
        }
    }

    

    /* GET VIEW */
    if(isset($_POST['getView'])){
        echo $views->getView($_POST['getView']);
        return;
    }

    header("Location: /");
?>
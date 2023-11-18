<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');


        
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

        if (!isset($_SESSION['isLoggedIn']) && !$_SESSION['isLoggedIn'] && !isset($_POST['login'])) {
            echo '<script> location.reload(); </script>';
            return;
        }

        if(isset($_POST['getView'])){
            echo $views->getView($_POST['getView']);
        }

        if(isset($_POST['getPOS'])){
            $data = $orders->getPOS();
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
                <th>';

                if($pos['status'] != 0) {
                    $content .= '<button class="btn btn-ghost btn-xs me-3">View</button>
                    <button class="btn btn-warning btn-xs">Edit</button>';
                }else{
                    $content .= '<button class="btn btn-ghost btn-xs me-3">View</button>
                    <button class="btn btn-success btn-xs">Approve</button>
                    <button class="btn btn-error btn-xs">Decline</button>'; 
                }

                    
                $content .= '</th>
            </tr>';
            }
            echo $content;
        }

        if(isset($_POST['listProducts'])){
            $data = $products->listProducts();
            $content = '<select class="select select-xs w-full max-w-xs" name="rfProduct">';
            foreach($data as $product){
                $content .= "<option value='".$product['id']."' 
                data-price='".$product['price']."'
                data-item='".$product['name']."'>".$product['name'].' - ₱'.number_format($product['price'], 2)."</option>";
            }
            $content .= '</select">';
            echo $content;
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
                    <button class="btn btn-ghost btn-xs">Edit</button>
                </th>
            </tr>';
            }
            echo $content;
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
        }

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
        }
    }
    
?>
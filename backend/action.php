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
    //header('Location: /');
?>
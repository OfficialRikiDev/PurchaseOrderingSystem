<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['login'])){
            $username = $_POST['luser'];
            $password = $_POST['lpass'];

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
    }
    print_r($_POST);
    //header('Location: /');
?>
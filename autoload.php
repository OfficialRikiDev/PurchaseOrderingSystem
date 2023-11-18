<?php
    session_start();
    date_default_timezone_set('Asia/Manila'); 
    include_once('backend/database.php');
    include_once('backend/core.php');

    $database = new Database('localhost', 'root', '', 'transtrack');
    $authenticate = new Authenticate($database->connection);
    $websettings = new Website($database->connection);
    $notifications = new Notification($database->connection);
    $products = new Products($database->connection);    
    $orders = new Order($database->connection);    
    $views = new Views();
?>
<?php
    session_start();
    date_default_timezone_set('Asia/Manila'); 
    include_once('backend/database.php');
    include_once('backend/core.php');
    require_once 'dompdf/autoload.inc.php'; 

    $database = new Database('localhost', 'root', '', 'transtrack');
    $authenticate = new Authenticate($database->connection);
    $websettings = new Website($database->connection);
    $notifications = new Notification($database->connection);
    $products = new Products($database->connection);    
    $orders = new Order($database->connection);    
    $accounts = new Account($database->connection);
    $inventory = new Inventory($database->connection);
    $views = new Views();

?>
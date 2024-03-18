<?php
    session_start();
    date_default_timezone_set('Asia/Manila'); 
    require_once('backend/database.php');
    require_once('backend/core.php');
    require_once('backend/classes/authenticate.php');
    require_once('backend/classes/data.php');
    require_once('backend/classes/store.php');
    require_once 'dompdf/autoload.inc.php'; 

    $database = new Database('localhost', 'root', '', 'transtrack');
    $authenticate = new Authenticate($database->connection);
    $websettings = new Website($database->connection);
    $notifications = new Notification($database->connection);
    $products = new Products($database->connection);    
    $orders = new Order($database->connection);    
    $accounts = new Account($database->connection);
    $inventory = new Inventory($database->connection);
    $data = new Data($database->connection);
    $store = new Store($database->connection);
    $views = new Views();

?>
<?php
    session_start();
    include_once('backend/database.php');
    include_once('backend/core.php');

    $database = new Database('localhost', 'root', '', 'transtrack');
    $authenticate = new Authenticate($database->connection);
    $websettings = new Website($database->connection);
    
?>
<?php

$id;
$type;

if(isset($_GET['type']) && isset($_GET['id'])){
    $id = mysqli_real_escape_string($database->connection, $_POST['id']);
    $type = mysqli_real_escape_string($database->connection, $_POST['type']);
}  


include_once($_SERVER['DOCUMENT_ROOT'] . '/backend/generatepdf.php');

?>
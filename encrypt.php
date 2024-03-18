<?php
    if(isset($_GET['pass'])){
        echo hash_hmac('sha256',$_GET['pass'], 'transtrack');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="pass">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
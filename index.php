<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title><?php echo $websettings->getSettings()['website_name']; ?></title>
</head>
<body>
<?php
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){
        include_once(__DIR__ . '/views/dashboard.php');
    }else{
        include_once(__DIR__ . '/views/login.php');
    }
?>
</body>
</html>
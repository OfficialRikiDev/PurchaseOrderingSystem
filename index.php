<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    
    <script src="/js/SimpleCellTableEditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.9/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script> 
    <title><?php echo $websettings->getSettings()['website_name']; ?></title>
</head>
<body class="antialiased">
<?php
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){
        include_once(__DIR__ . '/views/dashboard.php');
    }else{
        include_once(__DIR__ . '/views/login.php');
    }
?>

</body>
</html>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/iconoir.css">
    <link href="/css/flowbite.min.css" rel="stylesheet" />
    <script src="/js/SimpleCellTableEditor.js"></script>
    <link href="/css/full.min.css" rel="stylesheet" type="text/css" />
    <script src="/css/tailwind.css"></script> 
    <script src="
https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css
" rel="stylesheet">
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
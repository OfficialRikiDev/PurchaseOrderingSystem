<?php session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /portal/');
}else{
    if($_SESSION['ispending'] == 0 || $_SESSION['activated'] == 1){
        header('Location: /portal/dashboard');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <link href="/css/full.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/tailwind.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.min.js"></script>
    <title>Application</title>
</head>

<body>
    <nav class="
        flex flex-wrap
        items-center
        justify-between
        w-full
        py-4
        md:py-2
        px-4
        text-lg
        fixed top-0 left-0 right-0
        top-0 
        bg-gray-900
        ">
        <a href="/">
            <img class="md:ms-40 py-3" src="/assets/elpardologo.png" width="50">
        </a>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul class="
            pt-4
            text-base
            py-2
            md:flex
            md:justify-between
            gap-4
            me-40 
            md:pt-0">
                <li>
                    <a class="md:p-4 py-2 block hover:text-blue-400" href="/about">About</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-blue-400" href="/portal">Portal</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mx-auto mt-12" x-data="{step: 0}">
        <div class="flex justify-center items-center min-h-screen">
            <div class="flex flex-row bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-4xl ">
                <div class="w-7/12 border-e m-4 border-gray-700">
                    <ul class="steps steps-vertical">
                        <li class="step step-primary">Account Details</li>
                        <li class="step step-primary">Business Information</li>
                        <li class="step step-primary">Confirmation</li>
                        <li class="step">Finished</li>
                    </ul>
                </div>
                <div class="w-full h-full m-4 place-content-center">
                    <div class="w-full text-center">
                        <h1 class="text-3xl font-bold">Hi <?php echo $_SESSION['username']?>! <br>You're one step closer!</h1>
                        <p class="py-2">Application is still pending. Please wait for confirmation..</p>
                        <div class="divider"></div>
                        <a href="/logout.php" class="link link-error">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script defer src="/js/Alpine.js"></script>
</body>

</html>
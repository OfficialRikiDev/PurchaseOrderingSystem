<link rel="stylesheet" href="/css/dashboard.css">

<main class="container">
    <div class="menu">
        <div class="avatar">
            <img class="thumb" src="https://source.boringavatars.com/pixel/120/<?php echo $_SESSION['username']; ?>?colors=26a653,2a1d8f,79646a"  />

            <span class="name">@<?php echo $_SESSION['username']; ?></span>
        </div>
        <nav class="primary">
            <a href="#" class="menu-item active">
                <span class="iconoir-report-columns"></span>
                <span class="desc">Dashboard</span>
            </a>
            <?php  
                if($_SESSION['role'] == "3") {
                    echo '<a href="#" class="menu-item">
                        <span class="iconoir-page"></span>
                        <span class="desc truncate">Request Form</span>
                    </a>
                    <a href="#" class="menu-item">
                    <span class="iconoir-box-iso"></span>
                    <span class="desc truncate">Inventory</span>
                </a>';
                }else if($_SESSION['role'] == "2"){
                    echo '<a href="#" class="menu-item">
                        <span class="iconoir-google-docs"></span>
                        <span class="desc truncate">Recieved POs    </span>
                    </a>
                    <a href="#" class="menu-item">
                    <span class="iconoir-box-iso"></span>
                    <span class="desc truncate">Inventory</span>
                </a>';
                }else if($_SESSION['role'] == "1") {
                    echo '<a href="#" class="menu-item">
                        <span class="iconoir-google-docs"></span>
                        <span class="desc truncate">Pending POs</span>
                    </a>
                    
                    <a href="#" class="menu-item">
                        <span class="iconoir-box-iso"></span>
                        <span class="desc truncate">Inventory</span>
                    </a>';
                }else{
                    echo '
                    <a href="#" class="menu-item">
                        <span class="iconoir-group"></span>
                        <span class="desc truncate">Accounts</span>
                    </a>';
                }
            ?>
            
            <a href="#" class="menu-item">
                <span class="iconoir-settings"></span>
                <span class="desc truncate">Settings</span>
            </a>
            <a href="/logout.php" class="menu-item">
                <span class="iconoir-log-out"></span>
                <span class="desc truncate">Logout</span>
            </a>
        </nav>
        <span class="expander iconoir-arrow-right"></span>
    </div>
    <div class="topbar">
        <h1 class="current">Dashboard</h1>

        <span class="search">
            <label><span class="iconoir-search"></span></label>
            <input class="bar" type="text" placeholder="Search..." />
        </span>

        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="ms-12  inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400" type="button">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
            </svg>
            <div class="notif-bubble relative flex hidden">
                <div class="relative inline-flex w-2 h-2 bg-red-500 border-1 border-white rounded-full -top-2 right-2 dark:border-gray-900"></div>
            </div>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                Notifications
            </div>
            <div class="notification-content divide-y overflow-y-auto h-60 divide-gray-100 dark:divide-gray-700">
                <div class="shadow rounded-md h-100 p-4 max-w-sm w-full mx-auto">
                    <div class="animate-pulse flex space-x-4">
                        <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-2 bg-slate-700 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                                    <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                                </div>
                                <div class="h-2 bg-slate-700 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                <div class="inline-flex items-center ">

                    <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                    </svg>
                    View all
                </div>
            </a>
        </div>


    </div>
    <div class="dashboard">
        <div class="cardNumbers">
            <div class="card">
                <header>
                    <a class="title" href="#">Total Suppliers</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-green-200 border border-green-300 h-50">100</div>
            </div>
            <div class="card">
                <header>
                    <a class="title" href="#">Total Items</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-red-200 border border-red-300 h-50">1,500</div>
            </div>
            <div class="card">
                <header>
                    <a class="title center" href="#">Idk?</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-blue-200 border border-blue-300 h-50">300</div>
            </div>
        </div>
        <div class="cardcolumn">
            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
        </div>
        <div class="cardcolumn">

            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
        </div>
        <div class="cardcolumn">

            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
            
        </div>
    </div>
    <div class="side">
        <div class="card weather">
            <img class="condition" src="https://user-images.githubusercontent.com/30212452/203724734-5f748507-7ae4-49f9-89f8-7fce3112cd95.png" />
            <div class="content"></div>
            <div class="meta">
                <span class="location"></span>
                <div class="datetime">
                    <span class="iconoir-calendar"></span>
                    <span class="date"></span>
                    <span class="time"></span>
                </div>
            </div>
        </div>
        <div class="card">
            <header>Schedule</header>
            <div class="content">
                <ul>
                    <li>(15:30) Deliver the project to client</li>
                    <li>(18:00) Meet Mike @ White Goose</li>
                    <li>(19:30) Dinner with Mary @ Kit-Bar</li>
                    <li>(22:00) Watch the Falcons match</li>
                    <li>(23:30) Headspace Meditate</li>
                </ul>
            </div>
        </div>
    </div>
</main>
<div class="video">
    <video src="https://user-images.githubusercontent.com/30212452/203724691-9e93bf50-df02-4034-9743-dfe32d18bf58.mp4" muted playsinline autoplay loop></video>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="/js/dashboard.js"></script>
<script src="/js/dashboard-notification.js"></script>
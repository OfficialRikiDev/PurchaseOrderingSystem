<?php session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /portal/');
} else {
    if ($_SESSION['ispending'] == 1) {
        header('Location: /application/apply/confirmation');
    }

    if($_SESSION['activated'] == 0){
        header('Location: /application/apply/confirmation/final');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/css/full.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/tailwind.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="/js/Alpine.js"></script>
    <title>Dashboard</title>
</head>

<body class="h-screen overflow-hidden">
    <div class="flex bg-gray-700 h-full" x-data="{ isSidebarExpanded: true }">
        <aside class="flex flex-col h-full text-gray-300 bg-gray-800 transition-all duration-300 ease-in-out" :class="isSidebarExpanded ? 'w-64' : 'w-20'">
            <a href="#" class="h-20 flex items-center px-4 bg-gray-900 hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden">
                <img class="h-12 w-12 flex-shrink-0" src="/assets/elpardologo.png" alt="" srcset="">
                <span class="ml-2 text-xl font-medium duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Dashboard</span>
            </a>
            <nav class="p-4 space-y-2 font-medium">
                <a href="#" class="flex items-center h-10 px-3 text-white bg-blue-600 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <i class="text-xl h-6 w-6 fas fa-home"></i>
                    <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Home</span>
                </a>
                <?php if ($_SESSION['role'] == 0) {
                    echo (
                        '<a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 flex-shrink-0 fas fa-users-cog"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Accounts</span>
                    </a>
                    
                    
                    ');
                } elseif ($_SESSION['role'] == 1) {
                    echo ('
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 flex-shrink-0 fas fa-wallet"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Budget</span>
                    </a>
                    <a href="suppliers" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 flex-shrink-0 fas fa-house-user"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Suppliers</span>
                    </a>
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 flex-shrink-0 fas fa-history"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Activities</span>
                    </a>
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 fas fa-boxes"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Inventory</span>
                    </a>
                    ');
                } elseif ($_SESSION['role'] == 2) {
                    echo ('
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 fas fa-comments-dollar"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Transactions</span>
                    </a>
                    ');
                } elseif ($_SESSION['role'] == 3) {
                    echo ('
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 flex-shrink-0 fas fa-shopping-cart"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Orders</span>
                    </a>

                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 fas fa-boxes"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">Inventory</span>
                    </a>
                    ');
                } ?>
                <a href="/store" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <i class="text-xl h-6 w-6 fas fa-store"></i>
                    <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Store</span>
                </a>
                <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <i class="text-xl h-6 w-6 fas fa-archive"></i>
                    <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Reports</span>
                </a>
                <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <i class="text-xl h-6 w-6 fas fa-cog"></i>
                    <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Settings</span>
                </a>
            </nav>
            <div class="w-full border-t border-gray-700 p-4 font-medium mt-auto ">
                <a href="/logout.php" :class="isSidebarExpanded ? 'justify-between' : ''" class="flex items-center h-10 px-3 hover:text-gray-100 hover:bg-gray-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <div class="flex items-center" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">
                        <div class="avatar placeholder">
                            <div class="bg-gray-600 text-neutral-content rounded-full w-8 me-2">
                                <span class="text-2xl">
                                    <?php
                                        preg_match_all("/[A-Za-z]+|\d+/", $_SESSION['username'], $result);
                                        $result = $result[0];
                                        if (count($result) > 1) {
                                            echo strtoupper(substr($result[0], 0, 1)) . strtoupper(substr($result[1], 0, 1));;
                                        } elseif (count($result) == 1) {
                                            echo strtoupper(substr($result[0], 0, 1));
                                        }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <span class="duration-300 ease-in-out"><?php echo $_SESSION['username'] ?></span>
                    </div>
                    <div class="" :class="isSidebarExpanded ? 'order-last' : 'order-first'">
                        <i class="text-xl h-6 w-6 fas fa-sign-out-alt"></i>
                    </div>
                </a>
            </div>
        </aside>
        <div class="flex-1 flex flex-col w-full">
            <header class="h-20 flex items-center justify-between px-6 bg-gray-900">
                <button class="p-2 -ml-2 mr-2" @click="isSidebarExpanded = !isSidebarExpanded">
                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 transform" :class="isSidebarExpanded ? 'rotate-180' : 'rotate-0'">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="4" y1="6" x2="14" y2="6" />
                        <line x1="4" y1="18" x2="14" y2="18" />
                        <path d="M4 12h17l-3 -3m0 6l3 -3" />
                    </svg>
                </button>
                <div class="flex">

                    <div class="dropdown dropdown-end" x-data="{orders: 1}">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item" :class="orders > 0 ? 'opacity-100' : 'opacity-0'">3</span>
                            </div>
                        </div>
                        <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                            <div class="card-body">
                                <span class="font-bold text-lg">8 Items</span>
                                <span class="text-info">Subtotal: $999</span>
                                <div class="card-actions">
                                    <button class="btn btn-primary btn-block">View cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <details class="dropdown dropdown-bottom dropdown-end" x-data="{notifs: 0}">

                        <summary tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="badge badge-xs badge-primary indicator-item" :class="notifs > 0 ? 'opacity-100' : 'opacity-0'"></span>
                            </div>
                        </summary>
                        <ul tabindex="0" id="notification-list" class="block dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-72 h-72 overflow-y-auto">
                            <li>
                                <a class="flex w-full">
                                    <div class="flex flex-col gap-2 w-full">
                                        <div class="flex gap-2 items-center w-full">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-12">
                                                    <span>SY</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col h-full w-full">
                                                <div class="w-full place-content-center">
                                                    <span class="text-gray-400 font-bold">System</span> 
                                                    <span class="text-gray-400">has a new pending account application.</span>
                                                </div>
                                                <div class="w-full place-content-center">
                                                    <span class="text-xs text-primary">2 hours ago.</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                            <a class="flex w-full">
                                    <div class="flex flex-col gap-2 w-full">
                                        <div class="flex gap-2 items-center w-full">
                                            <div class="skeleton w-12 h-12 rounded-full shrink-0"></div>
                                            <div class="flex flex-col h-12 place-content-center gap-3 w-full">
                                                <div class="skeleton h-2 w-full"></div>
                                                <div class="skeleton h-2 w-full"></div>
                                            </div>
                                        </div>
                                        <div class="skeleton h-32 w-full"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </details>
                </div>


            </header>
            <main class="flex flex-col p-6 text-white w-full gap-4">
                <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                    <div class="stat ">
                        <div class="stat-figure text-primary">
                            <div class="flex">
                                <div class="mx-4 w-20 flex flex-col border-l-2 border-green-500">
                                    <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">149</div>
                                    <div class="ml-2 text-xs text-gray-400">units sold</div>
                                </div>
                                <div class="w-20 flex flex-col border-l-2 border-green-500">
                                    <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">125</div>
                                    <div class="ml-2 text-xs text-gray-400">orders</div>
                                </div>
                            </div>
                        </div>
                        <div class="stat-title text-gray-400">Today Feb 27, 2024</div>
                        <div class="stat-value text-success">$6,471</div>

                        <div class="mt-1 stat-desc">gross revenue</div>
                    </div>



                </div>
                <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                    <div class="stat ">
                        <div class="stat-figure text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-400">Orders</div>
                        <div class="stat-value text-primary">10</div>
                        <div class="stat-desc">21% more than last month</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="stat-title text-gray-400">Total Earned</div>
                        <div class="stat-value text-secondary flex flex-col">
                            $1,000

                        </div>
                        <div class="stat-desc mt-2">21% more than last month</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-warning">
                            <svg viewBox="0 0 24 24" fill="none" class="inline-block w-8 h-8 stroke-current" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                <path d="M19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20Z" stroke-width="2"></path>
                                <path d="M16.5 14C16.2239 14 16 13.7761 16 13.5C16 13.2239 16.2239 13 16.5 13C16.7761 13 17 13.2239 17 13.5C17 13.7761 16.7761 14 16.5 14Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M18 7V5.60322C18 4.28916 16.7544 3.33217 15.4847 3.67075L4.48467 6.60409C3.60917 6.83756 3 7.63046 3 8.53656V9" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div class="stat-title text-gray-400">Quota</div>
                        <div class="stat-value text-warning flex flex-col">
                            <span class="!text-sm">Gained $1,230 of $9,9999</span>
                            <progress class="mt-1 progress progress-warning w-56" value="10" max="100"></progress>
                        </div>
                        <div class="stat-desc mt-2">21% more than last month</div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
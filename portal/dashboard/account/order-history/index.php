<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
if (!isset($_SESSION['username'])) {
    header('Location: /portal/');
} else {
    if ($_SESSION['ispending'] == 1) {
        header('Location: /application/apply/confirmation');
    }

    if ($_SESSION['activated'] == 0) {
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
    <script src="/js/jquery.min.js"></script>
    <title>Orders</title>
</head>

<body class="overflow-hidden">
    <div class="flex bg-gray-700 h-screen" x-data="{ isSidebarExpanded: false }">
        <aside class="flex flex-col h-full text-gray-300 bg-gray-800 transition-all duration-300 ease-in-out" :class="isSidebarExpanded ? 'w-64' : 'w-20'">
            <a href="#" class="h-20 flex items-center px-4 bg-gray-900 hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden">
                <img class="h-12 w-12 flex-shrink-0" src="/assets/elpardologo.png" alt="" srcset="">
                <span class="ml-2 text-xl font-medium duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Dashboard</span>
            </a>
            <nav class="p-4 space-y-2 font-medium">
                <?php $navigations = new Navigations();
                $navigations->init(); ?>
            </nav>
            <div class="w-full border-t border-gray-700 p-4 font-medium mt-auto ">
                <a href="/logout.php" :class="isSidebarExpanded ? 'justify-between' : ''" class="flex items-center h-10 px-3 hover:text-gray-100 hover:bg-gray-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                    <div class="flex items-center" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">
                        <div class="avatar placeholder">
                            <div class="bg-gray-600 text-neutral-content rounded-full w-8 me-2">
                                <span class="text-2xl"><?php
                                                        preg_match_all("/[A-Za-z]+|\d+/", $_SESSION['username'], $result);
                                                        $result = $result[0];
                                                        if (count($result) > 1) {
                                                            echo strtoupper(substr($result[0], 0, 1)) . strtoupper(substr($result[1], 0, 1));;
                                                        } elseif (count($result) == 1) {
                                                            echo strtoupper(substr($result[0], 0, 1));
                                                        }
                                                        ?></span>
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
                <button class="h-20 p-2 -ml-2 mr-2" @click="isSidebarExpanded = !isSidebarExpanded">
                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 transform" :class="isSidebarExpanded ? 'rotate-180' : 'rotate-0'">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="4" y1="6" x2="14" y2="6" />
                        <line x1="4" y1="18" x2="14" y2="18" />
                        <path d="M4 12h17l-3 -3m0 6l3 -3" />
                    </svg>
                </button>
                <div class="flex">

                    <?php
                    if ($_SESSION['role'] == 3 || $_SESSION['role'] == 1) {
                        echo '<a href="/store/my/cart" class=" btn btn-ghost btn-circle" x-on:click="cart()">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item" id="num_ord"></span>
                            </div>
                        </a>';
                    }
                    ?>
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
            <main class="flex flex-row p-6 text-white w-full h-full overflow-hidden">
                <div class="w-3/12 h-full">
                    <ul class="menu gap-1 rounded-lg p-4 w-full bg-base-200 text-base-content text-md h-full">
                        <!-- Sidebar content here -->
                        <li><a href="/portal/dashboard/account/"><i class="fas fa-user        w-12 text-center px-3 text-lg"></i>Account Details</a></li>
                        <li class="bg-gray-700 rounded"><a href="/portal/dashboard/account/order-history/"><i class="fas fa-box         w-12 text-center px-3 text-lg"></i>View Orders <span class="badge badge-secondary text-right"><?php echo count(json_decode($cart->getCart())); ?></span></a></li>
                        <li><a><i class="fas fa-lock        w-12 text-center px-3 text-lg"></i>Password</a></li>
                        <?php if($_SESSION['role'] == 2) {
                            echo '<li><a href="/portal/dashboard/account/integrity/"><i class="fas fa-certificate w-12 text-center px-3 text-lg"></i>Authenticity</a></li>';
                        } ?>
                        <li><a><i class="fas fa-credit-card w-12 text-center px-3 text-lg"></i>Payment Methods</a></li>
                        <li><a><i class="fas fa-home        w-12 text-center px-3 text-lg"></i>Manage Addresses</a></li>
                    </ul>

                </div>
                <div class="flex flex-col px-8 w-full">
                    <h1 class="font-bold text-2xl">Order History</h1>
                    <p class="text-sm my-3">Listed {num} orders</p>

                    <div class="h-full overflow-hidden">
                        <div class="flex flex-col gap-3 overflow-y-auto h-full">
                            <div class="rounded p-4 border-l-4 border-primary bg-gray-800 w-full">
                                <div class="h-5 place-content-center text-m">
                                    <span class="badge badge-success scale-75 badge-xs me-2"></span> Dispatched 
                                </div>
                                <div class="flex flex-row">
                                    <div class="flex flex-col mt-4 rounded-lg bg-slate-700 shadow w-10/12 p-4">
                                        <div class="flex gap-6 p-4 rounded w-full">
                                            <div class="images gap-2">
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                    </div>
                                                </div>
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <span class="font-bold text-sm">Arrives Tomorrow</span>
                                                <span class="text-xs text-base-content">7AM - 7PM</span>
                                            </div>
                                        </div>
                                        <div class="divider m-0"></div>
                                        <div class="flex gap-6 p-4 rounded w-full">
                                            <div class="images gap-2">
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                    </div>
                                                </div>
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <span class="font-bold text-sm">Expected on Mon, 15 April</span>
                                                <span class="text-xs text-base-content">7AM - 7PM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-3/12 gap-2 p-5">
                                        <a class="btn btn-sm btn-success">Track Order</a>
                                        <a class="btn btn-sm btn-outline btn-primary">View Order Details</a>
                                        <a class="btn btn-sm btn-ghost">Edit Order</a>
                                    </div>
                                </div>
                                <p class="text-xs mt-5 text-base-content">Order #1</p>
                            </div>

                            <div class="rounded p-4 border-l-4 border-primary bg-gray-800 w-full">
                                <div class="h-5 place-content-center text-md"><span class="badge badge-ghost scale-75 badge-xs me-2"></span> Done</div>
                                <div class="flex flex-row">
                                    <div class="flex flex-col mt-4 rounded-lg bg-slate-700 shadow w-10/12 p-4">
                                        <div class="flex gap-6 p-4 rounded w-full">
                                            <div class="images gap-2">
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                    </div>
                                                </div>
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <span class="font-bold text-sm">Delivered on 12 March</span>
                                                <span class="text-xs text-base-content">7AM - 7PM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-3/12 gap-2 p-5">
                                        <a class="btn btn-sm btn-outline btn-primary">View Order Details</a>
                                    </div>
                                </div>
                                <p class="text-xs mt-5 text-base-content">Order #1</p>
                            </div>

                            <div class="rounded p-4 border-l-4 border-primary bg-gray-800 w-full">
                                <div class="h-5 place-content-center text-md"><span class="badge badge-ghost scale-75 badge-xs me-2"></span> Done</div>
                                <div class="flex flex-row">
                                    <div class="flex flex-col mt-4 rounded-lg bg-slate-700 shadow w-10/12 p-4">
                                        <div class="flex gap-6 p-4 rounded w-full">
                                            <div class="images gap-2">
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                    </div>
                                                </div>
                                                <div class="avatar">
                                                    <div class="w-16 h-16 rounded-xl">
                                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <span class="font-bold text-sm">Delivered on 4 March</span>
                                                <span class="text-xs text-base-content">7AM - 7PM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-3/12 gap-2 p-5">
                                        <a class="btn btn-sm btn-outline btn-primary">View Order Details</a>
                                    </div>
                                </div>
                                <p class="text-xs mt-5 text-base-content">Order #1</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
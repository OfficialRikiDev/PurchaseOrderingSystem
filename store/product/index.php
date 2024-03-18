<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
if (!isset($_SESSION['username'])) {
    header('Location: /portal/');
} else {
    if ($_SESSION['ispending'] == 1) {
        header('Location: /application/apply/confirmation');
    }
}

if (isset($_GET['q']) && strlen($_GET['q']) == 0) {
    header('Location: /store/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/iconoir.css">
    <script src="/js/tailwind.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/js/Alpine.js"></script>
    <title>Store</title>
</head>

<body class="overflow-hidden">
    <div class="flex bg-gray-700 h-screen" x-data="{ isSidebarExpanded: false }">
        <aside class="flex flex-col text-gray-300 bg-gray-800 transition-all duration-300 ease-in-out" :class="isSidebarExpanded ? 'w-64' : 'w-20'">
            <a href="#" class="h-20 flex items-center px-4 bg-gray-900 hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden">
                <img class="h-12 w-12 flex-shrink-0" src="/assets/elpardologo.png" alt="" srcset="">
                <span class="ml-2 text-xl font-medium duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Dashboard</span>
            </a>
            <nav class="p-4 space-y-2 font-medium">
                <a href="/portal/dashboard/" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25  rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
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
                    <a href="#" class="flex items-center h-10 px-3 hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
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
                <a href="/store" class="flex items-center h-10 px-3 bg-blue-600 text-white hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
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
        <div class="flex flex-col w-full h-[vh]">
            <header class="flex h-fit items-center justify-between px-6 h-20 bg-gray-900">
                <button class="h-20 p-2 -ml-2 mr-2" @click="isSidebarExpanded = !isSidebarExpanded">
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
                    <details class="dropdown dropdown-bottom dropdown-end" x-data="{notifs: 1}">
                        <summary tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="badge badge-xs badge-primary indicator-item" :class="notifs > 0 ? 'opacity-100' : 'opacity-0'"></span>
                            </div>
                        </summary>
                        <ul tabindex="0" class="block dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-72 h-72 overflow-y-auto">
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                        </ul>
                    </details>
                </div>


            </header>
            <div class="flex bg-base-200 px-4 py-2 justify-between w-full">
                <div class="text-xs breadcrumbs">
                    <ul>
                        <li><a>Home</a></li>
                        <?php
                        if (isset($_GET['q'])) {
                            echo '<li><span class="text-primary">Search Results</span></li> ';
                        }
                        ?>
                    </ul>
                </div>
                <div class="order-last">
                    <a class="text-xs hover:underline p-1 rounded-full" href="my">
                        My Shop
                    </a>
                </div>
            </div>
            <?php
                if(isset($_GET['prod_id'])){
                    $prod = $store->getProductInfo($_GET['prod_id']);
                }
                
            
            ?>
            <div class="flex w-full h-full  overflow-hidden">
                <div class="w-11/12 overflow-y-auto">
                    <main class="flex flex-wrap flex-row gap-x-2 gap-y-3 w-full p-4 mx-auto">
                        <div class="antialiased">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                                    <div class="flex flex-col md:flex-row -mx-4">
                                        <div class="md:flex-1 px-4">
                                            <div x-data="{ image: 1 }" x-cloak>
                                                <div class="h-80 md:h-80 w-full rounded-lg bg-gray-100 mb-4">
                                                    <div class="h-80 md:h-80 w-96 overflow-hidden rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                                        <img width="100%" src="/assets/src/<?php echo $prod['image'];?>" alt="" srcset="">
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="md:flex-1 px-4">
                                            <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-300 text-2xl md:text-3xl"><?php echo $prod['name'];?>.</h2>
                                            <p class="text-gray-500 text-sm">By <a href="#" class="text-pink-600 hover:underline"><?php echo $prod['company_name'];?></a></p>

                                            <div class="flex items-center space-x-4 my-4">
                                                <div>
                                                    <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                                                        <span class="text-indigo-400 text-2xl mr-1 mt-1">₱</span>
                                                        <span class="font-bold text-indigo-600 text-3xl"><?php echo $prod['price']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                                                    <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                                                </div>
                                            </div>

                                            <p class="text-gray-300"><?php echo $prod['description'] ?></p>

                                            <div class="flex py-4 space-x-4">
                                                <div class="relative">
                                                    <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>
                                                    <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>

                                                    <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                                    </svg>
                                                </div>

                                                <button type="button" class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
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
    <script defer src="/js/Alpine.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/cart.js"></script>
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
                    <?php
                    if ($_SESSION['role'] == 2) {
                        echo '
                        <a class="text-xs hover:underline p-1 rounded-full" href="my">
                            My Shop
                        </a>';
                    }
                    ?>
                    <a class="text-xs hover:underline p-1 rounded-full" href="my">
                        My Shop
                    </a>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row w-full overflow-hidden h-full">
                <div class="sm:w-full w-full lg:w-2/12 w-3/12 bg-base-100 p-4">
                    <button class="btn btn-sm btn-primary w-full">New Product Bidding</button>
                    <div class="h-full w-full overflow-hidden">
                        <div class="flex w-full flex-col gap-3 my-4 overflow-y-auto h-full">
                            <div class="h-fit border-l-4 py-2 rounded bg-slate-700 w-full">
                                <div class="flex flex-row w-full">
                                    <div class="w-full -ms-3 h-5 place-content-center text-md scale-[.7]"><span class="badge badge-success scale-75 badge-xs me-1"></span> On going</div>
                                    <span class="w-full pe-2 text-right text-xs place-content-center">Ending in: 12:00:00</span>
                                </div>
                                <div class="divider m-0 p-0"></div>
                                <div class="flex flex-col px-2">
                                    <span class="font-bold w-full text-warning">LF Butane Gas</span>
                                    <span class="text-xs pt-1">Description lorem epsum lorem epsum lorem epsum lorem epsum</span>
                                    <div class="divider m-0"></div>
                                    <span class="text-xs">Total Bidders: 1</span>
                                    <a href="#" class="mt-3 btn btn-xs btn-warning">View Bidding</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full overflow-y-auto">
                    <main class="grid  2xl:grid-cols-6 xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-x-2 gap-y-3 p-4 w-full mx-auto">
                        <?php
                        foreach ($store->getAllProducts() as $product) {
                            for($i =0; $i < 5; $i++) {
                                echo '
                                <a href="product?prod_id=' . $product['id'] . '" class="grow card card-compact bg-base-100 hover:scale-[1.01] shadow-lg hover:shadow-gray-500/40 duration-300 ease-in-out">
                                    <figure class="h-48"><img src="/assets/src/' . $product['image'] . '" /></figure>
                                    <div class="card-body overflow-hidden">
        
                                        <h2 class="card-title text-base overflow-hidden">
        
                                            <span class="line-clamp-2 text-md">
                                                <div class="badge badge-secondary badge-sm inline-block">NEW</div>
                                                ' . $product['name'] . '
                                            </span>
                                        </h2>
                                        <span class="text-2xl -mt-4 text-warning p-0">₱' . $product['price'] . '</span>
                                        <span class="text-xs -my-2 mb-0">20% Off</span>
                                    </div>
                                </a>
                                ';
                            }
                        }
                        ?>
                    </main>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
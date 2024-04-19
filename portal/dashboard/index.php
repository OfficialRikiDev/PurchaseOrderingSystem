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
    <script src="/js/sweetalert2@11.js"></script>
    <script src="/js/quota.js"></script>
    <title>Dashboard</title>
</head>

<body class="overflow-hidden">
    <div class="flex bg-gray-700 h-screen" x-data="{ isSidebarExpanded: true }">
        <aside class="flex flex-col h-full text-gray-300 bg-gray-800 transition-all duration-300 ease-in-out" :class="isSidebarExpanded ? 'w-64' : 'w-20'">
            <div class="h-20">
                <a href="#" class="h-20 flex items-center px-4 bg-gray-900 hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden">
                    <img class="h-12 w-12 flex-shrink-0" src="/assets/elpardologo.png" alt="" srcset="">
                    <span class="ml-2 text-xl font-medium duration-300 ease-in-out" :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Dashboard</span>
                </a>
            </div>
            <nav class="p-4 space-y-2 font-medium">
                <?php $navigations = new Navigations();
                $navigations->init(); ?>
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
            <header class="flex items-center justify-between px-6 bg-gray-900">
                <button class="p-2 h-20 -ml-2 mr-2" @click="isSidebarExpanded = !isSidebarExpanded">
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
            <main class="flex flex-col p-6 text-white gap-4 overflow">
                <?php
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) {
                ?>
                    <div class="h-100 flex flex-col">
                        <div class="stats stats-vertical lg:stats-horizontal shadow">
                            <div class="stat ">
                                <div class="stat-figure text-primary">
                                    <div class="flex">
                                        <div class="mx-4 w-auto flex flex-col border-l-2 border-green-500">
                                            <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">[amount]</div>
                                            <div class="ml-2 text-xs text-gray-400">units sold or bought</div>
                                        </div>
                                        <div class="w-auto flex flex-col border-l-2 border-green-500">
                                            <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">[amount]</div>
                                            <div class="ml-2 text-xs text-gray-400">orders</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stat-title text-gray-400">Today <?php echo date("M d, Y") ?></div>
                                <div class="stat-value text-success">₱<?php echo number_format($budget->getTodayAllocation(), 2); ?></div>

                                <div class="mt-1 stat-desc">[quota or overall allocation in 1 year]</div>
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
                                <div class="stat-value text-primary"> <?php echo count(json_decode($cart->getCart())); ?></div>
                                <div class="stat-desc">21% more than last month [placeholder]</div>
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="stat-title text-gray-400">Total Allocation</div>
                                <div class="stat-value text-secondary flex flex-col">
                                    ₱<?php echo number_format($budget->getAllocated(), 2) ?>

                                </div>
                                <div class="stat-desc mt-2">21% more than last month [placeholder]</div>
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-warning">
                                    <svg viewBox="0 0 24 24" fill="none" class="inline-block w-8 h-8 stroke-current" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                        <path d="M19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20Z" stroke-width="2"></path>
                                        <path d="M16.5 14C16.2239 14 16 13.7761 16 13.5C16 13.2239 16.2239 13 16.5 13C16.7761 13 17 13.2239 17 13.5C17 13.7761 16.7761 14 16.5 14Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18 7V5.60322C18 4.28916 16.7544 3.33217 15.4847 3.67075L4.48467 6.60409C3.60917 6.83756 3 7.63046 3 8.53656V9" stroke-width="2"></path>
                                    </svg>
                                </div>
                                <div class="stat-title text-gray-400">Budget</div>
                                <div class="stat-value text-warning flex flex-col">
                                    <span class="!text-sm">Used ₱<?php echo number_format($budget->getAllocated(), 2) ?> of ₱<?php echo number_format($budget->getThisMonthBudget()['allocation'], 2) ?></span>
                                    <?php $percentage = ($budget->getAllocated() / $budget->getThisMonthBudget()['allocation']) * 100; ?>
                                    <progress class="mt-1 progress <?php echo ($percentage > 80) ? "progress-error" : ($percentage > 50 ? "progress-warning" : "progress-success"); ?> w-56" value="<?php echo $percentage; ?>" max="100"></progress>
                                </div>
                                <div class="stat-desc mt-2">21% more than last month</div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="h-100 gap-2 flex flex-col">
                        <div class="stats stats-vertical lg:stats-horizontal shadow">
                            <div class="stat ">
                                <div class="stat-figure text-primary">
                                    <div class="flex">
                                        <div class="mx-4 w-auto flex flex-col border-l-2 border-green-500">
                                            <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">[amount]</div>
                                            <div class="ml-2 text-xs text-gray-400">units sold or bought</div>
                                        </div>
                                        <div class="w-auto flex flex-col border-l-2 border-green-500">
                                            <div class="-mb-2 ml-2 text-white text-2xl tracking-wide font-semibold">[amount]</div>
                                            <div class="ml-2 text-xs text-gray-400">orders</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stat-title text-gray-400">Today <?php echo date("M d, Y") ?></div>
                                <div class="stat-value text-success">₱<?php echo number_format($budget->getTodayAllocation(), 2); ?></div>

                                <div class="mt-1 stat-desc">[quota or overall allocation in 1 year]</div>
                            </div>



                        </div>
                        <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                            <div class="stat">
                                <div class="stat-figure text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="stat-title text-gray-400">Orders</div>
                                <div class="stat-value text-primary"> <?php echo count(json_decode($cart->getCart())); ?></div>
                                <div class="stat-desc">21% more than last month [placeholder]</div>
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="stat-title text-gray-400">Total Gained</div>
                                <div class="stat-value text-secondary flex flex-col">
                                    ₱<?php echo number_format($budget->getAllocated(), 2) ?>

                                </div>
                                <div class="stat-desc mt-2">21% more than last month [placeholder]</div>
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-warning">
                                    <svg viewBox="0 0 24 24" fill="none" class="inline-block w-8 h-8 stroke-current" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                        <path d="M19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20Z" stroke-width="2"></path>
                                        <path d="M16.5 14C16.2239 14 16 13.7761 16 13.5C16 13.2239 16.2239 13 16.5 13C16.7761 13 17 13.2239 17 13.5C17 13.7761 16.7761 14 16.5 14Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18 7V5.60322C18 4.28916 16.7544 3.33217 15.4847 3.67075L4.48467 6.60409C3.60917 6.83756 3 7.63046 3 8.53656V9" stroke-width="2"></path>
                                    </svg>
                                </div>
                                <div class="stat-title text-gray-400">Quotation</div>
                                <div class="stat-value text-warning flex flex-col">
                                    <span class="!text-sm">Gained ₱<?php if ($quota->getThisMonthQuota()) {
                                                                        echo number_format($quota->getAllocated(), 2);
                                                                    } else {
                                                                        echo "0.00";
                                                                    } ?> of ₱<?php if ($quota->getThisMonthQuota()) {
                                                                                    echo number_format($quota->getThisMonthQuota()['quota'], 2);
                                                                                } else {
                                                                                    echo '0.00';
                                                                                } ?></span>
                                    <?php if ($quota->getThisMonthQuota()) {
                                        $percentage = ($budget->getAllocated() / $quota->getThisMonthQuota()['quota']) * 100;
                                    } ?>
                                    <progress class="mt-1 progress <?php echo ($percentage > 80) ? "progress-error" : ($percentage > 50 ? "progress-warning" : "progress-success"); ?> w-56" value="<?php echo $percentage; ?>" max="100"></progress>
                                </div>
                                <div class="stat-desc mt-2">21% more than last month</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2 w-full">
                        <span class="font-bold text-lg">Quota Activity Board </span>
                        <button id="setQuotaBtn" class="btn btn-xs btn-success place-self-end">Set Quota</button>
                    </div>
                    <div class="rounded bg-slate-600">
                        <table class="table table-xs table-pin-rows  p-3 ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <td>Name</td>
                                    <td>Allocation</td>
                                    <td>Date</td>
                                    <td>Stats</td>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list = $quota->getQuota();
                                if ($list) {
                                    foreach (array_reverse($list) as $b) {
                                        echo '<tr>
                                        <th></th>
                                        <td>' . $data->getAccountById($b['set_by'])['username'] . '</td>
                                        <td>₱' . number_format($b['quota'], 2) . '</td>
                                        <td>' . date("M d, Y", strtotime($b['date'])) . '</td>
                                        <td>' . (!$b['prev_alloc'] ? '-' : ($b['quota'] >= $b['prev_alloc'] ? '<i class="fas fa-level-up-alt text-success"></i>' : '<i class="fas fa-level-down-alt text-error"></i>')) . '</td>
                                        <th></th>
                                    </tr>';
                                    }
                                }

                                ?>

                        </table>
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
</body>

</html>
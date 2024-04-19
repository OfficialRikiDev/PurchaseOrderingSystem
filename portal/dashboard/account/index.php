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
    <title>Account Integrity</title>
</head>

<body class="h-screen overflow-hidden">
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
                <div class="w-3/12 h-full ">
                    <ul class="menu gap-1 rounded-lg p-4 w-full bg-base-200 text-base-content text-md h-full">
                        <!-- Sidebar content here -->
                        <li class="bg-gray-700 rounded"><a href="/portal/dashboard/account/"><i class="fas fa-user        w-12 text-center px-3 text-lg"></i>Account Details</a></li>
                        <li><a href="/portal/dashboard/account/order-history/"><i class="fas fa-box         w-12 text-center px-3 text-lg"></i>View Orders <span class="badge badge-secondary text-right"><?php echo count(json_decode($cart->getCart())); ?></span></a></li>
                        <li><a><i class="fas fa-lock        w-12 text-center px-3 text-lg"></i>Password</a></li>
                        <?php if($_SESSION['role'] == 2) {
                            echo '<li><a href="/portal/dashboard/account/integrity/"><i class="fas fa-certificate w-12 text-center px-3 text-lg"></i>Authenticity</a></li>';
                        } ?>
                        <li><a><i class="fas fa-credit-card w-12 text-center px-3 text-lg"></i>Payment Methods</a></li>
                        <li><a><i class="fas fa-home        w-12 text-center px-3 text-lg"></i>Manage Addresses</a></li>
                    </ul>

                </div>
                <div class="flex flex-col px-8 w-full">
                    <h1 class="font-bold text-3xl">Profile</h1>
                    <div class="divider"></div>
                    <div class="flex">
                        <div class="avatar placeholder me-8">
                            <div class="bg-gray-600 text-neutral-content rounded-full w-24 me-2">
                                <span class="text-2xl"><?php
                                                        if (count($result) > 1) {
                                                            echo strtoupper(substr($result[0], 0, 1)) . strtoupper(substr($result[1], 0, 1));;
                                                        } elseif (count($result) == 1) {
                                                            echo strtoupper(substr($result[0], 0, 1));
                                                        }
                                                        ?></span>
                            </div>
                        </div>


                        <div class="flex flex-col w-1/3">
                            <span class="font-bold text-md"><?php $acc = $data->getAccountById($_SESSION['id']);
                                                            echo $acc['username'] ?></span>
                            <span class="font-bold text-md"><?php echo $acc['company_name'] ?></span>
                            <span class="text-md"><?php
                                                    switch ($_SESSION['role']) {
                                                        case 3:
                                                            echo 'Proper Custodian';
                                                            break;
                                                        case 2:
                                                            echo 'Supplier';
                                                            break;
                                                        case 1:
                                                            echo 'Chairman';
                                                            break;
                                                        case 0:
                                                            echo 'Superadmin';
                                                            break;
                                                    }

                                                    ?></span>

                            <span class="text-md">Date created: <span class="font-bold"><?php
                                                                                        echo date("M d, Y", strtotime($acc['date_created'])) ?></span></span>

                        </div>
                        <div class="w-full">
                            <button class="float-right btn btn-link text-info">Change Profile Picture</button>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <p class="font-bold text-xl">Email Address</p>
                    <p class="text-sm">Your current email address is <span class="font-bold"><?php echo $_SESSION['email']; ?></span> <button class="ms-32 btn btn-link text-info">Change</button></p>
                    <div class="divider"></div>
                    <p class="font-bold text-xl mb-2">Business Details</p>
                    <form id="profileForm" method="post" class=" <?php
                                                                    if (!isset($_GET['edit'])) {
                                                                        echo "pointer-events-none opacity-[0.6]";
                                                                    } ?>">
                        <div class="flex gap-2 w-1/2">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Company Name</span>
                                </div>
                                <input type="text" name="business" placeholder="Type here" value="<?php echo $acc['company_name'] ?>" class="input input-bordered w-full" />
                            </label>
                        </div>
                        <div class="flex gap-2 w-1/2">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Street</span>
                                </div>
                                <input type="text" name="street" placeholder="Type here" value="<?php echo $acc['address'] ?>" class="input input-bordered w-full" />
                            </label>
                        </div>

                        <div class="flex gap-2 w-1/2">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Contact Number</span>
                                </div>
                                <input type="tel" name="phone" placeholder="Type here" value="<?php echo $acc['contact_no'] ?>" class="input input-bordered w-full" />
                            </label>
                        </div>

                        <div class="flex gap-2 w-1/2">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Country</span>
                                </div>
                                <select name="country" class="select w-full select-bordered">
                                    <?php
                                    require_once($_SERVER['DOCUMENT_ROOT'] . '/backend/classes/countries.php');
                                    $countries = new Countries();
                                    $c = $countries->get();
                                    foreach ($c as $country) {
                                        echo '<option value="' . $country . '" ' . (strtolower($country) == strtolower($acc['country']) ? 'selected' : '') . '>' . $country . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">City</span>
                                </div>
                                <input type="text" name="city" placeholder="Type here" value="<?php echo $acc['city'] ?>" class="input input-bordered w-full" />
                            </label>
                        </div>

                        <div class="flex gap-2 w-1/2">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">State</span>
                                </div>
                                <input type="text" name="state" placeholder="Type here" value="<?php echo $acc['state'] ?>" class="input input-bordered w-full" />
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">ZIP</span>
                                </div>

                                <input type="number" name="zip" placeholder="Type here" value="<?php echo $acc['zip_code'] ?>" class="input input-bordered w-full" />

                            </label>
                        </div>

                        <input type="hidden" name="updateProfileAccount" value="1">
                    </form>
                    <?php
                    if (isset($_GET['edit'])) {
                        echo '<div class="pt-2 w-1/2 gap-2 flex items-end"> 
                            <button id="saveProfileBtn" form="profileForm" class="btn btn-success">Save</button>
                            <a href="/portal/dashboard/account/" class="btn btn-outline btn-error">Cancel</a>
                        </div>';
                    } else {
                        echo '<a href="/portal/dashboard/account/?edit" class="w-1/2 mt-2 btn btn-ghost">Edit</a>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <script type="text/javascript" src="/js/dist/validator.min.js"></script>
    <script src="/js/settings.js"></script>
</body>

</html>
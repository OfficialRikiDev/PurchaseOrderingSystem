<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
if (!isset($_SESSION['username'])) {
    header('Location: /portal/');
}else{
    if($_SESSION['ispending'] == 1){
        header('Location: /application/apply/confirmation');
    }
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
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/store.js"></script>
    <title>My Store</title>
    <style>
        .ck .ck-powered-by {
            display: none !important;
        }
    </style>
</head>

<body class="h-screen overflow-hidden">
    <div class="flex bg-gray-700 h-full" x-data="{ isSidebarExpanded: false }">
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
                                <span class="text-2xl">
                                    <?php
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
        <div class="flex-1 flex flex-col w-full h-full">
            <header class="flex items-center justify-between px-6 h-20 bg-gray-900">
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
                        <li><a>My Listing</a></li>
                    </ul>
                </div>
                <div class="order-last">
                    <a class="text-xs hover:underline p-1 rounded-full" href="">
                        My Shop
                    </a>
                </div>
            </div>
            <div class="flex w-full h-full overflow-hidden">

                <div class="w-10/12 overflow-y-auto">
                    <div class="flex flex-wrap flex-row gap-x-2 w-full">
                        <?php 
                            foreach($store->getAddedProducts() as $product){  
                                echo '
                                <a class="flex border-b bg-base-300 shadow-xl w-full h-36 hover:bg-gray-800 duration-300 ease-in-out">
                                <figure class="avatar">
                                    <div class="w-48">
                                        <img src="/assets/src/'.$product['image'].'" alt="Movie" />
                                    </div>
                                </figure>
                                <div class="w-full h-full px-4 py-2 flex flex-col">
                                    <div class="text-lg font-bold">
                                        '.$product['name'].'
                                    </div>
                                    <span class="-my-1 p-0 h-full">'.$product['description'].'</span>
                                    Date added: <span class="-my-1 p-0 text-[pink]"> '.date_format(date_create($product['date_added']),"M d, Y h:i A").'</span>
                                    <span class="my-1 p-0">
    
                                        <div class="tooltip me-3" data-tip="hello">
                                            <i class="text-error fas fa-chart-line"></i>
                                            52%
                                        </div>
                                        <div class="tooltip me-3" data-tip="hello">
                                            <i class="text-success fas fa-chart-line"></i>
                                            45%
                                        </div>
                                        <div class="tooltip me-3" data-tip="hello">
                                            <i class="text-warning fas fa-chart-line"></i>
                                            100%
                                        </div>
                                    </span>
                                </div>
                            </a>';
                            }
                        ?>
                    </div>
                </div>
                <div class="w-2/12 bg-base-100">
                    <main class="flex flex-wrap gap-x-2 gap-y-3 w-full p-4 mx-auto">
                        <label for="my_modal_1" class="btn btn-sm btn-primary w-full">Add Product</label>
                    </main>
                </div>
            </div>
        </div>
    </div>


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_1" class="modal-toggle" />
    <div class="modal w-2xl" role="dialog">
        <div class="modal-box ">
            <form action="/r.php" id="itemForm" enctype="multipart/form-data" method="post">
                <h3 class="font-bold text-lg">Add product</h3>
                <div class="divider -mt-1 -mb-2"></div>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Product Name</span>
                    </div>
                    <input type="text" name="product_name" class="input input-sm input-bordered w-full" />
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Product Description</span>
                    </div>
                    <input type="hidden" id="content-value" name="description">
                    <div class="row row-editor border border-gray-600 rounded">
                        <div class="editor-container">
                            <div class="editor p-8 overflow-show"></div>
                        </div>
                    </div>
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Product Price</span>
                    </div>
                    <input type="text" name="product_price" class="input input-sm input-bordered w-full" />
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Product Photo</span>
                    </div>
                    <div class="w-full relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                        <input type="file" name="image" onchange="loadFile(event)" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 z-50" />
                        <div class="text-center">
                            <img class="mx-auto h-12 w-12" src="/assets/image-upload.svg" alt="">
                            <h3 class="mt-2 text-sm font-medium text-white-900">
                                <label for="file-upload" class="relative cursor-pointer">
                                    <span>Drag and drop</span>
                                    <span class="text-indigo-600"> or browse</span>
                                    <span>to upload</span>
                                    
                                </label>
                            </h3>
                            <p class="mt-1 text-xs text-gray-500">
                                PNG, JPG, GIF up to 10MB
                            </p>
                        </div>

                        <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
                    </div>
                </label>
            <div class="modal-action">
                <label for="my_modal_1" class="btn">Close</label>
                <input type="hidden" name="addProductListing" value="addProductListing">
                <button id="addItemBtn" class="btn btn-success" form="itemForm">Add</button>
            </div>
            
        </div>
    </div>



    
    <div x-data="{ position : 'bottom-right' }" class="absolute top-0 right-0 px-2 mt-3 overflow-x-hidden z-50 max-w-xs"
        :class="{
                'top-0 right-0': position =='top-right',
                'top-0 left-0': position == 'top-left',
                'bottom-0 left-0': position =='bottom-left',
                'bottom-0 right-0': position =='bottom-right',
                'top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2': position == 'center',
                'top-0 left-1/2 transform -translate-x-1/2 -translate-y-0': position == 'top-center',
                'bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-0': position == 'bottom-center',
                'top-1/2 left-0 transform -translate-x-0 -translate-y-1/2': position == 'left-center',
                'top-1/2 right-0 transform -translate-x-0 -translate-y-1/2': position == 'right-center',
                }">
        <template x-for="(toast, index) in $store.toasts.list" :key="toast.id">
            <div x-show="toast.visible" x-transition:enter="transition ease-in duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-2"
                x-transition:enter-end="transform opacity-100" x-transition:leave="transition ease-out duration-500"
                x-transition:leave-start="transform translate-x-0 opacity-100"
                x-transition:leave-end="transform -translate-y-2 opacity-0"
                class="bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center" :class="{
				'from-blue-500 to-blue-600': toast.type === 'info',
				'from-green-500 to-green-600': toast.type === 'success',
				'from-yellow-400 to-yellow-500': toast.type === 'warning',
				'from-red-500 to-pink-500': toast.type === 'error',
				}">

                <div class="flex flex-col w-full">
                    <div class="flex items-center w-full px-1 my-2">
                        <div class="self-start px-1">
                            <svg x-show="toast.type == 'info'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'success'" class="w-6 h-6 mr-2"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'warning'" class="w-6 h-6 mr-2"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'error'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div x-text="toast.message"></div>

                        <div class="self-start px-1">
                            <button type="button" class="pt-0 px-1" @click="$store.toasts.destroyToast(index)">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <script src="/js/ckeditor/build/ckeditor.js"></script>
    <script type="text/javascript">
        var loadFile = function(event) {

            var input = event.target;
            var file = input.files[0];
            var type = file.type;

            var output = document.getElementById('preview');


            output.src = URL.createObjectURL(event.target.files[0]);
            output.classList.remove('hidden');
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        let editor;

        var be = BalloonEditor
            .create(document.querySelector('.editor'), {
                // Editor configuration.
            })
            .then(newEditor => {
                editor = newEditor;
                editor.model.document.on('change:data', () => {
                    $('#content-value').val(editor.getData());
                });
            })
            .catch(handleSampleError);



        function handleSampleError(error) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "4j3kxpacyy54-92ghke5v1kg1" and the error stack trace:`
            ].join('\n');

            console.error(message);
            console.error(error);
        }
    </script>
</body>

</html>
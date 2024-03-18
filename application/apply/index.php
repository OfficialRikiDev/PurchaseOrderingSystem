<?php session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['ispending'] == 1 || $_SESSION['activated'] == 0){
        header('Location: /application/apply/confirmation');
    }else{
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
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="/js/tailwind.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
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
    <div class="container h-screen mx-auto" x-data="{step: 0}">
        <div class=" flex  h-full justify-center">
            <div class="flex -mt-24 place-self-center flex-row bg-gray-800 items-center shadow-md h-fit rounded px-8 pt-6 pb-8 mb-4 w-full max-w-4xl ">
                <div class="w-7/12 border-e m-4 border-gray-700">
                    <ul class="steps steps-vertical">
                        <li class="step step-primary">Account Details</li>
                        <li class="step" :class="step == 1 ? 'step-primary' : ''">Business Information</li>
                        <li class="step" :class="step == 2 ? 'step-primary' : ''">Confirmation</li>
                        <li class="step" :class="step == 3 ? 'step-primary' : ''">Finished</li>
                    </ul>
                </div>
                <div class="w-full m-4">
                    <form action="" id="application-form" method="post">
                        <div class=" w-full" :class="step == 0 ? '' : 'hidden'">
                            <span class="font-bold text-sm">Account Details</span>
                            <p class="text-xs mt-2">Fill up the fields for your account. That is what you need to logged in.</p>
                            <div class="divider my-1"></div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Username</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <input type="text" data-type="username" name="username" placeholder="" class="input input-sm input-bordered w-full" />
                                
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Email</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <input type="email" data-type="email" name="email" placeholder="" class="input input-sm input-bordered w-full" />
                            </label>
                            <div class="flex flex-row gap-4">
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">Password</span>
                                        
                                    </div>
                                    <input type="password"  data-type="password" name="password" placeholder="" class="input input-sm input-bordered w-full" />
                                    <div class="label">
                                        <span class="error-msg label-text text-error text-xs"></span>
                                    </div>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">Confirm password</span>
                                    </div>
                                    <input type="password" data-type="repassword" name="repassword" placeholder="" class="input input-sm input-bordered w-full" />
                                    <div class="label">
                                        <span class="error-msg label-text text-error text-xs"></span>
                                    </div>
                                </label>
                            </div>
                            <a class="btn btn-sm mt-4 btn-primary text-white float-right" @click="step=1">Continue</a>
                        </div>

                        <div class="w-full" :class="step == 1 ? '' : 'hidden'">
                            <span class="font-bold text-sm">Business Information</span>
                            <p class="text-xs mt-2">This information will be displayed publicly so be careful what you share.</p>
                            <div class="divider my-1"></div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Business Name</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <input type="text" data-type="business" name="business_name" placeholder="" class="input input-sm input-bordered w-full" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Phone Number</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <input type="text" data-type="phone" name="phone" placeholder="" class="input input-sm input-bordered w-full" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Country</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <select name="country" class="select select-sm w-full select-bordered">
                                    <?php 
                                        require_once($_SERVER['DOCUMENT_ROOT'].'/backend/classes/countries.php');
                                        $countries = new Countries();
                                        $c = $countries->get();
                                        foreach($c as $country){
                                            echo '<option value="'.$country.'">'.$country.'</option>';
                                        }
                                    ?>
                                </select>
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Street Address</span>
                                    <span class="error-msg label-text text-error text-xs"></span>
                                </div>
                                <input type="text" data-type="street" name="street" placeholder="" class="input input-sm input-bordered w-full" />
                            </label>
                            <div class="flex flex-row gap-4">
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">City</span>
                                    </div>
                                    <input type="text" data-type="city" name="city" placeholder="" class="input input-sm input-bordered w-full" />
                                    <div class="label">
                                        <span class="error-msg label-text text-error text-xs"></span>
                                    </div>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">State / Province</span>
                                    
                                    </div>
                                    <input type="text" data-type="state" name="state" placeholder="" class="input input-sm input-bordered w-full" />
                                    <div class="label">
                                        <span class="error-msg label-text text-error text-xs"></span>
                                    </div>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">ZIP / Postal Code</span>

                                    </div>
                                    <input type="text" data-type="zip" name="zip" placeholder="" class="input input-sm input-bordered w-full" />
                                    <div class="label">
                                        <span class="error-msg label-text text-error text-xs"></span>
                                    </div>
                                </label>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-sm mt-4 btn-neutral text-white" @click="step=0">Back</a>
                                <input type="hidden" name="apply">
                                <button class="apply-btn btn btn-sm mt-4 btn-neutral bg-primary text-white">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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

    <script type="text/javascript" defer src="/js/Alpine.js"></script>
    <script type="text/javascript" src="/js/dist/validator.min.js"></script>
    <script type="text/javascript" src="/js/application-form.js"></script>
    

</body>

</html>
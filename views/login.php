<link rel="stylesheet" href="/css/login.css">
<section>
    <div class="box">
        <div class="square" style="--i:0;"></div>
        <div class="square" style="--i:1;"></div>
        <div class="square" style="--i:2;"></div>
        <div class="square" style="--i:3;"></div>
        <div class="square" style="--i:4;"></div>
        <div class="square" style="--i:5;"></div>

        <div class="section min-h-screen flex items-center justify-center">
            <div class="bg-opacity-60 bg-black backdrop-filter backdrop-blur-lg p-5 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="md:w-1/2 px-5 mt-12">
                    <h2 class="text-2xl font-bold text-white">Login</h2>
                    <form id="loginForm" class="mt-6" action="#" method="POST">
                        <div>
                            <label class="block text-white">Username</label>
                            <input type="username" name="luser" id="luser" placeholder="Enter Username" class="w-full px-4 py-2 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
                        </div>

                        <div class="mt-4">
                            <label class="block text-white">Password</label>
                            <input type="password" name="lpass" id="lpass" placeholder="Enter Password" minlength="5" class="w-full px-4 py-2 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                    focus:bg-white focus:outline-none" required>
                        </div>

                        <div class="text-right mt-2">
                            <a href="#" class="text-sm font-semibold text-white hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
                        </div>
                        <button type="submit" id="loginBtn" name="login" class="w-full block bg-black hover:bg-gray focus:bg-blue-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6">Log In</button>
                    </form>
                </div>
                <div class="w-1/2 md:block hidden ">
                    <img src="https://images.unsplash.com/photo-1614741118887-7a4ee193a5fa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80" class="rounded-2xl" alt="page img">
                </div>
            </div>
        </div>
    </div>
</section>
<script defer src="/js/Alpine.js"></script>
<script src="/js/login.js"></script>

<div x-data="{ position : 'bottom-right' }" class="absolute top-0 right-0 px-2 mt-3 overflow-x-hidden z-50 max-w-xs" :class="{
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
        <div x-show="toast.visible" x-transition:enter="transition ease-in duration-200" x-transition:enter-start="transform opacity-0 translate-y-2" x-transition:enter-end="transform opacity-100" x-transition:leave="transition ease-out duration-500" x-transition:leave-start="transform translate-x-0 opacity-100" x-transition:leave-end="transform -translate-y-2 opacity-0" class="bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center" :class="{
				'from-blue-500 to-blue-600': toast.type === 'info',
				'from-green-500 to-green-600': toast.type === 'success',
				'from-yellow-400 to-yellow-500': toast.type === 'warning',
				'from-red-500 to-pink-500': toast.type === 'error',
				}">

            <div class="flex flex-col w-full">
                <div class="flex items-center w-full px-1 my-2">
                    <div class="self-start px-1">
                        <svg x-show="toast.type == 'info'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="toast.type == 'success'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="toast.type == 'warning'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="toast.type == 'error'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div x-text="toast.message"></div>

                    <div class="self-start px-1">
                        <button type="button" class="pt-0 px-1" @click="$store.toasts.destroyToast(index)">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
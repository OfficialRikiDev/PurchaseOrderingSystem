<style>
    .loader {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .checkContainer svg, .errorContainer svg {
        width: 100px;
        display: block;
        margin: 40px auto 0;
    }

    .checkContainer svg .path, .errorContainer svg .path {
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;

        &.circle {
            -webkit-animation: dash .9s ease-in-out;
            animation: dash .9s ease-in-out;
        }

        &.line {
            stroke-dashoffset: 1000;
            -webkit-animation: dash .9s .35s ease-in-out forwards;
            animation: dash .9s .35s ease-in-out forwards;
        }

        &.check {
            stroke-dashoffset: -100;
            -webkit-animation: dash-check .9s .35s ease-in-out forwards;
            animation: dash-check .9s .35s ease-in-out forwards;
        }
    }


    @-webkit-keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }

    @keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }
</style>
<div class="rounded-md overflow-auto">
    <div wire:loading style="display:none" class="loadOverlay fixed top-0 left-0 right-0 bottom-0 w-full h-100 z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
        <div class="checkContainer" style="display:none">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
            </svg>
        </div>

        <div class="errorContainer" style="display:none">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
            </svg>
        </div>
        <br>
        <h2 class="text-center text-white text-xl font-semibold loadTextTitle">Submitting form...</h2>
        <p class="w-1/3 text-center text-white loadTextDescription">This may take a few seconds, please don't close this page.</p>
    </div>
    <button class="sticky px-2 rounded-md bg-sky-600 text-white float-right mb-3" type="submit" form="rfForm">Submit</button>
    <form action="/backend/action.php" method="post" class="rfForm" id="rfForm">
        <input type="hidden" name="rfFormSubmit">
        <table id="rfTable" class="table table-compact table-xs   px-2 pt-5 w-full border-separate leading-normal">
            <thead class="uppercase text-xs text-white font-semibold bg-base-100">
                <tr clas s="hidden md:table-row">
                    <th class="w-2"></th>
                    <th class="text-center p-3 ">
                        <p>Qty</p>
                    </th>
                    <th class="text-center p-3">
                        <p>Unit</p>
                    </th>
                    <th class="text-center p-3 w-40">
                        <p>Item</p>
                    </th>
                    <th class="text-center p-3">
                        <p>Description</p>
                    </th>
                    <th class="text-center p-3">
                        <p>Price</p>
                    </th>
                    <th class="text-center p-3">
                        <p>Total</p>
                    </th>
                </tr>
            </thead>
            <tbody class="rfTableBody bg-neutral flex-1 sm:flex-none">

                <tr class="rfRow editable flex h-9 hover:bg-gray-700 text-sm table-row flex-col w-full flex-wrap" data-price="" data-hidden="true">
                    <input type="hidden" name="rfItemId[]" id="rfItemId" required>
                    <input type="hidden" name="rfQty[]" id="rfQty" required>
                    <input type="hidden" name="rfDescription[]" id="rfDescription" class="rfDescription" required>
                    <td class="p-1 w-10 text-center"><button class="deleteRowBtn btn btn-error btn-xs">X</button></td>
                    <td class="rfEditableNum p-1 text-center rfQty">1</td>
                    <td class="rfDropDownUnits p-1 text-center">-</td>
                    <td class="rfDropDownItems rfItem p-1 text-center ">Select Item</td>
                    <td class="rfEditable p-1 rfDesc"></td>
                    <td class="p-1 rfPrice text-center"></td>
                    <td class="p-1 font-bold rfItemTotal text-center" data-total="0"></td>
                </tr>
            </tbody>
            <tfoot class="flex-1 sm:flex-none bg-base-100 text-white">
                <tr class="flex h-8 text-sm table-row flex-col w-full flex-wrap">

                    <td colspan="6" class="p-1 text-right font-semibold ">
                        <div class="w-full"><button type="button" class="addRowBtn mr-5 px-2 rounded-md bg-sky-600 text-white">Add row</button>Total</div>
                    </td>
                    <td class="p-1 font-bold ">
                        <div class="w-full rfsubTotal text-sm text-center" data-total="0">₱0</div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <br>
    </form>
</div>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="/js/rf-table.js"></script>

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
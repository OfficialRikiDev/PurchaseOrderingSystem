
<div class="overflow-x-auto w-100">
    <label for="addProdModal" class="btn btn-xs btn-primary mb-2 float-right" onclick="addProdModal.showModal()">Add Item</label>
    <table class="table" style="width: 100%">
        <thead class="bg-base-100 text-white">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Supplier</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="invBody bg-neutral">
            
        </tbody>    
        <tfoot class="bg-base-100">
            <td colspan="5"></td>
        </tfoot>
    </table>
</div>



<dialog id="addProdModal" class="modal">
    <div class="modal-box">
    <form action="/backend/action.php" method="post" id="addProductForm">
        <h3 class="font-bold text-lg pb-3">Add Item To Inventory</h3>
        <hr>
        <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Product Name</span>
        </label>
        <input type="text" name="invItemName" placeholder="Enter product name" class="input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Price</span>
        </label>
        <input type="number" min="1" step="any" name="invItemPrice" placeholder="Enter product price" class="input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Quantity</span>
        </label>
        <input type="number" name="invItemQty" placeholder="Enter quantity" class="input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Brand</span>
        </label>
        <input type="text" name="invItemBrand" placeholder="Enter item brand" class="input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Description</span>
        </label>
        <input type="text" name="invItemDescription" placeholder="Enter item description" class="invItemDescription input input-bordered w-full max-w-full" />
        </div>
        <div class="modal-action">
            <input type="hidden" name="addProductToList">
            
        </div>
        </form>
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="px-5 btn rounded-md bg-sky-600 text-white" form="addProductForm" type="submit">Add</button>
            <button class="btn">Close</button>
        </form>
    </div>
</dialog>

<dialog id="editItemInventory" class="modal">
    <div class="modal-box">
    <form action="/backend/action.php" method="post" id="editItemInventoryForm">
        <input type="hidden" name="editItemId" class="editItemId">
        <h3 class="font-bold text-lg pb-3">Edit Item</h3>
        <hr>
        <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Product Name</span>
        </label>
        <input type="text" name="invItemName" placeholder="Enter product name" class="editItemName input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Price</span>
        </label>
        <input type="number" step="any" name="invItemPrice" placeholder="Enter price" class="editItemPrice input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Quantity</span>
        </label>
        <input type="number" name="invItemQty" placeholder="Enter quantity" class="editItemQty input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Brand</span>
        </label>
        <input type="text" name="invItemBrand" placeholder="Enter item brand" class="editItemBrand input input-bordered w-full max-w-full" />
        <label class="label">
            <span class="label-text">Description</span>
        </label>
        <input type="text" name="invItemDescription" placeholder="Enter item description" class="editItemDesc invItemDescription input input-bordered w-full max-w-full" />
        </div>
        <div class="modal-action">
            <input type="hidden" name="editProduct">
            
        </div>
        </form>
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="px-5 btn rounded-md bg-sky-600 text-white" form="editItemInventoryForm" type="submit">Save</button>
            <button class="btn">Close</button>
        </form>
    </div>
</dialog>


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


<script src="/js/Alpine.js"></script>
<script src="/js/productlist.js"></script>
<div class="overflow-x-auto w-100">
    <button class="btn btn-xs btn-primary mb-2 float-right" onclick="addItemModal.showModal()">Add Item</button>
    <table class="table" style="width: 100%">
        <!-- head -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Supplier</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- row 1 -->
            <tr>
                <th>
                    123
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="/assets/ligid.webp" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Leged</div>
                            <div class="text-sm opacity-50">Leged Brand</div>
                        </div>
                    </div>
                </td>
                <td>
                    Test Supplier Name
                    <br />
                    <span class="badge badge-ghost badge-sm">09123456789</span>
                </td>
                <td>12</td>
                <th>
                    <button class="btn btn-ghost btn-xs">Edit</button>
                </th>
            </tr>
        </tbody>

    </table>
</div>

<dialog id="addItemModal" class="modal z-50">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Hello!</h3>
        <p class="py-4">Press ESC key or click the button below to close</p>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
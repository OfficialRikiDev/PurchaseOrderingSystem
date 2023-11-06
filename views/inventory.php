
<div class="overflow-x-auto w-100">
    <label for="addItemModal" class="btn btn-xs btn-primary mb-2 float-right">Add Item</label>
    <table class="table" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Supplier</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="invBody">
            
        </tbody>

    </table>
</div>

<input type="checkbox" id="addItemModal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Hello!</h3>
        <p class="py-4">This modal works with a hidden checkbox!</p>
        <div class="modal-action">
            <label for="addItemModal" class="btn">Close!</label>
        </div>
    </div>
</div>

<script src="/js/inventory.js"></script>
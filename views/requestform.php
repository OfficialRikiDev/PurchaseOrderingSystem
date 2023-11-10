<div class="rounded-md overflow-auto">
    <form action="" class="rfForm">
        <table id="rfTable" class="table flex table-auto px=2 w-full border-separate leading-normal">
            <thead class="uppercase  text-xs font-semibold bg-gray-200">
                <tr class="hidden md:table-row">
                    <th class="w-2"></th>
                    <th class="text-center p-3">
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
            <tbody class="rfTableBody flex-1 sm:flex-none">
                
                <tr class="editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap" data-price="" data-hidden="true">
                    <input type="hidden" name="rfItemId[]" id="rfItemId">
                    <input type="hidden" name="rfQty[]" id="rfQty">    
                    <td class="p-1 w-10 text-center"></td>
                    <td class="rfEditableNum p-1 text-center rfQty">1</td>
                    <td class="rfDropDownUnits p-1 text-center">-</td>
                    <td class="rfDropDownItems rfItem p-1 text-center ">Select Item</td>
                    <td class="rfEditable p-1"></td>
                    <td class="p-1 rfPrice text-center"></td>
                    <td class="p-1 font-bold rfItemTotal text-center" data-total="0"></td>
                </tr>




            </tbody>

            <tfoot class="flex-1 sm:flex-none">
                <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                    <td colspan="6" class="p-1 text-right font-semibold ">
                        <div class="w-full"><button type="button" class="addRowBtn mr-5 px-2 rounded-md bg-sky-600 text-white">Add row</button>Sub Total</div>
                    </td>
                    <td class="p-1 font-bold ">
                        <div class="w-full rfsubTotal text-sm text-center" data-total="0">₱0</div>
                    </td>
                </tr>
                <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                    <td colspan="6" class="p-1 text-right font-semibold ">
                        <div class="w-full">Discount <input class="input input-xs w-14 text-right rfDiscountInput" type="number" step=".01" value="0" name="rfDiscount" min="0" max="100"></div>
                    </td>
                    <td class="p-1 font-bold">
                        <div class="w-full  text-sm text-center rfDiscount" data-discount="0">₱0</div>
                    </td>
                </tr>
                <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                    <td colspan="6" class="p-1 text-right font-semibold ">
                        <div class="w-full">Tax Inclusive<input class="input input-xs w-14 text-right rfTaxInput" type="number" step=".01" value="0" min="0" max="100" name="rfTax"></div>
                    </td>
                    <td class="p-1 font-bold ">
                        <div class="w-full text-sm text-center rfTax" data-tax="0">₱0</div>
                    </td>
                </tr>
                <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                    <td colspan="6" class="p-1 text-right font-semibold ">
                        <div class="w-full">Total</div>
                    </td>
                    <td class="p-1 font-bold ">
                        <div class="w-full rfTotal text-sm text-center" data-total="0">₱0</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>

<script src="/js/rf-table.js"></script>
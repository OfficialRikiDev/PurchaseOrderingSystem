<div class="rounded-md overflow-auto">
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
            <tr class="editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">
                <td class="p-1 w-10 text-center"></td>
                <td class="rfEditableNum p-1 text-center">1</td>
                <td class="rfDropDownUnits p-1 text-center">-</td>
                <td class="rfDropDownItems p-1 text-center ">Select Item</td>
                <td class="rfEditable p-1"></td>
                <td class="p-1 "></td>
                <td class="p-1 text-right font-bold"></td>
            </tr>




        </tbody>

        <tfoot class="flex-1 sm:flex-none">
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold ">
                    <div class="w-full"><button class="addRowBtn mr-5 px-2 rounded-md bg-sky-600 text-white">Add row</button>Sub Total</div>
                </td>
                <td class="p-1 font-bold ">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold ">
                    <div class="w-full">Discount</div>
                </td>
                <td class="p-1 font-bold ">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold ">
                    <div class="w-full">Tax Inclusive</div>
                </td>
                <td class="p-1 font-bold ">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold ">
                    <div class="w-full">Total</div>
                </td>
                <td class="p-1 font-bold ">
                    <div class="w-full"></div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script src="/js/rf-table.js"></script>
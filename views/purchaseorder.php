<div class="bg-white shadow-lg hover:shadow-xl rounded-md overflow-auto">
    <table id="rfTable" class="table flex table-auto px=2 w-full border-separate leading-normal">
        <thead class="uppercase text-gray-600 text-xs font-semibold bg-gray-200">
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
        <tbody class="rfTableBody flex-1 text-gray-700 sm:flex-none">
            <tr class="editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">
                <td class="p-1 w-10 text-center border-slate-500 border border-1"></td>
                <td class="rfEditableNum p-1 text-center border-slate-500 border border-1">1</td>
                <td class="rfDropDownUnits p-1 text-center border-slate-500 border border-1">pc/s   </td>
                <td class="rfDropDownItems p-1 text-center border-slate-500 border border-1">Legeed</td>
                <td class="rfEditable p-1 border border-slate-500 border-1">Kanang sirkol na motuyok</td>
                <td class="p-1 border border-1 border-slate-500">$200.20</td>
                <td class="p-1 text-right font-bold border-slate-500 border border-1">$200.20</td>
            </tr>




        </tbody>

        <tfoot class="flex-1 text-gray-700 sm:flex-none">
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold border border-1">
                    <div class="w-full"><button class="addRowBtn mr-5 px-2 rounded-md bg-sky-600 text-white">Add row</button>Sub Total</div>
                </td>
                <td class="p-1 font-bold border border-1">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold border border-1">
                    <div class="w-full">Discount</div>
                </td>
                <td class="p-1 font-bold border border-1">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold border border-1">
                    <div class="w-full">Tax Inclusive</div>
                </td>
                <td class="p-1 font-bold border border-1">
                    <div class="w-full"></div>
                </td>
            </tr>
            <tr class="flex h-8 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">

                <td colspan="6" class="p-1 text-right font-semibold border border-1">
                    <div class="w-full">Total</div>
                </td>
                <td class="p-1 font-bold border border-1">
                    <div class="w-full"></div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script src="/js/rf-table.js"></script>
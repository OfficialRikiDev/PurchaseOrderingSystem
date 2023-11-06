var table = $('.rf-table');

$(document).ready(function () {
    $(`.addRowBtn`).on('click', function(e) {
        const template = $(`<tr class="editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">
            <td class="p-1 w-10 text-center "></td>
            <td class="rfEditableNum p-1 text-center ">1</td>
            <td class="rfDropDownUnits p-1 text-center ">-</td>
            <td class="rfDropDownItems p-1 text-center ">Select Item</td>
            <td class="rfEditable p-1 "></td>
            <td class="p-1 "></td>
            <td class="p-1 text-right font-bold "></td>
        </tr>`);

        $(`.rfTableBody`).append(template);
    });

    var logAllEvents = true;
    var simpleEditor = new SimpleTableCellEditor("rfTable");
    simpleEditor.SetEditableClass("rfEditable");
    simpleEditor.SetEditableClass("rfEditableNum", { validation: $.isNumeric });
    simpleEditor.SetEditableClass("rfDropDownUnits", {
        internals: {
            renderEditor: (elem, oldVal) => {
                $(elem).html(`<select class="select select-xs text-center">
                                    <option>mg</option>
                                    <option>g</option>
                                    <option>kg</option>
                                    <option>ml</option>
                                    <option>cl</option>
                                    <option>l</option>
                                    <option>kl</option>
                                    <option>mm</option>
                                    <option>m</option>
                                    <option>m²</option>
                                    <option>m3</option>
                                    <option>cm</option>
                                    <option>km</option>
                                    <option>mi</option>
                                    <option>gal</option>
                                    <option>lb</option>
                                    <option>oz</option>
                                    <option>fl oz</option>
                                    <option>pc</option>
                                </select>`);

                $("select option").filter(function () {
                    return $(this).val() == oldVal;
                }).prop('selected', true);

            },
            extractEditorValue: (elem) => { return $(elem).find('select').val(); },
        }
    });
    simpleEditor.SetEditableClass("rfDropDownItems", {
        internals: {
            renderEditor: (elem, oldVal) => {
                $(elem).html(`<select class="select select-xs w-full max-w-xs">
                                    <option disabled selected>Select Item</option>
                                    <option>Legeed</option>
                                    <option>Owell</option>
                                    <option>Tambotso</option>
                                    <option>Erkon</option>
                                    
                                </select>`);

                $("select option").filter(function () {
                    return $(this).val() == oldVal;
                }).prop('selected', true);

            },
            extractEditorValue: (elem) => { return $(elem).find('select').val(); },
        }
    });

    //Toggling checkboxes
    $("#basicToggle").on('click', function (e) {
        simpleEditor.Toggle($(e.currentTarget).is(':checked'));
    })

    $("#rfTable").on("cell:edited", function (e) {

    });
});

console.log('hi')
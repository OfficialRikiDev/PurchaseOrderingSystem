var table = $('.rf-table');

$(document).ready(function () {
    $(`.addRowBtn`).on('click', function(e) {
        const template = $(`<tr class="editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap">
            <td class="p-1 w-10 text-center border border-1 border-slate-800"></td>
            <td class="rfEditableNum p-1 text-center border border-1 border-slate-800">1</td>
            <td class="rfDropDownUnits p-1 text-center border border-1 border-slate-800">pc/s</td>
            <td class="rfDropDownItems p-1 text-center border border-1 border-slate-800">Legeed</td>
            <td class="rfEditable p-1 border border-1 border-slate-800"></td>
            <td class="p-1 border border-1 border-slate-800"></td>
            <td class="p-1 text-right font-bold border border-1 border-slate-800"></td>
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
                $(elem).html(`<select>
                                    <option>pc/s</option>
                                    <option>pack/s</option>
                                    <option>kg/s</option>
                                    <option>ml/s</option>
                                    
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
                $(elem).html(`<select>
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
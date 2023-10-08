var table = $('.rf-table');

$(document).ready(function () {
    var logAllEvents = true;
    var simpleEditor = new SimpleTableCellEditor("rfTable");
    simpleEditor.SetEditableClass("rfEditable");
    simpleEditor.SetEditableClass("rfEditableNum", { validation: $.isNumeric });

    $("#rfTable").on("cell:edited", function (e) {

    });
});

console.log('hi')
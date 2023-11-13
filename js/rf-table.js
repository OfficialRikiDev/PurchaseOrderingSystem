var table = $('.rf-table');
function calculate() {
    var sum = 0.00;
    $('.rfTableBody').find('.rfItemTotal').each(function (index) {
        if ($(this).data('total')) {
            let total = parseFloat($(this).data('total'));
            console.log(total);
            if (total) {
                sum += total;
            }
        }
    });
    $('.rfsubTotal').text(sum.toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }));
    $('.rfsubTotal').data('total', sum);

    let subTotal = parseFloat($('.rfsubTotal').data('total'));
    let discount = parseFloat(Number($('.rfDiscountInput').val()).toString());
    let tax = parseFloat(Number($('.rfTaxInput').val()).toString());
    $('.rfDiscountInput').val(discount);
    $('.rfTaxInput').val(tax);

    
    $(".rfDiscount").text((subTotal * (discount / 100)).toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }));

    $(".rfDiscount").data("discount", discount);

    $(".rfTax").text((subTotal * (tax / 100)).toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }));
    $(".rfTax").data("tax", tax);

    $(".rfTotal").text((subTotal - (subTotal * (discount / 100))).toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }))
}


$(document).ready(function () {
    $(".deleteRowBtn").on('click', function(e){
        $(this).parent().parent().remove();
        e.preventDefault();
        calculate();
    });

    $(`.addRowBtn`).on('click', function (e) {
        const template = $(`<tr class="rfRow editable flex h-9 hover:bg-gray-100 text-sm table-row flex-col w-full flex-wrap" data-price="0" data-hidden="true" data-id="">
            <input type="hidden" name="rfItemId[]" id="rfItemId">
            <input type="hidden" name="rfQty[]" id="rfQty">    
            <td class="p-1 w-10 text-center "><button class="deleteRowBtn btn btn-error btn-xs">X</button></td>
            <td class="rfEditableNum p-1 text-center rfQty">1</td>
            <td class="rfDropDownUnits p-1 text-center ">-</td>
            <td class="rfDropDownItems rfItem p-1 text-center ">Select Item</td>
            <td class="rfEditable p-1"></td>
            <td class="p-1 rfPrice text-center"></td>
            <td class="p-1 font-bold rfItemTotal text-center" data-total="0"></td>
        </tr>`);

        $(`.rfTableBody`).append(template);
        $(".deleteRowBtn").on('click', function(e){
            e.preventDefault();
            $(this).parent().parent().remove();
            calculate();
        });
        calculate();
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
                $.ajax({
                    url: "backend/action.php",
                    method: "POST",
                    async: false,
                    data: { listProducts: 'listProducts' },
                    success: function (data) {
                        $(elem).html(data);
                    }
                });

                $("select option").filter(function () {
                    return $(this).val() == oldVal;
                }).prop('selected', true);

            },
            extractEditorValue: (elem) => {
                let price = parseFloat($(elem).find('select').find(":selected").data('price'));
                let qty = parseInt($(elem).parent().find(".rfQty").text());
                let total = qty * price;
                console.log(total);
                $(elem).parent().find(".rfPrice").html(price.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'PHP',
                }));
                $(elem).parent().find("#rfItemId").val($(elem).find('select').find(":selected").val());
                $(elem).parent().find("#rfQty").val(qty);
                $(elem).parent().data('price', price);
                calculate();
                return $(elem).find('select').find(":selected").data('item');
            },
        }
    });

    //Toggling checkboxes
    $("#basicToggle").on('click', function (e) {
        simpleEditor.Toggle($(e.currentTarget).is(':checked'));
    })

    $("#rfTable").on("cell:edited", function (e) {
        let elem = $(e.element).parent();
        let price = parseFloat(elem.data('price'));
        let qty = elem.find(".rfQty").text()
        let total = qty * price;
        elem.find("#rfQty").val(qty);
        $('.rfError').removeClass("rfError");
        if (total) {
            elem.find(".rfItemTotal").html(total.toLocaleString('en-US', {
                style: 'currency',
                currency: 'PHP',
            }));
            elem.find(".rfItemTotal").data('total', total);
        }
        calculate();
    });
});

$(".rfDiscountInput").on('input', function () {
    let subTotal = parseFloat($('.rfsubTotal').data('total'));
    let discount = parseFloat(Number($(this).val()).toString());
    let tax = parseFloat($(".rfTaxInput").val().toString());
    $(this).val(discount);

    if (discount < 0 || $(this).val().length == 0) {
        $(this).val(0);
        discount = parseFloat(Number($(this).val()).toString());
    } else if (discount > 100) {
        $(this).val(100);
        discount = parseFloat(Number($(this).val()).toString());
    }
    
    $(".rfDiscount").text((subTotal * (discount / 100)).toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }));
    $(".rfDiscount").data("discount", $(this).val());
    if(tax > 100-discount){
        $(".rfTaxInput").val(100-discount);
        $(".rfTax").text((subTotal * (tax / 100)).toLocaleString('en-US', {
            style: 'currency',
            currency: 'PHP',
        }));
        $(".rfTax").data("tax", $(this).val());
    }
    
    calculate();
});

$(".rfTaxInput").on('input', function () {
    let subTotal = parseFloat($('.rfsubTotal').data('total'));
    let discount = parseFloat($('.rfDiscount').data('discount'));
    let tax = parseFloat(Number($(this).val()).toString());
    $(this).val(tax);

    if (tax < 0 || $(this).val().length == 0) {
        $(this).val(0);
        tax = parseFloat(Number($(this).val()).toString());
    } else if (tax > 100-discount) {
        $(this).val(100-discount);
        tax = parseFloat(Number($(this).val()).toString());
    }

    $(".rfTax").text((subTotal * (tax / 100)).toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
    }));
    $(".rfTax").data("tax", $(this).val());

});



document.addEventListener('alpine:init', () => {
    Alpine.store('toasts', {
        counter: 0,
        list: [],
        createToast(message, type = 'info', timer = 2000) {
            const index = this.list.length
            let totalVisible =
                this.list.filter((toast) => {
                    return toast.visible
                }).length + 1
            this.list.push({
                id: this.counter++,
                message,
                type,
                timeOut: timer * totalVisible,
                visible: true,
            })
            setTimeout(() => {
                this.destroyToast(index)
            }, timer * totalVisible)
        },
        destroyToast(index) {
            this.list[index].visible = false
        },
    })
})

function checkEmptyValues(){
    let isEmpty = false;
    $(".rfTableBody").find("input:hidden").each(function(){
        if($(this).val() == ''){isEmpty = true;  $(this).parent().addClass("rfError");}
    });
    if(isEmpty) return false; else return true;
}

function checkAmountOfRows(){
    let rows = $(".rfTableBody").find(".rfRow").length;
    if(rows > 0 && checkEmptyValues()){
        return true;
    }else{
        return false;
    }
}

var frm = $('.rfForm');
frm.submit(function (e) {
    e.preventDefault(e);
    if(!checkEmptyValues()) {
        Alpine.store('toasts').createToast(
            "Required inputs are empty, Please remove unused row or fill them up.",
            'error',
            4000
        );
        return;
    }

    if(!checkAmountOfRows()){
        Alpine.store('toasts').createToast(
            "Error! Table data entry is empty.",
            'error',
            3000
        );
        return;
    } 

    $(".loadOverlay").fadeIn(300);
    $('.checkContainer').hide();
    $('.errorContainer').hide();
    $('.loader').show();

    var formData = new FormData($(this)[0]);
    setTimeout(function() {
        $('.loader').hide();
        $('.checkContainer').fadeIn('slow', function () {});
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: formData,
            cache: false,
            processData: false, 
            contentType: false,
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    $(".loadOverlay").fadeOut('slow', function () {});
                    Alpine.store('toasts').createToast(
                        "Form submitted successfully",
                        'success'
                    );
                }, 2000);
            },
            error: function (request, status, error) {
                setTimeout(function() {
                    $('.loader').hide();
                    $('.errorContainer').fadeIn('slow', function () {});
                    $(".loadOverlay").fadeOut('slow', function () {});
                        Alpine.store('toasts').createToast(
                            "Error occured. Please try again",
                            'error',
                            5000
                        )
                    
                }, 2000);
            }
        });
    }, 5000);
});



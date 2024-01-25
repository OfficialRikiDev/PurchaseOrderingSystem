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
});


$(document).ready(function() {
    $.ajax({
        url:"/backend/action.php",
        method: "POST",
        data:{getProduct : 'getProduct'},
        success:function(data)
        {
            console.log("product")
            console.log(data);
            $(".invBody").html(data);
            
        }
    });
});



function editItem(id){
    $.ajax({
        url:"/backend/action.php",
        method: "POST",
        data:{getProductData : 'getProductData',
            item_id: id},
        success:function(data)
        {  
            data = jQuery.parseJSON(data);
            $('.editItemId').val(data.id);
            $('.editItemName').val(data.name);
            $('.editItemPrice').val(data.price);
            $('.editItemDesc').val(data.description);
            $('.editItemBrand').val(data.brand);
            $('.editItemQty').val(data.quantity);
            console.log(data);        
        }
    });
    editItemInventory.showModal();
}



function checkEmptyValues(id){
    let isEmpty = false;
    $("#"+id).find("input").each(function(){
        if($(this).val() == '' && $(this).attr('type') != 'hidden' && !$(this).hasClass('invItemDescription')){isEmpty = true;  $(this).addClass("rfError");}
    });
    if(isEmpty) return false; else return true;
}


var frm = $('#addProductForm');
frm.submit(function (e) {
    e.preventDefault(e);
    if(!checkEmptyValues("addProductForm")) {
        Alpine.store('toasts').createToast(
            "Required inputs are empty, Please fill them up.",
            'error',
            2000
        );
        return;
    }


    var formData = new FormData($(this)[0]);
    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: formData,
        cache: false,
        processData: false, 
        contentType: false,
        success: function (data) {
            console.log(data);
            obj = jQuery.parseJSON(data);
            console.log(obj);
            addProdModal.close();
            if(obj.status == "200"){
                Alpine.store('toasts').createToast(
                    "Product added successfully",
                    'success'
                );

                
                $.ajax({
                    url:"/backend/action.php",
                    method: "POST",
                    data:{getProduct : 'getProduct'},
                    success:function(data)
                    {
                        console.log("product")
                        console.log(data);
                        $(".invBody").html(data);
                        
                    }
                });
            }else if(obj.status == "402"){
                Alpine.store('toasts').createToast(
                    "Product name already exist.",
                    'error',
                    5000
                )
            }else{
                Alpine.store('toasts').createToast(
                    "Error adding product, please check your values and try again.",
                    'error',
                    5000
                )
            }
        },
        error: function (request, status, error) {
            Alpine.store('toasts').createToast(
                "Error occured. Please try again",
                'error',
                5000
            )
        }
    });
});

var frm2 = $('#editItemInventoryForm');
frm2.submit(function (e) {
    e.preventDefault(e);
    if(!checkEmptyValues("editItemInventoryForm")) {
        Alpine.store('toasts').createToast(
            "Required inputs are empty, Please fill them up.",
            'error',
            2000
        );
        return;
    }


    var formData2 = new FormData($(this)[0]);
    $.ajax({
        type: frm2.attr('method'),
        url: frm2.attr('action'),
        data: formData2,
        cache: false,
        processData: false, 
        contentType: false,
        success: function (data) {
            console.log(data);
            obj = jQuery.parseJSON(data);
            console.log(obj);
            if(obj.status == "200"){
                Alpine.store('toasts').createToast(
                    "Product updated successfully",
                    'success'
                );
                editItemInventory.close();
                $.ajax({
                    url:"/backend/action.php",
                    method: "POST",
                    data:{getProduct : 'getProduct'},
                    success:function(data)
                    {
                        console.log("product")
                        console.log(data);
                        $(".invBody").html(data);
                        
                    }
                });
            }else{
                Alpine.store('toasts').createToast(
                    "Error updating product, please check your values and try again.",
                    'error',
                    5000
                )
            }
        },
        error: function (request, status, error) {
            Alpine.store('toasts').createToast(
                "Error occured. Please try again",
                'error',
                5000
            )
        }
    });
});
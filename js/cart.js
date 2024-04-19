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


function submitOrderRequest(){
    Swal.fire({
        title: "Confirm this order request?",
        text: "",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            $.ajax({
                url:"/backend/action.php",
                method: "POST",
                data:{submitCart: 1},
                success:function(data)
                {
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.code == 200){
                        Swal.fire({
                            title: "Confirmed!",
                            text: "Your order request has been submitted.",
                            icon: "success",
                            timer: 2000
                        }).then(()=>{
                            location.reload();
                        });
                    }else if(data.code==402){
                        Swal.fire({
                            title: "Error!",
                            text: "Budget allocation for this order exceeded.",
                            icon: "warning"
                        })
                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: "Your order request has not been submitted.",
                            icon: "error"
                        })
                    }
                }
            });
        }
    })
}


function cart(){
    $.ajax({
        url:"/backend/action.php",
        method: "POST",
        data:{
            getCarts : 'getCarts'
        },
        
        success:function(data){
            json = JSON.parse(data);
            $("#cart_items_amt").text(" ");
            $("#cart_sub_total").text(" ");
            $("#num_ord").text(json.length);
            if(json.length > 0){
                $("#num_ord").css('opacity', '1');
                
            }else{
                $("#num_ord").css('opacity', '0');
                $("#cart_sub_total").text("Subtotal: ₱0.00");
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
        
        }
    });
}

cart();


function addToCart(e, item_id){

    if(!$(e).prop("disabled")){
        $(e).prop("disabled", true);
        $.ajax({
            url:"/backend/action.php",
            method: "POST",
            data:{
                addToCart : 'addToCart',
                item_id: item_id,
                amount: $('#item_amount').find(":selected").val(),
            },
            
            success:function(data){
                data = JSON.parse(data);
                if(data.code != 200){
                    Alpine.store('toasts').createToast(
                        data.message,
                        'error', 1000
                    );
                }else{
                    Alpine.store('toasts').createToast(
                        data.message,
                        'success', 1000
                    );  
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
    
            },
            error:function(jqXHR, textStatus, errorThrown){
                Alpine.store('toasts').createToast(
                    "Error occured",
                    'error', 1000
                );
    
            }
        });
    }
}


function editQty(val, id){
    Swal.fire({
        title: "Update product quantity",
        input: "number",
        inputValue: val,
        inputAttributes: {
            autocapitalize: "off",
            min: 1
        },
        inputValidator: (value) => {
            if (value <= 0) {
                return "Invalid quantity amount!";
            }
        },
        showCancelButton: true,
        confirmButtonText: "Apply",
        showLoaderOnConfirm: true,
        preConfirm: async (amt) => {
            $.ajax({
                url:"/backend/action.php",
                method: "POST",
                data:{
                    updateProductCart : 'updateProductCart',
                    item_id: id,
                    amount: amt,
                },
                
                success:function(data){
                    return data;
                },
                error:function(jqXHR, textStatus, errorThrown){
                    Swal.showValidationMessage(`
                        Request failed: ${errorThrown}
                    `);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Successful!",
                text: "Cart updated successfully!",
                icon: "success",
                timer: 1200,
            }).then((result) => {
                location.reload();
            });
        }
    });
}

function removeProductCart(id){
    Swal.fire({
        title: "Confirm",
        text: "Are you sure you want to remove this product in your cart?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Apply",
        showLoaderOnConfirm: true,
        preConfirm: async (amt) => {
            $.ajax({
                url:"/backend/action.php",
                method: "POST",
                data:{
                    removeProductCart : 'removeProductCart',
                    item_id: id,
                },
                
                success:function(data){
                    return data;
                },
                error:function(jqXHR, textStatus, errorThrown){
                    Swal.showValidationMessage(`
                        Request failed: ${errorThrown}
                    `);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Successful!",
                text: "Cart updated successfully!",
                icon: "success",
                timer: 1200,
            }).then((result) => {
                location.reload();
            });
        }
    });
}
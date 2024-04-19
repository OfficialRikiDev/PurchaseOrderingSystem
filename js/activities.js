

function approvePO(id){
    Swal.fire({
        title: "Continue?",
        text: "Approve this order request?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Approve",
        preConfirm: async() => {
            $.ajax({
                url:"/backend/action.php",
                method: "POST",
                data:{
                    approvePO : 'approvePO',
                    id: id,
                },
                
                success:function(data){
                    data = JSON.parse(data);
                    if(data.code == 200){
                        Swal.fire({
                            title: "Success!",
                            text: "Order request approved.",
                            icon: "success",
                            timer: 2000,
                        }).then(()=>{
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: "Operation unsuccessful.",
                            icon: "error",
                            timer: 2000,
                        });
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    Swal.showValidationMessage(`
                        Request failed: ${errorThrown}
                    `);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

function declinePO(id){
    Swal.fire({
        title: "Continue?",
        text: "Decline this order request?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Decline",
        preConfirm: async() => {
            $.ajax({
                url:"/backend/action.php",
                method: "POST",
                data:{
                    declinePO : 'declinePO',
                    id: id,
                },
                
                success:function(data){
                    data = JSON.parse(data);

                    if(data.code == 200){
                        Swal.fire({
                            title: "Success!",
                            text: "Order request declined.",
                            icon: "success",
                            timer: 2000,
                        }).then(()=>{
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: "Operation unsuccessful.",
                            icon: "error",
                            timer: 2000,
                        });
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    Swal.showValidationMessage(`
                        Request failed: ${errorThrown}
                    `);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}
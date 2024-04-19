$(document).ready(function() {
    $("#setBudgetBtn").on("click", function() {
        Swal.fire({
            title: "<h3 class='text-white'>Set Budget Allocation</h3>",
            icon: "info",
            background: "#1d232a",
            width: "30%",
            html: `
            <form action="/r.php" class="p-3" id="formSetBudget" enctype="multipart/form-data" method="post">
            <div class="divider -mt-1 -mb-2"></div>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Amount</span>
                </div>
                <input type="text" name="budget_allocation" class="budget_allocation text-white input input-sm input-bordered w-full" />
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Date Issued</span>
                </div>
                <input type="date" name="budget_date" value="${new Date().toJSON().slice(0,10)}" class="budget_date text-white input input-md input-bordered w-full" />
            </label>
            
            <input type="hidden" name="setBudget" value="1">
        </form>
            `,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `
                <button id="setBudget">Set</button>
            `,
            cancelButtonText: `
                <label>Close</label>
            `,
            showLoaderOnConfirm: true,
            preConfirm: async  () => {
                const popup = Swal.getPopup();
                let b_amt = popup.querySelector('.budget_allocation').value;
                let b_date = popup.querySelector('.budget_date').value;
                if(b_amt && b_date) {
                    $(".addDocumentBtn").prop("disabled", true);
                    var formData = new FormData(popup.querySelector("#formSetBudget"));
                    if(b_amt > 0){
                        $.ajax({
                            url: '/backend/action.php',
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                console.log(data);
                                data = JSON.parse(data);
                                if(data.code == 200){
                                    Swal.fire({
                                        title: "Success!",
                                        icon: "success",
                                        timer: 2000,
                                        timerProgressBar: true,
                                        showConfirmButton: false
                                    }).then(() =>{
                                        location.reload();
                                    });
                                }else{
                                    Swal.fire({
                                        title: "Error occured!",
                                        icon: "error",
                                        text: "Budget not updated.",
                                        timer: 2000,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }else{
                        Swal.showValidationMessage("Invalid budget amount.")
                    }
                }else{
                    Swal.showValidationMessage("Input fields are required")
                }
            }
        })
    });
});
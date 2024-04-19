$(document).ready(function() {
    $("#setQuotaBtn").on("click", function() {
        Swal.fire({
            title: "<h3 class='text-white'>Set Quota</h3>",
            icon: "info",
            background: "#1d232a",
            width: "30%",
            html: `
            <form action="/r.php" class="p-3" id="formSetQuota" enctype="multipart/form-data" method="post">
            <div class="divider -mt-1 -mb-2"></div>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Amount</span>
                </div>
                <input type="text" name="quota" class="quota text-white input input-sm input-bordered w-full" />
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Date Issued</span>
                </div>
                <input type="date" name="quota_date" value="${new Date().toJSON().slice(0,10)}" class="quota_date text-white input input-md input-bordered w-full" />
            </label>
            
            <input type="hidden" name="setQuota" value="1">
        </form>
            `,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `
                <button id="setQuota">Set</button>
            `,
            cancelButtonText: `
                <label>Close</label>
            `,
            showLoaderOnConfirm: true,
            preConfirm: async  () => {
                const popup = Swal.getPopup();
                let quota = popup.querySelector('.quota').value;
                let quota_date = popup.querySelector('.quota_date').value;
                if(quota && quota_date) {
                    $(".addDocumentBtn").prop("disabled", true);
                    var formData = new FormData(popup.querySelector("#formSetQuota"));
                    if(quota > 0){
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
                                        text: "Quota not updated.",
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
                        Swal.showValidationMessage("Invalid quota amount.")
                    }
                }else{
                    Swal.showValidationMessage("Input fields are required")
                }
            }
        })
    });
});
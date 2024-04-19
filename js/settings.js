
var validator = new Validator({
    form: document.getElementById('profileForm'),
    messagesShown: true,
    rules: {
        business: {
            validate: (value = '', values, field) => {
                if (field === 'business') {
                    return 'Required';
                }
                if(!/^[a-z\d]{4,}$/i.test(value)){
                    return 'Business name must have a minimum length of 4 with no special characters.';
                }
                return '';
            },
        },

        phone: {
            validate: (value = '', values, field) => {
                if (field === 'phone') {
                    return 'Required';
                }
                if(!/^\d{11,}$/i.test(value)){
                    return 'Invalid phone number';
                }
                return '';
            },
        },

        street: {
            validate: (value = '', values, field) => {
                if (field === 'street') {
                    return 'Required';
                }

                if(!/^[a-z\d]{2,}$/i.test(value)){
                    return 'Invalid street';
                }
                return '';
            },
        },

        city: {
            validate: (value = '', values, field) => {
                if (field === 'city') {
                    return 'Required';
                }

                if(!/^[a-z\d]{1,}$/i.test(value)){
                    return 'Invalid city';
                }
                return '';
            },
        },

        state: {
            validate: (value = '', values, field) => {
                if (field === 'state') {
                    return 'Required';
                }

                if(!/^[a-z\d]{1,}$/i.test(value)){
                    return 'Invalid state';
                }
                return '';
            },
        },

        zip: {
            validate: (value = '', values, field) => {
                if (field === 'zip') {
                    return 'Required';
                }
                if(!/^\d{3,}$/i.test(value)){
                    return 'Invalid zip';
                }

                return '';
            },
        },
    }
    });


$("#profileForm input, select").change(function(e) {
    $(this).parent().find(".label .error-msg").text(' ');
    $(e.target).parent().find(".label .error-msg").text(validator.message($(e.target).data('type'), e.target.value));
    validator.showMessages();
});    

$(document).ready(function() {
    $("#profileForm").submit(function(e) {
        e.preventDefault();
        $("#saveProfileBtn").prop("disabled", true);
        var formData = new FormData(this);
        if(true){
            Swal.fire({
                title: "Update your account",
                text: "Confirm saving account details?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Save",
                preConfirm: async (login) => {
                    $.ajax({
                        url: '/backend/action.php',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            data = JSON.parse(data);
                            if(data.code != 200){
                                Swal.fire({
                                    title: "Error occured!",
                                    icon: "error",
                                    text: "Account not updated.",
                                    timer: 2000,
                                }).then((result) => {
                                    $("#saveProfileBtn").prop("disabled", false);
                                });
                            }else{
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Account updated successfully!",
                                    icon: "success",
                                    timer: 2000,
                                }).then(() => {
                                    location.href = window.location.pathname;
                                });
                            }
                            setTimeout(() => {
                                $("#saveProfileBtn").prop("disabled", false);
                            }, 300);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            setTimeout(() => {
                                $("#saveProfileBtn").prop("disabled", false);
                            }, 300);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                $("#saveProfileBtn").prop("disabled", false);
            });


            
        }else{
            setTimeout(() => {
                $("#saveProfileBtn").prop("disabled", false);
            }, 300);
        }
    })
});



$("#addDocumentBtn").click(function() {
    Swal.fire({
        title: "<h3 class='text-white'>Add Document</h3>",
        icon: "info",
        background: "#1d232a",
        width: "30%",
        html: `
        <form action="/r.php" class="p-3" id="formAddDocument" enctype="multipart/form-data" method="post">
        <div class="divider -mt-1 -mb-2"></div>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Document Name</span>
            </div>
            <input type="text" name="document_name" class="document_name text-white input input-sm input-bordered w-full" />
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Date Issued</span>
            </div>
            <input type="date" name="document_date" class="document_date text-white input input-md input-bordered w-full" />
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Photo of Certificate/Document</span>
            </div>
            <div class="w-full relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                <input type="file" name="image" onchange="loadFile(event)" accept="image/*" class="file-image absolute inset-0 w-full h-full opacity-0 z-50" />
                <div class="text-center">
                    <img class="mx-auto h-12 w-12" src="/assets/image-upload.svg" alt="">
                    <h3 class="mt-2 text-sm font-medium text-white-900">
                        <label for="file-upload" class="relative cursor-pointer">
                            <span>Drag and drop</span>
                            <span class="text-indigo-600"> or browse</span>
                            <span>to upload</span>
    
                        </label>
                    </h3>
                    <p class="mt-1 text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB
                    </p>
                </div>
    
                <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
            </div>
        </label>
        <input type="hidden" name="addDocument" value="1">
    </form>
        `,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `
            <button id="addDocumentBtn">Add</button>
        `,
        cancelButtonText: `
            <label>Close</label>
        `,
        showLoaderOnConfirm: true,
        preConfirm: async  () => {
            const popup = Swal.getPopup();
            let doc_name = popup.querySelector('.document_name').value;
            let doc_date = popup.querySelector('.document_date').value;
            let doc_file = popup.querySelector('.file-image').files;  
            if(doc_name && doc_date && doc_file.length >0) {
                $(".addDocumentBtn").prop("disabled", true);
                var formData = new FormData(popup.querySelector("#formAddDocument"));
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
                                text: "Account not updated.",
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
                Swal.showValidationMessage("Input fields are required")
            }
        }
    })
});


var loadFile = function(event) {

    var input = event.target;
    var file = input.files[0];
    var type = file.type;

    var output = document.getElementById('preview');


    output.src = URL.createObjectURL(event.target.files[0]);
    output.classList.remove('hidden');
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

function show(e){
    Swal.fire({
        imageUrl: "/assets/src/" + e.innerHTML,
        imageAlt: "Attachment",
        background: "rgba(255,255,255,0)",
        imageWidth: "200%",
        showConfirmButton: false
    });
}
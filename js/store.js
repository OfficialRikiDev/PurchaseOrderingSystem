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


$("#addProductBtn").click(function() {
    Swal.fire({
        title: "<h3 class='text-white'>Add Product</h3>",
        icon: "info",
        background: "#1d232a",
        width: "30%",
        html: `
        <form action="/r.php" class="p-3" id="itemForm" enctype="multipart/form-data" method="post">
        <div class="divider -mt-1 -mb-2"></div>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Product Name</span>
            </div>
            <input type="text" name="product_name" class="product_name text-white input input-sm input-bordered w-full" />
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Product Description</span>
            </div>
            <input type="hidden" id="content-value" class="description" name="description">
            <div class="row row-editor border border-gray-600 rounded">
                <div class="editor-container">
                    <div class="editor text-white p-8 overflow-show"></div>
                </div>
            </div>
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Product Price</span>
            </div>
            <input type="number" min="1" name="product_price" class="text-white product_price input input-sm input-bordered w-full" />
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Product Photo</span>
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
        <input type="hidden" name="addProductListing" value="1">
    </form>
        `,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `
            <button id="addItemBtn">Add</button>
        `,
        cancelButtonText: `
            <label>Close</label>
        `,
        didOpen: () => {
            let editor;
            const popup = Swal.getPopup()
            var be = BalloonEditor
                .create(popup.querySelector('.editor'), {
                    // Editor configuration.
                })
                .then(newEditor => {
                    editor = newEditor;
                    editor.model.document.on('change:data', () => {
                        $('#content-value').val(editor.getData());
                    });
                })
                .catch(handleSampleError);
            
            
            
            function handleSampleError(error) {
                const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';
            
                const message = [
                    'Oops, something went wrong!',
                    `Please, report the following error on ${ issueUrl } with the build id "4j3kxpacyy54-92ghke5v1kg1" and the error stack trace:`
                ].join('\n');
            
                console.error(message);
                console.error(error);
            }
        },
        showLoaderOnConfirm: true,
        preConfirm: async  () => {
            const popup = Swal.getPopup();
            let prod_name = popup.querySelector('.product_name').value;
            let prod_price = popup.querySelector('.product_price').value;
            let prod_file = popup.querySelector('.file-image').files;  
            if(prod_name && prod_price && prod_file.length >0) {
                if($.isNumeric(prod_price) && prod_price > 0){
                    $(".addItemBtn").prop("disabled", true);
                    var formData = new FormData(popup.querySelector("#itemForm"));
                    $.ajax({
                        url: '/backend/action.php',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
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
                                Alpine.store('toasts').createToast(
                                    data.message,
                                    'success'
                                )
                            }else{
                                Alpine.store('toasts').createToast(
                                    data.message,
                                    'error'
                                )
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }else{
                    Swal.showValidationMessage("Invalid price")
                }
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
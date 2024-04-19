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
        data:{getSuppliers : 'getSuppliers'},
        success:function(data)
        {
            data = jQuery.parseJSON(data);
            data.forEach(element => {
                var template = `<tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar placeholder">
                            <div class="bg-gray-600 text-neutral-content rounded-full w-12 me-2">
                                <span class="text-2xl">${element.profile_picture || "?"}</span>
                            </div>
                        </div>  
                        <div>
                            <div class="font-bold">${element.username}</div>
                            <div class="text-sm opacity-50">${element.contact_no}</div>
                        </div>
                    </div>
                </td>
                <td>
                    ${element.company_name || "Unknown"}
                    <br />
                    <span class="badge badge-ghost badge-sm">${element.contact_no || "Not set"}</span>
                </td>
                <td >
                    ${element.country || "Not set"}
                    <br />
                    <span class="badge badge-ghost badge-sm">${element.address || "Not set"}</span>
                </td>
                <td>
                    ${element.state ? element.state+"," : "Not set"} ${element.city}
                    <br />
                    <span class="badge badge-ghost badge-sm">${element.zip_code || "Not set"}</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-ghost badge-sm text-${(element.is_pending || !element.activated ? "[pink]" : "success" )}">${(element.activated ? (element.is_pending ? "Pending for Approval" : "Active" ) : "Inactive")}</span>
                </td>
                <td class="flex flex-col gap-2">
                    ${(element.is_pending ? `
                    <button class="btn btn-success btn-xs" onclick="approve(this)" data-business="${element.company_name}" data-username="${element.username}" data-id="${element.id}">Approve</button>
                    <button class="btn btn-error btn-xs">Disapprove</button>
                    ` : 
                    (element.activated ? `<button class="btn btn-outline btn-xs">Edit</button>
                    <button onclick="disableSupplierAccount(this, ${element.id})"  data-business="${element.company_name}" data-username="${element.username}" class="btn btn-error btn-xs">Disable</button>` : ``))}
                </td>
            </tr>`;
            $('.supplier_list').append(template);
            });
            
        }
    });
});


function disableSupplierAccount(e, id){
    Swal.fire({
        title: `You're about to disable '${$(e).data('username')} [${$(e).data('business')}]' account.`,
        text: "Continue?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Approve"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"/backend/action.php",
                    method: "POST",
                    data:{
                        disableAccount : 'disableAccount',
                        id : id
                    },
                    
                    success:function(data){
                        data = JSON.parse(data);
                        if (data.code == 200) {
                            Swal.fire({
                                title: "Account disabled!",
                                icon: "success",
                                timer: 2000,
                                willClose: () => {
                                    location.reload();
                                }
                            });
                        }
                        setTimeout(() => {
                            $(e).prop("disabled", false);
                        }, 300);
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        setTimeout(() => {
                            $(e).prop("disabled", false);
                        }, 300);
                    }
                });
            }
        });
}

function approve(e){
    $(e).prop("disabled", true);
    Swal.fire({
        title: `You're about to approve '${$(e).data('username')} [${$(e).data('business')}]' account.`,
        text: "Continue?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Approve"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"/backend/action.php",
                    method: "POST",
                    data:{
                        approveAccount : 'approveAccount',
                        id : $(e).data('id')
                    },
                    
                    success:function(data){
                        data = JSON.parse(data);
                        if (data.code == 200) {
                            Swal.fire({
                                title: "Application approved!",
                                icon: "success",
                                timer: 2000,
                                willClose: () => {
                                    location.reload();
                                }
                            });
                        }
                        setTimeout(() => {
                            $(e).prop("disabled", false);
                        }, 300);
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        setTimeout(() => {
                            $(e).prop("disabled", false);
                        }, 300);
                    }
                });
            }
        });
}
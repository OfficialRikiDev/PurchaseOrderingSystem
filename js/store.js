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


$(document).ready(function(){
    $("#itemForm").submit(function(e) {
        e.preventDefault();    
        $(".addItemBtn").prop("disabled", true);
        var formData = new FormData(this);
        $.ajax({
            url: '/backend/action.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if(data.code == 200){
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
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });   
})          
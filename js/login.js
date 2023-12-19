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


$("#loginBtn").click(function () {
    $(this).prop("disabled", true);
    var values = {
        luser: $("#luser").val(),
        lpass: $("#lpass").val(),
        login: 'login'
    }
    $.ajax({
        url: "backend/action.php",
        type: "POST",
        data: values,
        success: function (data) {
            console.log(data);  
            if (data.code == 200) {
                Alpine.store('toasts').createToast(
                    data.message,
                    'success'
                )
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Alpine.store('toasts').createToast(
                    data.message,
                    'error', 500
                )
                $('#loginBtn').prop("disabled", false);
                $('#loginForm').addClass('shake');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $('#loginBtn').prop("disabled", false);
        }
    });
    return false;
});

$('#loginForm').on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e){
    $('#loginForm').delay(200).removeClass('shake');
});
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

var validator = new Validator({
    form: document.getElementById('application-form'),
    messagesShown: true,
    rules: {
        username: {
            validate: (value = '', values, field) => {
                if (field === 'username' && value.length == 0) {
                    return 'Required';
                }
                if(!/^[a-z\d]{4,16}$/i.test(value)){
                    return 'Username must be 4-16 characters long with no special characters.';
                }
                return '';
            },
        },
        email: {
            validate: (value = '', values, field) => {
                if (field === 'email' && value.length == 0) {
                    return 'Required';
                }
                if(!/^[A-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(value)){
                    return 'Invalid email address';
                }
                return '';
            },
        },
        password: {
            validate: (value = '', values, field) => {
                if (field === 'password' && value.length == 0) {
                    return 'Required';
                }
                if(!/^[a-z\d_]{8,}$/i.test(value)){
                    return 'Password must be 8 digits long.';
                }
                return '';
            },
        },
        repassword: {
            validate: (value = '', values, field) => {
                var currPass = $('#application-form input[data-type="password"]')
                if (field === 'repassword' && value.length == 0) {
                    return 'Required';
                }
                if(value != currPass.val()){
                    return 'Password must match';
                }
                if(!/^[a-z\d_]{8,}$/i.test(value)){
                    return 'Password must be 8 digits long.';
                }
                return '';
            },
        },

        business: {
            validate: (value = '', values, field) => {
                if (field === 'business' && value.length == 0) {
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
                if (field === 'phone' && value.length == 0) {
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
                if (field === 'street' && value.length == 0) {
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
                if (field === 'city' && value.length == 0) {
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
                if (field === 'state' && value.length == 0) {
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
                if (field === 'zip' && value.length == 0) {
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

    validator.form.onsubmit = (evn) => {
        evn.preventDefault();
        $("#application-form input, select").each(function(){
            $(this).parent().find(".label .error-msg").text(' ');
            $(this).parent().find(".label .error-msg").text(validator.message($(this).data('type'), $(this).val()));
            validator.showMessages();
        });

        if(validator.allValid()){

        }else{
            Alpine.store('toasts').createToast(
                "Please fill in the data fields properly.",
                'error', 1000
            );
            
        }
    }

    $("#application-form input, select").change(function(e) {
        $(this).parent().find(".label .error-msg").text(' ');
        $(e.target).parent().find(".label .error-msg").text(validator.message($(e.target).data('type'), e.target.value));
        validator.showMessages();
    });

    $("#application-form").submit(function(e) {
        e.preventDefault();    
        $(".apply-btn").prop("disabled", true);
        var formData = new FormData(this);
        if(validator.allValid()){
            $.ajax({
                url: '/backend/action.php',
                type: 'POST',
                data: formData,
                success: function (data) {
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
                    setTimeout(() => {
                        $(".apply-btn").prop("disabled", false);
                    }, 300);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    setTimeout(() => {
                        $(".apply-btn").prop("disabled", false);
                    }, 300);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }else{
            setTimeout(() => {
                $(".apply-btn").prop("disabled", false);
            }, 300);
        }
        
    });
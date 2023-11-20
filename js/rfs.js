function updateBody(){
    $.ajax({
        url:"backend/action.php",
        method: "POST",
        data:{getRFS : 'getRFS'},
        success:function(data)
        {
            let rfID;
            //console.log(data);
            $(".rfsBody").html(data);
            $('.rfApprove').on('click',function(){
                rfId = $(this).parent().data("id");
                $(`.rfTableBody`).empty();
                addRow();
                rfapprovemodal.showModal();
                console.log(rfId);
                $('.porfID').val(rfId);
                $.ajax({
                    url:"backend/action.php",
                    method: "POST",
                    data: { id: rfId, getFormData: "getFormData" },
                    success: function (data) {
                        $(`.rfTableBody`).html(data);
                        calculate();
                    }
                });
            });

            $('.rfDecline').on('click',function(){
                rfId = $(this).parent().data("id");
                declineRfsModal.showModal()
                console.log(rfId)
                
            });
        }
    });
}

$(document).ready(function() {
    updateBody();
});

function updateInner(){
    let current = "pendingrfs"
    var content = function() {
        var result;
        $.ajax({
            async: false,
            url:"backend/action.php",
            method: "POST",
            data:{getView : current},
            success: function(data){
                result = data;
            }
        });
        return result;
    }();
    setInnerHTML(dashboard,content);
}


$('.rfDeclineFinalBtn').on('click', function(){
    $.ajax({
        url:"backend/action.php",
        method: "POST",
        data: { id: rfId, declineRF: "declineRF" },
        success: function (data) {
            console.log(data);
            obj = jQuery.parseJSON(data);
            console.log(obj);
            if(obj.status == "200"){
                Alpine.store('toasts').createToast(
                    "RF Form updated successfully",
                    'success'
                );
                declineRfsModal.close();
                updateBody();
            }else{
                Alpine.store('toasts').createToast(
                    "Error updating form, please try again.",
                    'error',
                    5000
                );
                declineRfsModal.close();
            }
        },
        error: function (request, status, error) {
            Alpine.store('toasts').createToast(
                "Error occured. Please try again",
                'error',
                5000
            );
            declineRfsModal.close();
        }
    });
});

var frm = $('.poForm');
frm.submit(function (e) {
    e.preventDefault(e);
    if(!checkEmptyValues()) {
        Alpine.store('toasts').createToast(
            "Required inputs are empty, Please remove unused row or fill them up.",
            'error',
            4000
        );
        return;
    }

    if(!checkAmountOfRows()){
        Alpine.store('toasts').createToast(
            "Error! Table data entry is empty.",
            'error',
            3000
        );
        return;
    } 

    $(".loadOverlay").fadeIn(300);
    $('.checkContainer').hide();
    $('.errorContainer').hide();
    $('.loader').show();

    var formData = new FormData($(this)[0]);
    setTimeout(function() {
        $('.loader').hide();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: formData,
            cache: false,
            processData: false, 
            contentType: false,
            success: function (data) {
                console.log(data);
                obj = jQuery.parseJSON(data);
                console.log(obj);
                if(obj.status == "200"){
                
                    $('.checkContainer').fadeIn('slow', function () {});
                    setTimeout(function() {
                        $(".loadOverlay").fadeOut('slow', function () {});
                        Alpine.store('toasts').createToast(
                            "Form submitted successfully",
                            'success'
                        );
                        rfapprovemodal.close();
                        $(`.rfTableBody`).empty();
                        addRow();
                        calculate();
                        updateBody();
                    }, 2000);
                }else{
                    $('.errorContainer').fadeIn('slow', function () {});
                    setTimeout(function() {
                        $('.loader').hide();
                        $(".loadOverlay").fadeOut('slow', function () {});
                            Alpine.store('toasts').createToast(
                                "Error submitting form, please check your values and try again.",
                                'error',
                                5000
                            )
                        
                    }, 2000);
                }
            },
            error: function (request, status, error) {
                $('.errorContainer').fadeIn('slow', function () {});
                setTimeout(function() {
                    
                    $(".loadOverlay").fadeOut('slow', function () {});
                        Alpine.store('toasts').createToast(
                            "Error occured. Please try again",
                            'error',
                            5000
                        )
                    
                }, 2000);
            }
        });
    }, 5000);
});

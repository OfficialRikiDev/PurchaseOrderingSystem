$(document).ready(function() {
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
            });

            $('.rfDecline').on('click',function(){
                rfId = $(this).parent().data("id");
                declineRfsModal.showModal()
                console.log(rfId)
                
            });
        }
    });
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
                updateInner();
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
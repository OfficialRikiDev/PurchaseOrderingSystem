$(document).ready(function() {
    function load_notifications(view = '') {
        //console.log('Loading notifications');
        $.ajax({
            url:"/backend/action.php",
            method: "POST",
            data:{view : view,
                range: 0},
            success:function(data)
            {
                //console.log(data);
                if(data.notifications.length > 0){
                    var notifications = '';
                    $.each(data.notifications, function(key, value){
                        var notifElement = $(value.content);
                        notifElement.find('.notif-elapse').html(value.timestamp);
                        if(value.viewed == 0) {
                            notifElement.addClass('bg-gray-700');
                        }
                        notifications += notifElement.prop('outerHTML');
                    });
                    if($('#dropdownNotification').is(":hidden")){
                        $('.notification-content').html(notifications);
                    }
                    
                }
                if(data.count > 0){
                    $('.notif-bubble').removeClass('hidden');
                }
            }
        });
    }
    load_notifications();

    setInterval(function(){
        if($('#dropdownNotification').is(":hidden")){
            load_notifications();
        }
    }, 1000);
});
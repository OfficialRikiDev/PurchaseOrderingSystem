$(document).ready(function() {
    $.ajax({
        url:"backend/action.php",
        method: "POST",
        data:{getProduct : 'getProduct'},
        success:function(data)
        {
            console.log("inventory")
            console.log(data);
            $(".invBody").html(data);
            
        }
    });
});
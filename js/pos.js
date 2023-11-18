$(document).ready(function() {
    $.ajax({
        url:"backend/action.php",
        method: "POST",
        data:{getPOS : 'getPOS'},
        success:function(data)
        {
            console.log(data);
            $(".posBody").html(data);
            
        }
    });
});
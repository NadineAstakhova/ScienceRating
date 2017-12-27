/**
 * Created by Nadine on 14.11.2017.
 */
$(document).ready(function(){
    setTimeout(function(){$('#mesSuccessAdd').slideUp('slow')},5000);
});

$(document).ready(function(){
    $('#btn-u, #btn-u1').bind("click",function()
    {
        let imgVal = $('.owners:checked').val();
        console.log(imgVal);
        if(imgVal === undefined)
        {
            $("#error-u").html("Выберите пользователя");
            return false;
        }
    });
});
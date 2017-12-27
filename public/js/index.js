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

/**
 * For Create Rating page
 */
$(document).ready(function(){
    $('#btn, #btn-doc').bind("click",function()
    {
        let imgVal = $("select#students option:checked").val();
        if(imgVal == '')
        {
            $("#error").html("Выберите пользователя");
            return false;
        }
    });
    $('#btn1, #btn-doc1').bind("click",function()
    {
        let imgVal = $("select#students1 option:checked").val();
        if(imgVal == '')
        {
            $("#error1").html("Выберите пользователя");
            return false;
        }
    });
    $('#btn2, #btn-doc2').bind("click",function()
    {
        let imgVal = $('.owners:checked').val();
        if(imgVal === undefined)
        {
            $("#error2").html("Выберите пользователя");
            return false;
        }
    });


});

$(document).ready(function() {
    $("#date").inputmask("dd-mm-yyyy");
    $('#allField').change(
        function(){
            const COLOR_AUTO_FILL = "#3A5FCD";

            if ($(this).is(':checked')) {
                $("#nameT").html("Поле будет заполнено автоматически");
                $("#dateT").html("Поле будет заполнено автоматически");
                $("#typeT").html("Поле нужно будет заполнить самостоятельно");
                $("#name").css("border-color", COLOR_AUTO_FILL);
                $("#date").css("border-color", COLOR_AUTO_FILL);

            }
            else {
                $("#nameT").html("");
                $("#dateT").html("");
                $("#typeT").html("");
                $("#name").css("border-color", "#ccc");
                $("#date").css("border-color", "#ccc");
            }
        });

    $("#date").keyup(function () {

        //checking if these strings are dates
        const data = $("#date").val();
        let mach;
        let res;
        if(data.length > 4) {
            mach = /^(\d{2})-(\d{2})-(\d{4})$/.exec(data);
            res = mach !== null ? new Date(mach[3] + "-" + mach[2] + "-" + mach[1]) : null;
        }
        else {
            mach = /^(\d{4})$/.exec(data);
            res = mach !== null ? new Date(mach[1] + "-01-01") : null;
        }



        if (res === null || isNaN(res.getTime()))
            $("#dateT").html("Заполните поле в соответствии с шаблоном и без букв: 11-10-2012, 2012").
            css("color", "red");
        else if (data.length === 4 && res.getFullYear() > new Date().getFullYear())
            $("#dateT").html("Год больше текущего. Вы из будущего?").
            css("color", "red");
        else if (data.length > 4 && res > new Date())
            $("#dateT").html("Дата больше текущей. Вы из будущего?").
            css("color", "red");
        else
            $("#dateT").html("");
    });



    $('#btn').bind("click",function()
    {
        let imgVal = $('#file').val();
        var allowedExtensions = /(\.rar|\.docx|\.doc|\.pdf|\.zip)$/i;
        var allowedExtensionsAuto = /(\.pdf)$/i;

        if(!allowedExtensions.exec(imgVal) || (!allowedExtensionsAuto.exec(imgVal) && $('#allField').is(':checked'))){
            $("#error").html("Не верный тип файла");
            return false;
        }

        if(imgVal === '')
        {
            $("#error").html("Загрузите файл");
            return false;
        }

    });
});
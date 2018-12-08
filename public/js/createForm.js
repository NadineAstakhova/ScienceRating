$(document).ready(function() {
    $("#date").inputmask("(9999)|(99-99-9999)");

    $('#allField').change(
        function(){
            const COLOR_AUTO_FILL = "#3A5FCD";

            if ($(this).is(':checked')) {
                $("#nameT").html("Поле буде заповнено автоматично");
                $("#dateT").html("Поле буде заповнено автоматично");
                $("#typeT").html("Поле потрібно буде заповнити самостійно");
                $("#pagesT").html("Поле будет заполнено автоматически");
                $("#publishingT").html("Поле потрібно буде заповнити самостійно");
                $("#name").css("border-color", COLOR_AUTO_FILL);
                $("#date").css("border-color", COLOR_AUTO_FILL);
                $("#pages").css("border-color", COLOR_AUTO_FILL);

            }
            else {
                $("#nameT").html("");
                $("#dateT").html("");
                $("#typeT").html("");
                $("#pagesT").html("");
                $("#publishingT").html("");
                $("#name").css("border-color", "#ccc");
                $("#date").css("border-color", "#ccc");
                $("#pages").css("border-color", "#ccc");
            }
        });

    $("#date").keyup(function () {
        validateDate();
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

        if(!$('#allField').is(':checked')){
           if(!validateDate())
               return false;
        }

    });

    function validateDate(){
        //checking if these strings are dates
        const data = $("#date").val();
        let mach;
        let res;
        if(data.length > 4) {
            mach = /^(\d{2})-(\d{2})-(\d{4})$/.exec(data);
            if(!(mach[2] === '02' && mach[1] > 29))
                res = mach !== null ? new Date(mach[3] + "-" + mach[2] + "-" + mach[1]) : null;
        }
        else {
            mach = /^(\d{4})$/.exec(data);
            res = mach !== null ? new Date(mach[1] + "-01-01") : null;
        }

        if (res === null || isNaN(res.getTime())) {
            $("#dateT").html("Заполните поле в соответствии с шаблоном и без букв: 11-10-2012, 2012").css("color", "red");
            return false;
        }
        else if (data.length === 4 && res.getFullYear() > new Date().getFullYear()){
            $("#dateT").html("Год больше текущего. Вы из будущего?").
                css("color", "red");
            return false;
        }
        else if (data.length === 4 && res.getFullYear() < '1970'){
            $("#dateT").html("Дата имеет слишком давний год").
            css("color", "red");
            return false;
        }
        else if (data.length > 4 && res > new Date()){
            $("#dateT").html("Дата больше текущей. Вы из будущего?").
                css("color", "red");
            return false;
        }
        else if (data.length > 4 && res < new Date('1900-01-01')){
            $("#dateT").html("Дата имеет слишком давний год").
                css("color", "red");
            return false;
        }
        else
            $("#dateT").html("");
        return true;
    }
});
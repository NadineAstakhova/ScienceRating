$(document).ready(function() {
    $('#passConf').keyup(function() {
        formval();
    });
    $('#passNew').keyup(function() {
        formval();
    });
    function formval() {
        if($('#passNew').val() != $('#passConf').val()) {
            $('#conf').html('Пароли не совпдают');
            $('#btn').prop( "disabled", true );
        }
        else {
            $('#conf').html('');
            $('#btn').prop( "disabled", false );
        }
    }
});
function messageAlert(btn, text){
    $(btn).on('click', function () {
        return confirm(text);
    });
}
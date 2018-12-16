$(document).ready(function(){
    $('.delete_btn').on('click', function () {
        return confirm('Вы уверены, что хотите удалить научный результат для пользователя?');
    });

    $('#print').click(function(){
        var printing_css = "<style media=print>" +
            "#print, .breadcrumb, .delete_btn, .update_btn, .form-control, .no-print{display: none;}" + ".printed-center{text-align: center}" +
            "th, td{border: 1px solid black; padding: 5px;}  a{text-decoration: none; color: black}" +
            "table{text-align: left; border-collapse: collapse;} </style>";
        var html_to_print=printing_css+$('#to_print').html();
        var iframe=$('<iframe id="print_frame">');
        $('body').append(iframe);
        var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
        var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
        doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
        win.print();
        $('iframe').remove();
    });

});
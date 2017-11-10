/**
 * Created by Nadine on 10.11.2017.
 */
/*
    Fill information at dynamic dropdown lists. Groups and Students
 */
function fillFields(e, el, url, text){
    let group_id = e.target.value;
    $.get(url+'=' + group_id, function(data) {
        //   console.log(data);
        $(el).empty();
        if (data.length !== 0) {
            $(el).append(
                $('<option disabled selected></option>').val("").html(text)
            );
            $.each(data, function (index, subCatObj) {
                if(el == "#students")
                    $(el).append(
                        $('<option></option>').val(subCatObj.id).html(subCatObj.name + ' ' + subCatObj.surname)
                    );
                if(el == "#groups")
                    $(el).append(
                        $('<option></option>').val(subCatObj.idgroup).html(subCatObj.name)
                    );
            });
        }
        else {
            $(el).append(
                $('<option disabled selected></option>').val("").html("Нет данных")
            );
        }
    });
}

/*
    Show Tabs At raking page
 */
function showTabs(id){
    let numItems = $('.ranking').length;
    for (let i = 0; i < numItems; i++) {
        if (i == id) {
            $('#'+id).addClass('header-active');
            $('#' + i + '-content').slideDown('slow');

        }
        else {
            $('#' + i + '-content').slideUp('slow');
            $('#'+i).removeClass('header-active');
        }
    }
}

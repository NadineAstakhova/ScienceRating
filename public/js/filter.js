/**
 * Created by Nadine on 01.11.2017.
 * Functions for sort in the user table
 */
$(document).ready(function(){
    //by user's name
    $("#search").keyup(function(){
        let searchName = $("#search").val().toLowerCase();
        let userType = $('#selectFilter').find(":selected").attr("id").toLowerCase();
        filtTable(searchName, userType);
    });
    //by type of user
    $('#selectFilter').change(function () {
        let userType = $('#selectFilter').find(":selected").attr("id").toLowerCase();
        let searchName = $("#search").val().toLowerCase();
        filtTable(searchName, userType);
    });

    function filtTable(searchName,userType) {
        if (userType.toLowerCase() == "all") userType="";
        let seachNameRegex = '.*'+searchName+".*";
        let userTypeRegex = '.*'+userType+".*";
        $.each($('table tbody tr'), function() {
            if(    ($(this).find('td.name').text().toLowerCase().search(seachNameRegex) === -1)
                || ($(this).find('td.type').text().toLowerCase().search(userTypeRegex) === -1)
            )
                $(this).hide();
            else
                $(this).show();
        });
    }
});
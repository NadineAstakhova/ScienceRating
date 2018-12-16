const CHANGE_BUTTON_CLASS = "change-button";
const SAVE_BUTTON_CLASS = "save_button";

//href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale()."/editRanking/$event->idRankEvent")}}

const showInputProvider = (id, marksPrefix, codesPrefix, buttonPrefix, phpController, type) => {

    const mark = $(`#${marksPrefix}_${id}`);
    const code = $(`#${codesPrefix}_${id}`);
    const button = $(`#${buttonPrefix}_${id}`);

    const isSave =  button.attr("class").includes(type);


    if (isSave){
        const markVal = mark.val();
        const codeVal = code.val();
        $.post(`${document.location.origin}/public/${phpController}`, {
                crossDomain: true,
                idEventType: id,
                newValueMark: markVal,
                newValueCode: codeVal,
                _token: $('meta[name=csrf-token]').attr('content'),
                headers: {
                    "accept": "application/json",
                    "Access-Control-Allow-Origin":"*"
                }
            }
        ).done(function() {
            button.attr("src", button.attr("src").replace("save", "edit"));
            button.attr("class", button.attr("class").replace(type,CHANGE_BUTTON_CLASS));
            mark.replaceWith(`<div id='${marksPrefix}_${id}'>${markVal}</div>`);
            code.replaceWith(`<div id='${codesPrefix}_${id}'>${codeVal}</div>`);
        }).fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus, jqXHR );
        });

    }
    else{
        if (document.getElementsByClassName(type).length !== 0) {
            alert("Можно редактирвать только один тип одновременно!");
        }
        else {
            mark.replaceWith(`<div><input id='${marksPrefix}_${id}' type='number' value='${mark.text()}' step="0.1" min="1" class="form-control"/></div>`);
            code.replaceWith(`<div><input id='${codesPrefix}_${id}' type='text' value='${code.text()}' class="form-control"></div>`);
            button.attr("src", button.attr("src").replace("edit", "save"));
            button.attr("class", button.attr("class").replace(CHANGE_BUTTON_CLASS, type));

        }
    }
};
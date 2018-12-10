var DOMAIN;
$(document).ready(function(){
    console.log(window.location.host.includes("paramonov"));
    if(window.location.host.includes("paramonov"))
        DOMAIN = PROD;
    else
        DOMAIN = DEV;
    init();
});

const styleTextElem = "unic-text-percent";
const styleInputElem = "form-control percentInputArr";
const PROD = 'http://paramonov.info/srs/public/';
const DEV = 'http://sciencerating/public/';

const setElementVisible = (elId, display) => {
    // const elInput = document.getElementById('percentInput['+ elId +']');
    // const elText = document.getElementById('percentInput['+ elId +']');

    document.getElementById('percentInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
    document.getElementById('percent['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
};

/**
 *
 * @param text format ex. textbala[3]
 * @returns {string} number beetwen [ and ]
 */
const getNumberFromId = (text) => {
    console.log("text",text);
    const n = text.indexOf('[');

    return text.substr(n+1,(text.length - (n + 2)) );
};

const showInputProvider = (id) => {
    showInput([{display:true, id:id}]);
    document.getElementById('percentInput['+ id +']').focus();
};

const blurInputProvider = (id, idPublication) => {
    showInput([{display:false, id:id}]);
    blurLogic({idPublication:idPublication,  id:id, newValue:document.getElementById('percentInput['+ id +']').value});
};

// state.el = [{id:1, display:true}, {id:2,display:false}]
const showInput = (state) => {
    state.map(st => setElementVisible(st.id, st.display));
};

const setValue = (id, newVal, field, fieldInput) => {
    console.log(fieldInput);
    document.getElementById(fieldInput+'['+ id +']').value = newVal;
    document.getElementById(field+'['+ id +']').innerHTML = newVal;
};

const blurLogic = (obj) =>{

    $.post(DOMAIN + 'editPercent', {
            crossDomain: true,
            idPublication: obj.idPublication,
            newValue: obj.newValue,
            _token: $('meta[name=csrf-token]').attr('content'),
            headers: {
                "accept": "application/json",
                "Access-Control-Allow-Origin":"*"
            }
        }
    )
        .done(function(data) {
            setValue(obj.id, data, 'percent',  'percentInput');
        })
        .fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus );
        });

};

const init = () => {
    console.log(" Array.of(document.getElementsByClassName(styleTextElem))",
        Array.from(document.getElementsByClassName(styleTextElem))[0]);

    Array.from(document.getElementsByClassName(styleTextElem))
        .forEach(el => setElementVisible(getNumberFromId(el.id),false))
};

const showInputProviderRes = (id) => {
    showInputRes([{display:true, id:id}]);
    document.getElementById('resultInput['+ id +']').focus();
};

const showInputRes = (state) => {
    state.map(st => setElementResVisible(st.id, st.display));
};

const setElementResVisible = (elId, display) => {
    document.getElementById('resultInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
    document.getElementById('result['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
};

const blurInputProviderRes= (id, idMember) => {
    showInputRes([{display:false, id:id}]);
    let e = document.getElementById('resultInput['+ id +']');
    blurLogicRes({idMember:idMember, newValue:e.value,  id:id, text: e.options[e.selectedIndex].text});
};
const blurLogicRes = (obj) =>{

    $.post(DOMAIN + 'editResult', {
            crossDomain: true,
            idMember: obj.idMember,
            newValue: obj.newValue,
            _token: $('meta[name=csrf-token]').attr('content'),
            headers: {
                "accept": "application/json",
                "Access-Control-Allow-Origin":"*"
            }
        }
    )
        .done(function(data) { //meow
            //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
            setValue(obj.id, obj.text,  'result', 'resultInput');
        })
        .fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus );
        });

};

const showInputProviderRole = (id) => {
    showInputRole([{display:true, id:id}]);
    document.getElementById('roleInput['+ id +']').focus();
};

const showInputRole = (state) => {
    state.map(st => setElementRoleVisible(st.id, st.display));
};

const setElementRoleVisible = (elId, display) => {
    document.getElementById('roleInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
    document.getElementById('role['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
};

const blurInputProviderRole= (id, idMember) => {
    showInputRole([{display:false, id:id}]);
    let e = document.getElementById('roleInput['+ id +']');
    blurLogicRole({idMember:idMember, newValue:e.value, id:id,
        text: e.options[e.selectedIndex].text});
};
const blurLogicRole = (obj) =>{

    $.post(DOMAIN + 'editRole', {
            crossDomain: true,
            idMember: obj.idMember,
            newValue: obj.newValue,
            _token: $('meta[name=csrf-token]').attr('content'),
            headers: {
                "accept": "application/json",
                "Access-Control-Allow-Origin":"*"
            }
        }
    )
        .done(function(data) { //meow
            //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
            setValue(obj.id, obj.text, 'role',  'roleInput');
        })
        .fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus );
        });

};
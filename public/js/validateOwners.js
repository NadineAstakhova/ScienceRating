const isValidateTrue = () => {
    let whoUse = [];

    const sum =
        Array.from(document.getElementsByClassName("unic-check"))
            .filter(che => che.checked)
            .map(che => {whoUse.push(che.id.replace("arrOwners[","arrRole[")); return che;})
            .reduce((a,b) => a +
                Number.parseInt(
                    document.getElementById("arrRole["+b.id.replace("arrOwners[","").replace("]","")+"]").value)
                ,0);


    return { whoUse:whoUse, valid: sum === 100 }
};


const getState = () => {

    const validTrueClassName = "form-control unic-input valid-true";
    const validFalseClassName = "form-control unic-input valid-false";
    const validRes = isValidateTrue();

    console.log(validRes.whoUse.length);

    if(validRes.valid === false && validRes.whoUse.length > 0){
        $('.btn-submit').prop('disabled', true);
        $("#error").html("Сумма процентов написания должна быть равна 100");

    }
    else{
        $('.btn-submit').prop('disabled', false);
        $("#error").html("");
    }

    Array.from(document.getElementsByClassName("unic-input"))
        .map(el =>
            validRes.whoUse.includes(el.id)
                ? (validRes.valid)
                ? el.className = validTrueClassName
                : el.className = validFalseClassName
                : el.className = validTrueClassName
        )
};

$(document).ready(()=> getState());
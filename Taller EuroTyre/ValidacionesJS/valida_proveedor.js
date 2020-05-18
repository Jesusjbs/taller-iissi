function valida() {
    var error1 = tipo();
    return (error1.length == 0);
}

function tipo(){
    var tipo = document.getElementById("id_tipo");
    var valor = tipo.value;

    if(valor!="Piezas" && valor!="Residuos"){
        var error= 'El campo Tipo solo puede contener los valores "Piezas" o "Residuos"';
    } else {
        var error = '';
    }
    tipo.setCustomValidity(error);
    return error;
}

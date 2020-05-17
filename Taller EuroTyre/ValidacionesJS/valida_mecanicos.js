function valida() {
    var error1 = especialidad();
    var error2 = jefe();
    return (error1.length == 0 && error2.length == 0);
}

function especialidad(){
    var especialidad = document.getElementById("id_especialidad");
    var valor = especialidad.value;

    if(valor!="Mecánica" && valor!="Neumática"){
        var error= 'El campo Especialidad solo puede contener los valores "Mecánica" o "Neumática".';
    }else{
        var error = '';
    }
    especialidad.setCustomValidity(error);
    return error;
}

function jefe() {
    var jefe = document.getElementById("id_jefe");
    var valor = jefe.value;

    if(valor!="SI" && valor!="NO"){
        var error= 'El campo jefe solo puede contener los valores "SI" o "NO".';
    }else{
        var error = '';
    }
    jefe.setCustomValidity(error);
    return error;
}
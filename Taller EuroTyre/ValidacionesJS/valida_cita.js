function valida() {
    var error1 = fecha();
    return error1 == 0;
}

function fecha() {
    var fecha = document.getElementById("id_dia");
    var value = fecha.value;

    var fechaSinFormat = new Date(value);
    var actualSinFormat = new Date();
    var diaSol = fechaSinFormat.getDate();
    var mesSol = fechaSinFormat.getMonth();
    var diaAct = actualSinFormat.getDate();
    var mesAct = actualSinFormat.getMonth();
    if(mesSol.length == 1) {
        var mesSol = "0" + mesSol;
    }
    if(mesAct.length == 1) {
        var mesAct = "0" + mesAct;
    }
    var anyoINI = fechaSinFormat.getFullYear();
    var anyoFIN = actualSinFormat.getFullYear();

    var fechaConFormat = ""+anyoINI+mesSol+diaSol;
    var actualConFormat = ""+anyoFIN+mesAct+diaAct;

    if(fechaConFormat <= actualConFormat){
        var error = 'La fecha de la cita debe ser posterior a la fecha actual';
    }else{
        var error='';
    }
    fecha.setCustomValidity(error);
    return error;
}
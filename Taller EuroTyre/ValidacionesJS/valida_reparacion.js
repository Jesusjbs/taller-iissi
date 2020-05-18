function valida() {
    var error2 = estado();
    var error3 = presupuesto();
    var error4 = fechas();
    return (error2.length == 0 && error3.length == 0 && error4.length == 0);
}

function presupuesto() {
    var presupuesto = document.getElementById("id_presupuesto");
    var valor = presupuesto.value;

    if(valor!="SI" && valor!="NO"){
        var error= 'El campo presupuesto solo puede contener los valores "SI" o "NO"';
    }else{
        var error = '';
    }
    presupuesto.setCustomValidity(error);
    return error;
}

function estado() {
    var estado = document.getElementById("id_estado");
    var fechaFin = document.getElementById("id_fechaFin");
    var valorFecha= fechaFin.value;
    var valor = estado.value;

    if(valor != "Pendiente" && valor != "EnProceso" && valor != "Finalizada"){
        var error= 'El campo estado solo puede contener los valores "Pendiente", "EnProceso" o "Finalizada"';
    }else if(valorFecha != "" && (valor!="Pendiente" || valor !="EnProceso")){
        var error = 'Si la fecha de finalización está rellena el campo de estado deberá de tomar el valor de "Finalizada"';
    }
    else{
        var error = '';
    }
    estado.setCustomValidity(error);
    return error;
}

function fechas() {
    var fechaFin = document.getElementById("id_fechaFin");
    var fechaInicio = document.getElementById("id_fechaRep");
    var fechaFinValue = fechaFin.value;
    var fechaInicioValue = fechaInicio.value;
    var f = new Date();
    var dia = f.getDate();
    var mes = f.getMonth();
    if(mes.length == 1) {
        var mes = "0" + mes;
    }
    var anyo = f.getFullYear();
    var fechaAc = ""+anyo+mes+dia;
    if(true){
        var error = fechaAc;
    }else{
        var error='';
    }
    fechaFin.setCustomValidity(error);
    return error;
}


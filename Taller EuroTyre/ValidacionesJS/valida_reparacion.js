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
    var valorFecha = fechaFin.value;
    var valor = estado.value;

    if(valor != "Pendiente" && valor != "EnProceso" && valor != "Finalizada"){
        var error= 'El campo estado solo puede contener los valores "Pendiente", "EnProceso" o "Finalizada"';
        estado.setCustomValidity(error);
    } else if(valorFecha.length == 0 && valor == "Finalizada"){
        var error = 'Si el estado es "Finalizada" la fecha de fin debe estar rellena';
        estado.setCustomValidity(error);
    } else if(valorFecha.length != 0 && valor != "Finalizada"){
        var error = 'Si la fecha de finalización está rellena el campo Estado deberá tomar el valor "Finalizada"';
        estado.setCustomValidity(error);
    } else{
        var error = '';
    }
    return error;
}

function fechas() {
    var fechaFin = document.getElementById("id_fechaFin");
    var fechaSolicitud = document.getElementById("id_fechaSolicitud");
    var fechaInicio = document.getElementById("id_fechaRep");

    var fechaSoliValue = fechaSolicitud.value;
    var fechaFinValue = fechaFin.value;
    var fechaInicioValue = fechaInicio.value;

    var iniSinFormat = new Date(fechaInicioValue);
    var solicitudSinFormat = new Date(fechaSoliValue);
    var finSinFormat = new Date(fechaFinValue);
    
    var diaSOL = solicitudSinFormat.getDate();
    var mesSOL = solicitudSinFormat.getMonth();
    
    var diaINI = iniSinFormat.getDate();
    var mesINI = iniSinFormat.getMonth();
    
    var diaFIN = finSinFormat.getDate();
    var mesFIN = finSinFormat.getMonth();

    if(mesSOL.length == 1) {
        var mesSOL = "0" + mesSOL;
    }
    if(mesINI.length == 1) {
        var mesINI = "0" + mesINI;
    }
    if(mesFIN.length == 1) {
        var mesFIN = "0" + mesFIN;
    }
    var anyoSOL = solicitudSinFormat.getFullYear();
    var anyoINI = iniSinFormat.getFullYear();
    var anyoFIN = finSinFormat.getFullYear();

    var solicitudConFormat = ""+anyoSOL+mesSOL+diaSOL;
    var iniConFormat = ""+anyoINI+mesINI+diaINI;
    var finConFormat = ""+anyoFIN+mesFIN+diaFIN;

    if(solicitudConFormat >= iniConFormat) {
        var error = 'La fecha de reparación debe ser posterior a la fecha de solicitud';
        fechaInicio.setCustomValidity(error);
    }else if(iniConFormat >= finConFormat){
        var error = 'La fecha de finalización debe ser posterior a la fecha de inicio';
        fechaFin.setCustomValidity(error);
    }else{
        var error='';
    }
    return error;
}


function valida1() {
    var error1 = manoDeObra();
    var error2 = IVA();
    return (error1.length == 0 && error2.length == 0);
}

function valida2() {
    var error1 = manoDeObra();
    var error2 = IVA();
    var error3 = tipoPago();
    return (error1.length == 0 && error2.length == 0 && error3.length == 0);
}

function tipoPago(){
    var tipo = document.getElementById("id_tipoPago");
    var valor = tipo.value;

    if(valor!="Efectivo" && valor!="Tarjeta"){
        var error= 'El campo Tipo de Pago solo puede contener los valores "Efectivo" o "Tarjeta"';
    } else {
        var error = '';
    }
    tipo.setCustomValidity(error);
    return error;
}

function IVA(){
    var iva = document.getElementById("id_iva");
    var valor = iva.value;
    if(!valor.Number){
        var error= 'El IVA solo debe contener números';
    }
    else if(valor < 0 || valor > 1){
        var error= 'El IVA debe estar entre 0 y 1';
    } else {
        var error = '';
    }
    iva.setCustomValidity(error);
    return error;
}

function manoDeObra(){
    var manoDeObra = document.getElementById("id_manoDeObra");
    var valor = manoDeObra.value;
    var number = /^{1,9}\d*\.{0,2}\d+$/;

    if(number.test(valor)){
        var error= 'La mano de obra debe ser un valor numérico';
    } else if(valor == 0) {
        var error= 'La mano de obra debe ser mayor a 0';
    } else {
        var error = '';
    }
    manoDeObra.setCustomValidity(error);
    return error;
}
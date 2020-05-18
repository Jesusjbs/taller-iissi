
function valida1() {
    var error1 = IVA();
    var error2 = manoDeObra();
    return (error1.length == 0 && error2.length == 0);
}

function valida2() {
    var error1 = IVA();
    var error2 = manoDeObra();
    var error3 = tipoPago();
    return (error1.length == 0 && error2.length == 0 && error3.length == 0);
}

function tipoPago(){
    var tipoP = document.getElementById("id_tipoPago");
    var valor = tipoP.value;

    if(valor!="Efectivo" && valor!="Tarjeta"){
        var error= 'El campo Tipo de Pago solo puede contener los valores "Efectivo" o "Tarjeta"';
    } else {
        var error = '';
    }
    tipoP.setCustomValidity(error);
    return error;
}

function manoDeObra(){
    var manoDeObra = document.getElementById("id_manoDeObra");
    var valor = manoDeObra.value;
    var patron = /^[0-9]{1,4}([.])?([0-9]{0,2})?$/;
    var letras = /[^0-9.]+/;
    if(valor.length > 7){
        var error = "La mano de obra debe contener menos de 6 dígitos";
    }else if(letras.test(valor)){
        var error = "No puede contener letras ni otros caracteres especiales";
    }else if(!patron.test(valor)){
        var error = "La mano de obra no tiene un formato válido (XXXX.XX)"
    } else {
        var error = '';
    }
    manoDeObra.setCustomValidity(error);
    return error;
} 

function IVA(){
    var iva = document.getElementById("id_iva");
    var valor = iva.value;
    var entera = valor.split(".")[0];
    var patron = /^[0-1]{0,1}([.])?([0-9]{0,2})?$/;
    var letras = /[^0-9.]+/;
    
    if(letras.test(valor)){
        var error= 'El IVA solo debe contener números';
    } else if (!patron.test(valor)) {
        var error = 'El IVA no tiene formato válido'
    } else if((valor < 0 || valor > 1)) {
        var error = 'El IVA debe de estar en entre 0 y 1';
    } else if (entera.length > 1) {
        var error = 'La parte entera solo puede contener un dígito';
    } else {
        var error = '';
    }
    iva.setCustomValidity(error);
    return error;
}
function valida() {
    var error1 = contraseña();
    return (error1.length == 0);
}

function contraseña() {
    var contraseña = document.getElementById("id_contraseña");
    var confirmar = document.getElementById("id_confirmar");
    var contraseñaValue = contraseña.value;
    var confirmarValue = confirmar.value;
    
    if(contraseñaValue != confirmarValue) {
        var error= 'Las contraseñas deben coincidir';
    }else{
        var error = '';
    }
    confirmar.setCustomValidity(error);
    return error;
}
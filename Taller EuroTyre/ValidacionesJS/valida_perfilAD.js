function valida() {
    var error1 = especialidad();
    var error2 = contraseña();
    return (error1.length == 0 && error2.length == 0);
}

function especialidad(){
    var especialidad = document.getElementById("id_especialidad");
    var valor = especialidad.value;

    if(valor!="Mecánica" && valor!="Neumática"){
        var error= 'El campo Especialidad solo puede contener los valores "Mecánica" o "Neumática"';
    }else{
        var error = '';
    }
    especialidad.setCustomValidity(error);
    return error;
}

function contraseña() {
    var antigua = document.getElementById("id_antigua");
    var contraseña = document.getElementById("id_contraseña");
    var confirmar = document.getElementById("id_confirmar");
    var contraseñaValue = contraseña.value;
    var antiguaValue = antigua.value;
    var confirmarValue = confirmar.value;
    var error = '';    
    var hasNumber = /\d/;
	var hasUpperCases = /[A-Z]/;
	var hasLowerCases = /[a-z]/;

    if(antiguaValue != "" && contraseñaValue != "" && contraseñaValue.length < 6) {
        var error= 'La nueva contraseña debe tener más de 6 caracteres';
        contraseña.setCustomValidity(error);
    }else if(antiguaValue == "" && contraseñaValue != ""){
        var error = 'Introduce la contraseña antigua para cambiarla';
        antigua.setCustomValidity(error);
    } else if(contraseñaValue != "" && !(hasNumber.test(contraseñaValue)) && !(hasUpperCases.test(contraseñaValue)) && !(hasLowerCases.test(contraseñaValue))) {
        var error = 'Contraseña no válida: debe contener letras mayúsculas y minúsculas y números'
        contraseña.setCustomValidity(error);
    } else if(contraseñaValue != confirmarValue) {
        var error = 'La confirmación de contraseña no coincide con la contraseña'
        confirmar.setCustomValidity(error);
    } else if(contraseñaValue.length > 50){
        var error = 'La contraseña debe de tener menos de 50 caracteres';
        contraseña.setCustomValidity(error);
    } else {
        var error = '';
        confirmar.setCustomValidity(error);
        contraseña.setCustomValidity(error);
        antigua.setCustomValidity(error);
    }

    /*$.get('gestionarAdmin.php', { c : antiguaValue }, function(data) {
        if(antiguaValue != "" && data == 'incorrecta') {
            var error = 'La contraseña antigua introducida no es correcta';
            contraseña.setCustomValidity(error);        
        }
    });*/
    
    return error;
}

function validarForm() {
    var error1=especialidad();
    return error1.length==0;
}

function especialidad() {
    
    var especialidad = document.getElementById("id_nombre");
    var valor = especialidad.value;
    var valido = true;
    
    valido = valido && (valor.length > 5);
    if(!valido){
        var error="Longitud del campo incorrecto";
    }else{
        var error = "";
    }
    
    /*if(especialidad == "") {
        especialidad.setCustomValidity("La especialidad no sigue el formato correcto, debe ser 'Mecánica' o 'Neumática'");
        alert("No se puede");
        return false;
    } else if(especialidad != "Neumática" && especialidad != "Mecánica") {
        especialidad.setCustomValidity("La especialidad no sigue el formato correcto, debe ser 'Mecánica' o 'Neumática'");
        alert("No se puede");
        return false;
    }
    alert("No se puede");*/
    control1.setCustomValidity(error);
    return error;
}
<?php

session_start();

if(isset($_SESSION["reparacion"])) {
	$reparacion = $_SESSION["reparacion"];
} else {
	Header("Location: home.php");
}

$errores = validarDatosReparacion($reparacion);

if (count($errores)>0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
		Header('Location: home.php');
} else {
	Header('Location: accion_modificar_reparacion.php');
}

function validacionFecha($fe){
    $valores = explode('/', $fe);
    //a checkdate le entra mes dia y año y lo valida
    if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
    return true;
    }
    return false;
    }

function validarDatosReparacion($reparacion){
    // Validación del fecha de Inicio		
    if($reparacion["fechaInicio"]==""){
        $errores[] = "<p>La fecha no puede estar vacía</p>";
    } else if(validacionFecha($reparacion["fechaInicio"])) {
        $errores[] = "<p>La fecha no es del tipo correcto</p>";
    }

    //Validar el estado de Reparación
    if($reparacion["estado"]=="") 
        $errores[] = "<p>El estado no puede estar vacío, debe ser 'Pendiente','EnProceso','Finalizada'</p>";
    else if((strcmp($reparacion["estado"], "Pendiente") != 0) && (strcmp($reparacion["estado"], "EnProceso") != 0)
            && (strcmp($reparacion["estado"], "Finalizada") != 0)) {
        $errores[] = "<p>El estado no sigue el formato correcto, debe ser debe ser 'Pendiente', 'EnProceso', 'Finalizada'</p>";
    }

    //Validar si tiene presupuesto o no
        // Validación de tipo Proveedor
    if($reparacion["tienePresupuesto"]=="") 
        $errores[] = "<p>El campo Presupuesto no puede estar vacío, debe ser 'SI' o 'NO'</p>";
    else if((strcmp($reparacion["tienePresupuesto"], "SI") != 0) && (strcmp($reparacion["tienePresupuesto"], "NO") != 0)) {
        $errores[] = "<p>El presupuesto no sigue el formato correcto, debe ser 'SI' o 'NO'</p>";
    } else {
        if($reparacion["tienePresupuesto"] == "NO") {
            $_SESSION["reparacion"]["tienePresupuesto"] = 0;
        } else {
            $_SESSION["reparacion"]["tienePresupuesto"] = 1;
        }
    }

    //Validar fecha de finalización
    $feFin=$reparacion["fechaFin"];
    if($feFin != "") {
    $fecha_fin = date('Y/m/d',strtotime($reparacion['fechaFin']));
    $fecha_ini = date('Y/m/d',strtotime($reparacion['fechaInicio']));
    
    if(validacionFecha($feFin)) {
        $errores[] = "<p>La fecha no es del tipo correcto.</p>";
    }else if($fecha_ini >= $fecha_fin){
        $errores[] = "<p>La fecha de reparación tiene que ser anterior a la fecha de finalización</p>";
    }else if($reparacion["estado"] != "Finalizada" && $feFin !=""){
        $errores[] = "<p>Si el estado no es 'Finalizada' no puede existir fecha de Finalización</p>";
    }
    } else {
        if ($reparacion["estado"] == "Finalizada") {
            $errores[] = "<p>Si el estado es 'Finalizada' debe existir una fecha de fin</p>";
        }
    }
        return $errores;
    }
?>
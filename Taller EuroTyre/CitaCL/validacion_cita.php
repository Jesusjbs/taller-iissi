<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["cita"])) {
		// Recogemos los datos del formulario
		$nuevaCita["auto"] = $_REQUEST["auto"];
		$nuevaCita["dia"] = $_REQUEST["dia"];
		$nuevaCita["itv"] = $_REQUEST["itv"];
		if(!isset($_REQUEST["presupuesto"])) {
			$nuevaCita["presupuesto"] = 0;
		}
		else 
			$nuevaCita["presupuesto"] = 1;
    }
    
	else // En caso contrario, vamos al formulario
		Header("Location: home.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["cita"] = $nuevaCita;

	// Validamos el formulario en servidor 
    $errores = validarDatosCita($nuevaCita);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: home.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción de la cita en la base de datos)
        Header('Location: accion_cita.php');
        
	// Validación en servidor del formulario de alta de cita
    
	function validarDatosCita($nuevaCita){
		// Validación del día
		$fecha_actual = date("Y/m/d");
        $fecha_entrada = date('Y/m/d',strtotime($nuevaCita['dia']));
		
		if($nuevaCita['dia'] == "") {
			$errores[] = "<p>La fecha de solicitud es obligatoria</p>";
		} else if($fecha_actual >= $fecha_entrada) {
			$errores[] = "<p>La fecha de solicitud debe de ser posterior a la fecha actual</p>";
		}
		if($nuevaCita['auto'] == ""){
			$errores[] = "<p>Se debe seleccionar algún vehículo.</p>";
		}
		return $errores;
	}
?>
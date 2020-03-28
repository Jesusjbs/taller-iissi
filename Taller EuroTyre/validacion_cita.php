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
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
        Header('Location: home-request.php');
        
    ///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de cita //
    ///////////////////////////////////////////////////////////
    
	function validarDatosCita($nuevaCita){
        // Validación del día
        $fecha_actual = date("d/m/Y");
        $fecha_entrada = date('d/m/Y',strtotime($nuevaCita['dia']));
		if($fecha_actual >= $fecha_entrada) {
			$errores[] = "<p>La fecha se solicitud debe de ser posterior al día actual</p>";
        }
		return $errores;
	}
?>
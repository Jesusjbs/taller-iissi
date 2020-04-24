<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registro"])) {
		
		// Recogemos los datos del formulario
        $nuevoVehiculo["tipo"] = $_REQUEST["tipo"];
        if(!isset($_REQUEST["furgoneta"])) 	$nuevoVehiculo["furgoneta"] = 0;
		else $nuevoVehiculo["furgoneta"] = 1;
		$porciones = explode(" ", $_REQUEST["modelo"]);
		$nuevoVehiculo["modelo"] = (int) $porciones[0];
		$nuevoVehiculo["nombreModelo"] = $porciones[1];
		$nuevoVehiculo["matricula"] = $_REQUEST["matricula"];
		$nuevoVehiculo["color"] = $_REQUEST["color"];
    }
    
	else // En caso contrario, vamos al formulario
		Header("Location: formulario_vehiculo.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["registro"] = $nuevoVehiculo;

	// Validamos el formulario en servidor 
    $errores = validarDatosVehiculo($nuevoVehiculo);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_vehiculo.php');
	} else
        Header('Location: accion_vehiculo.php');
        
	// Validación en servidor del formulario de alta de vehículo
    
	function validarDatosVehiculo($nuevoVehiculo) {
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarVehiculo.php");
		$conexion = crearConexionBD();

	/*	if((cuentaModelos($conexion,$nuevoVehiculo["nombreModelo"]) > 0 && $nuevoVehiculo["tipo"] == "COCHE")
		|| (cuentaModelos($conexion,$nuevoVehiculo["nombreModelo"]) == 0 && $nuevoVehiculo["tipo"] == "MOTO")) {
			$errores[] = "El tipo y el modelo elegidos no son coherentes";
		} */
		
        if($nuevoVehiculo["furgoneta"] == 1 && $nuevoVehiculo["tipo"] == "MOTO")
			$errores[] = "<p>No se puede marcar simultaneamente tipo moto y furgoneta.</p>";
			
        // Validación del modelo
         if($nuevoVehiculo["nombreModelo"]=="") 
			$errores[] = "<p>El modelo no pueden estar vacío</p>";
		
        // Validación de la matrícula
		if($nuevoVehiculo["matricula"] =="") 
            $errores[] = "<p>La matrícula no puede estar vacía</p>";
        else if(!preg_match("/^[0-9]{4}[A-Z]{3}$/", $nuevoVehiculo["matricula"])){
            $errores[] = "<p>La matrícula no tiene formato válido: " . $nuevoVehiculo["matricula"]. "</p>";
        }
		cerrarConexionBD($conexion);
		return $errores;
	}

	
?>
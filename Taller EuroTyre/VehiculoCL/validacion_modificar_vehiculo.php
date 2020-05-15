<?php
	session_start();

    require_once("../Otros/gestionBD.php");
	require_once("./gestionarVehiculo.php");
	$conexion = crearConexionBD();

    if(isset($_SESSION["coche"])) {
        $vehiculo = $_SESSION["coche"];
    } else if(isset($_SESSION["moto"])) {
        $vehiculo = $_SESSION["moto"];
    } else {
        Header("Location: mis_vehiculos.php");
    }

	$errores = validarVehiculo($vehiculo);

    if (count($errores)>0) {
        // Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
			Header('Location: mis_vehiculos.php');
    } else {
        if(isset($_SESSION["coche"])) {
            Header('Location: accion_modificar_coche.php');
        } else {
            Header('Location: accion_modificar_moto.php');
        }
    }

    // Validación en servidor del formulario de editar vehiculo

    function validarVehiculo($vehiculo) {

        // Validación del color
		if(strlen($vehiculo["color"]) > 50) 
            $errores[] = "<p>El color debe de tener menos de 50 caracteres</p>";
        else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $vehiculo["color"])){
            $errores[] = "<p>El color solo puede contener caractéres</p>";
        }
		// Validación del kilometraje
		if(strlen($vehiculo["kilometraje"]) > 50) { 
			$errores[] = "<p>El kilometraje debe tener menos de 50 dígitos.</p>";
		} else if(!is_numeric($vehiculo["kilometraje"]) && $vehiculo["kilometraje"] != "") {
			$errores[] = "<p>El kilometraje debe estar formado por dígitos</p>";
        }
        
        // Nº Bastidor
        if($vehiculo["numBastidor"] != "" && strlen($vehiculo["numBastidor"])!=17 ) {
            $errores[] = "<p>El numero de bastidor debe de tener 17 dígitos</p>";
        } else if($vehiculo["numBastidor"] != "" && !preg_match("/^[A-Z\d]+$/", $vehiculo["numBastidor"])) {
            $errores[] = "<p>El numero de bastidor no tiene formato válido, solo letras mayúsculas y dígitos</p>";
        }
        return $errores;
    }

    cerrarConexionBD($conexion);
?>     
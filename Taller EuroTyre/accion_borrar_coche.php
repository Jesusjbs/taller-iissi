<?php	
	session_start();	
	
	if (isset($_SESSION["coche"])) {
		$coche = $_SESSION["coche"];
		unset($_SESSION["coche"]);
		
		require_once("gestionBD.php");
		require_once("gestionarVehiculo.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "QUITAR_COCHE"
		$excep = eliminarCoche($conexion, $coche["matricula"]);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: excepcion.php");
			// EN OTRO CASO, VOLVER A "MIS_VEHICULOS.PHP"
		} else Header("Location: mis_vehiculos.php");
		
	}
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: mis_vehiculos.php"); 
?>
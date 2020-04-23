<?php	
	session_start();	
	
	if (isset($_SESSION["moto"])) {
		$moto = $_SESSION["moto"];
		unset($_SESSION["moto"]);
		
		require_once("gestionBD.php");
		require_once("gestionarVehiculo.php");

		$conexion = crearConexionBD();
		$excep = eliminarMoto($conexion, $moto["matricula"]);
		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: excepcion.php");

		} else Header("Location: mis_vehiculos.php");
		
	}
	else 
		Header("Location: mis_vehiculos.php"); 
?>
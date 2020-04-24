<?php	
	session_start();	
	
	if (isset($_SESSION["moto"])) {
		$moto = $_SESSION["moto"];
		unset($_SESSION["moto"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarVehiculo.php");
		
		$conexion = crearConexionBD();

		$excep = editarMoto($conexion, $moto);
		
		cerrarConexionBD($conexion);
		

		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			header("Location: ../Otros/excepcion.php");

		}else Header("Location: mis_vehiculos.php");
		
	} 
	else 
		Header("Location: mis_vehiculos.php"); 
?>
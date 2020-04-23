<?php	
	session_start();	
	
	if (isset($_SESSION["coche"])) {
		$coche = $_SESSION["coche"];
		unset($_SESSION["coche"]);
		
		require_once("gestionBD.php");
		require_once("gestionarVehiculo.php");
		

		$conexion = crearConexionBD();

		$excep = eliminarCoche($conexion, $coche["matricula"]);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: excepcion.php");

		} else Header("Location: mis_vehiculos.php");
		
	}
	else
		Header("Location: mis_vehiculos.php"); 
?>
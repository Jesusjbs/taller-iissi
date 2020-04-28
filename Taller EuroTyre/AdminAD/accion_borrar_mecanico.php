<?php	
	session_start();	
	
	if (isset($_SESSION["mec"])) {
		$mec = $_SESSION["mec"];
		unset($_SESSION["mec"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarAdmin.php");
		

		$conexion = crearConexionBD();

		$excep = eliminarMecanico($conexion, $mec["dni"]);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: ../Otros/excepcion.php");

		} else Header("Location: mecanicos.php");
		
	}
	else
		Header("Location: mecanicos.php"); 
?>
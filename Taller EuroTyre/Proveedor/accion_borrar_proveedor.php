<?php	
	session_start();	
	
	if (isset($_SESSION["prov"])) {
		$prov = $_SESSION["prov"];
		unset($_SESSION["prov"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarProveedor.php");
		

		$conexion = crearConexionBD();

		$excep = eliminarProveedor($conexion, $prov["oid_p"]);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: ../Otros/excepcion.php");

		} else Header("Location: proveedores.php");
		
	}
	else
		Header("Location: proveedores.php"); 
?>
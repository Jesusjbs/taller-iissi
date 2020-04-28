<?php	
	session_start();	
	
	if (isset($_SESSION["prov"])) {
		$prov = $_SESSION["prov"];
		unset($_SESSION["prov"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarProveedor.php");
		

		$conexion = crearConexionBD();

		$excep = editarProveedor($conexion, $prov);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			header("Location: ../Otros/excepcion.php");

		}else Header("Location: proveedores.php");
		
	} 
	else
		Header("Location: proveedores.php"); 
?>
<?php	
	session_start();	
	
	if (isset($_SESSION["OID_LFC"])) {
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarFacturas.php");
		
        $lfc = $_SESSION["OID_LFC"];
        unset($_SESSION["OID_LFC"]);
        unset($_SESSION["factura"]);
		$conexion = crearConexionBD();

		$excep = eliminarLineaFactura($conexion, $lfc);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			Header("Location: ../Otros/excepcion.php");

		} else Header("Location: factura.php");
		
	}
	else
		Header("Location: factura.php"); 
?>
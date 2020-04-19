<?php	
	session_start();	
	
	if (isset($_SESSION["registro"])) {
		$registro = $_SESSION["registro"];
		unset($_SESSION["registro"]);
		
		require_once("gestionBD.php");
		require_once("gestionarVehiculo.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICAR_TITULO" EN GESTIONLIBROS
		$excep = editarCoche($conexion, $registro[7]);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		// (NÓTESE QUE HAY QUE ASIGNAR ADECUADAMENTE LAS VARIABLES DE SESIÓN PARA "EXCEPCION.PHP")
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			$_SESSION["destino"] = "mis_vehiculos.php";
			header("Location: excepcion.php");
			// EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
		}else Header("Location: mis_vehiculos.php");
		
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: mis_vehiculos.php"); 
?>

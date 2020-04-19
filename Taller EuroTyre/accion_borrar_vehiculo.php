<?php	
	session_start();	
	
	if (isset($_SESSION["registro"])) {
		$registro = $_SESSION["registro"];
		unset($_SESSION["registro"]);
		
		require_once("gestionBD.php");
		require_once("gestionarLibros.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "QUITAR_TITULO"
		$lib = $libro["OID_LIBRO"];
		$excep = quitar_libro($conexion, $lib);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			$_SESSION["destino"] = "consulta_libros.php";
			Header("Location: excepcion.php");
			// EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
		}else Header("Location: consulta_libros.php");
		
	}
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_libros.php"); 
?>
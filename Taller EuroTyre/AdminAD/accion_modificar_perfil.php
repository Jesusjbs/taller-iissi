<?php	
	session_start();	
	
	if (isset($_SESSION["administrador"])) {
		$administrador = $_SESSION["administrador"];
		$dni = $administrador["dni"];
		$nombre = $administrador["nombre"];
		$apellido = $administrador["apellido"];
		$especialidad = $administrador["especialidad"];
        $contraseña = $administrador["contraseña"];
		unset($_SESSION["administrador"]);

		require_once("../Otros/gestionBD.php");
		require_once("gestionarAdmin.php");
		
		$conexion = crearConexionBD();

		$excep = editarMecanico($conexion, $dni, $nombre, $apellido, $especialidad, $contraseña);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			header("Location: ../Otros/excepcion.php");

		} else Header("Location: perfil.php");
		
	}

	else
		Header("Location: ../Otros/login.php"); 
?>
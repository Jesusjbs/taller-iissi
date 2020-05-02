<?php	
	session_start();	
	
	if (isset($_SESSION["cliente"])) {
		$cliente = $_SESSION["cliente"];
		$dni = $cliente["dni"];
		$nombre = $cliente["nombre"];
		$apellido = $cliente["apellidos"];
		$telefono = $cliente["telefono"];
		$email = $cliente["email"];
		$direccion = $cliente["direccion"];
		$contraseña = $cliente["contraseña"];
		unset($_SESSION["cliente"]);

		require_once("../Otros/gestionBD.php");
		require_once("gestionarUsuarios.php");
		
		$conexion = crearConexionBD();

		$excep = editarCliente($conexion, $dni, $nombre, $apellido, $telefono, $email, $direccion, $contraseña);

		cerrarConexionBD($conexion);
		
		if($excep<>""){
			$_SESSION["excepcion"] = $excep;
			header("Location: ../Otros/excepcion.php");

		} else Header("Location: perfil.php");
		
	}

	else
		Header("Location: ../Otros/login.php"); 
?>
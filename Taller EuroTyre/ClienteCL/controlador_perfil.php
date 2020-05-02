<?php	
	session_start();
	
	if (isset($_REQUEST["dni"])) {
		$cliente["dni"] = $_REQUEST["dni"];
		$cliente["nombre"] = $_REQUEST["nombre"];
		$cliente["apellidos"] = $_REQUEST["apellidos"];
		$cliente["telefono"] = $_REQUEST["telefono"];
		$cliente["email"] = $_REQUEST["email"];
		$cliente["direccion"] = $_REQUEST["direccion"];
		$cliente["contraseña"] = $_REQUEST["contraseña"];
		$cliente["confirmar"] = $_REQUEST["confirmar"];
		$cliente["antigua"] = $_REQUEST["antigua"];
		
		$_SESSION["cliente"] = $cliente;
			
		if (isset($_REQUEST["editar"])) Header("Location: perfil.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: validacion_editar_perfil.php");
	}
	else 
		Header("Location: perfil.php");
	
?>
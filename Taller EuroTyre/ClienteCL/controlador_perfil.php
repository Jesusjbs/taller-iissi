<?php	
	session_start();
	
	if (isset($_REQUEST["dni"])) {
		$cliente["dni"] = $_REQUEST["dni"];
		$cliente["nombre"] = $_REQUEST["nombre"];
		$cliente["apellido"] = $_REQUEST["apellido"];
		$cliente["telefono"] = $_REQUEST["telefono"];
		$cliente["email"] = $_REQUEST["email"];
		$cliente["direccion"] = $_REQUEST["direccion"];
        $cliente["contraseña"] = $_REQUEST["contraseña"];
		
		$_SESSION["cliente"] = $cliente;
			
		if (isset($_REQUEST["editar"])) Header("Location: perfil.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_perfil.php");
	}
	else 
		Header("Location: perfil.php");
	
?>
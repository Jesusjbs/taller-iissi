<?php	
	session_start();
	
	if (isset($_REQUEST["dni"])) {
		$administrador["dni"] = $_REQUEST["dni"];
		$administrador["nombre"] = $_REQUEST["nombre"];
		$administrador["apellido"] = $_REQUEST["apellido"];
		$administrador["especialidad"] = $_REQUEST["especialidad"];
		$administrador["contraseña"] = $_REQUEST["contraseña"];
		$administrador["confirmar"] = $_REQUEST["confirmar"];
		$administrador["antigua"] = $_REQUEST["antigua"];
		
		$_SESSION["administrador"] = $administrador;
			
		if (isset($_REQUEST["editar"])) Header("Location: perfil.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: validar_modificar_perfil.php");
	}
	else 
		Header("Location: login.php");
	
?>
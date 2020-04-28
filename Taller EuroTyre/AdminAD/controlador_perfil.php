<?php	
	session_start();
	
	if (isset($_REQUEST["dni"])) {
		$administrador["dni"] = $_REQUEST["dni"];
		$administrador["nombre"] = $_REQUEST["nombre"];
		$administrador["apellido"] = $_REQUEST["apellido"];
		$administrador["especialidad"] = $_REQUEST["especialidad"];
        $administrador["contraseña"] = $_REQUEST["contraseña"];
		
		$_SESSION["administrador"] = $administrador;
			
		if (isset($_REQUEST["editar"])) Header("Location: perfil.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_perfil.php");
	}
	else 
		Header("Location: login.php");
	
?>
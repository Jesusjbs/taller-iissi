<?php	
	session_start();
	
	if (isset($_REQUEST["dni"])) {
		$mec["dni"] = $_REQUEST["dni"];
		$mec["nombre"] = $_REQUEST["nombre"];
        $mec["apellido"] = $_REQUEST["apellido"];
        $mec["jefe"] = $_REQUEST["jefe"];
		$mec["Especialidad"] = $_REQUEST["Especialidad"];
		$mec["contraseña"] = $_REQUEST["contraseña"];
		
		$_SESSION["mec"] = $mec;
			
		if (isset($_REQUEST["editar"])) Header("Location: mecanicos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: validar_modificar_mecanico.php");
		else if(isset($_REQUEST["borrar"]))Header("Location: accion_borrar_mecanico.php"); 
	}
	else 
		Header("Location: mis_vehiculos.php");
	
?>
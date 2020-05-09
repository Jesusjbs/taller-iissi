<?php	
	session_start();
	
	if (isset($_REQUEST["matricula"])) {
		$coche["matricula"] = $_REQUEST["matricula"];
		$coche["color"] = $_REQUEST["color"];
		$coche["kilometraje"] = $_REQUEST["kilometraje"];
		$coche["proxITV"] = $_REQUEST["proxITV"];
		$coche["numBastidor"] = $_REQUEST["numBastidor"];
		
		$_SESSION["coche"] = $coche;
			
		if (isset($_REQUEST["editar"])) Header("Location: mis_vehiculos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: validacion_modificar_vehiculo.php");
		else if(isset($_REQUEST["borrar"]))Header("Location: accion_borrar_coche.php"); 
	}
	else 
		Header("Location: mis_vehiculos.php");
	
?>
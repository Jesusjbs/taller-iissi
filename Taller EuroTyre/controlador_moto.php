<?php	
	session_start();
	
	if (isset($_REQUEST["matricula"])) {
		$moto["matricula"] = $_REQUEST["matricula"];
		$moto["color"] = $_REQUEST["color"];
		$moto["kilometraje"] = $_REQUEST["kilometraje"];
		$moto["proxITV"] = $_REQUEST["proxITV"];
		$moto["numBastidor"] = $_REQUEST["numBastidor"];
		
		$_SESSION["moto"] = $moto;
			
		if (isset($_REQUEST["editar"])) Header("Location: mis_vehiculos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_moto.php");
		else if(isset($_REQUEST["borrar"]))Header("Location: accion_borrar_moto.php"); 
	}
	else 
		Header("Location: mis_vehiculos.php");
	
?>
<?php	
	session_start();
	
	if (isset($_REQUEST[$registro[7]])) {
		/*$vehiculo["OID_LIBRO"] = $_REQUEST["OID_LIBRO"];
		$libro["OID_AUTOR"] = $_REQUEST["OID_AUTOR"];
		$libro["OID_AUTORIA"] = $_REQUEST["OID_AUTORIA"];
		$libro["NOMBRE"] = $_REQUEST["NOMBRE"];
		$libro["APELLIDOS"] = $_REQUEST["APELLIDOS"];
		$libro["TITULO"] = $_REQUEST["TITULO"];
		
		$_SESSION["libro"] = $libro;*/
			
		if (isset($_REQUEST["editar"])) Header("Location: mis_vehiculos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_vehiculo.php");
		else  /*if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_vehiculo.php"); 
	}
	else 
		Header("Location: mis_vehiculos.php");
	
?>
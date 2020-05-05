<?php	
	session_start();
	
	if (isset($_REQUEST["numFactura"])) {
		$factura["numFactura"] = $_REQUEST["numFactura"];
		$factura["descripcion"] = $_REQUEST["descripcion"];
		$factura["manoDeObra"] = $_REQUEST["manoDeObra"];
		$factura["IVA"] = $_REQUEST["IVA"];
		$factura["Pago"] = $_REQUEST["Pago"];
		
		$_SESSION["factura"] = $factura;
		
		if (isset($_REQUEST["editar"])) Header("Location: factura.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_factura.php");
		else if (isset($_REQUEST["OID_LFC"])) { $_SESSION["OID_LFC"] = $_REQUEST["OID_LFC"];  Header("Location: accion_borrar_linea.php");}

	}
	else 
		Header("Location: factura.php");
	
?>
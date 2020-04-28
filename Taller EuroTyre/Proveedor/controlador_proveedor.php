<?php	
	session_start();
	
	if (isset($_REQUEST["oid_p"])) {
        $prov["oid_p"] = $_REQUEST["oid_p"];
        $prov["tipoProveedor"] = $_REQUEST["tipoProveedor"];
		$prov["nombre"] = $_REQUEST["nombre"];
        $prov["email"] = $_REQUEST["email"];
        $prov["telefono"] = $_REQUEST["telefono"];
		
		$_SESSION["prov"] = $prov;
			
		if (isset($_REQUEST["editar"])) Header("Location: proveedores.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_proveedor.php");
		else if(isset($_REQUEST["borrar"]))Header("Location: accion_borrar_proveedor.php"); 
	}
	else 
		Header("Location: proveedores.php");
	
?>
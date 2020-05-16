<?php	
	session_start();
	
	if (isset($_REQUEST["oid_r"])) {
		$reparacion["oid_r"] = $_REQUEST["oid_r"];
		$reparacion["estado"] = $_REQUEST["estado"];
		$reparacion["fechaInicio"] = $_REQUEST["fechaInicio"];
		$reparacion["fechaFin"] = $_REQUEST["fechaFin"];
		$reparacion["matriculaC"] = $_REQUEST["matriculaC"];
		$reparacion["matriculaM"] = $_REQUEST["matriculaM"];
        $reparacion["fechaSolicitud"] = $_REQUEST["fechaSolicitud"];
        $reparacion["numCita"] = $_REQUEST["numCita"];
        $reparacion["tienePresupuesto"] = $_REQUEST["tienePresupuesto"];
        $reparacion["dni"] = $_REQUEST["dni"];
  
		
		$_SESSION["reparacion"] = $reparacion;
			
		if (isset($_REQUEST["editar"])) Header("Location: home.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: validar_editar_reparacion.php");
		else if(isset($_REQUEST["ver"])){ Header("Location: ../FacturaAD/factura.php");}
		else if(isset($_REQUEST["crear"])){ Header("Location: ../FacturaAD/formulario_factura.php");}
	}
	else 
		Header("Location: home.php");
	
?>
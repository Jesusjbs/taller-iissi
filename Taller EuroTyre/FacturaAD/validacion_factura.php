<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registroFactura"])) {
		
		// Recogemos los datos del formulario
        $nuevaFactura["oidr"] = $_REQUEST["oidr"];
        $nuevaFactura["dni"] = $_REQUEST["dni"];
		$nuevaFactura["descripcion"] = $_REQUEST["descripcion"];
        $nuevaFactura["IVA"] = $_REQUEST["iva"];
        $nuevaFactura["manoDeObra"] = $_REQUEST["manoDeObra"];
		$nuevaFactura["Pago"] = $_REQUEST["Pago"];    
		

	}
	else // En caso contrario, vamos al formulario
		Header("Location: formulario_factura.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['oidr'] = $nuevaFactura["oidr"];
	$_SESSION['dni'] = $nuevaFactura["dni"];
	$_SESSION["registroFactura"] = $nuevasFactura;

	// Validamos el formulario en servidor 
    $errores = validarDatosFactura($nuevaFactura);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_factura.php');
	} else
        Header('Location: accion_factura.php');
        
	// Validación en servidor del formulario de factura
    
	function validarDatosFactura($nuevaFactura){
		// Validación de la mano de obra		
		if($nuevaFactura["manoDeObra"]==""){ 
			$errores[] = "<p>La mano de Obra no puede estar vacía</p>";
        }else if($nuevaFactura["manoDeObra"]<0){
            $errores[] = "<p>La mano de Obra debe ser mayor que cero</p>";
        }else if(!filter_var($nuevaFactura["manoDeObra"],FILTER_VAR_INT) && 
                !filter_var($nuevaFactura["manoDeObra"],FILTER_VAR_FLOAT)) {
            $errores[] = "<p>La mano de Obra debe ser un número</p>";
        }
        
        // Validación del iva
		if($nuevaFactura["IVA"]=="") {
			$errores[] = "<p>El IVA no puede estar vacío</p>";
        }else if($nuevaFactura["IVA"] < 0 || $nuevaFactura["IVA"] > 1){
            $errores[] = "<p>El IVA debe  de estar entre cero y uno</p>";
        }else if(!filter_var($nuevaFactura["IVA"],FILTER_VAR_FLOAT)) {
            $errores[] = "<p>El IVA debe ser un valor decimal</p>";
        }
        
        return $errores;
        }
	
?>
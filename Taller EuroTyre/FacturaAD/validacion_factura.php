<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registroFactura"])) {
		
		// Recogemos los datos del formulario
        $nuevaFactura["oidr"] = $_REQUEST["oidr"];
        $nuevaFactura["dni"] = $_REQUEST["dni"];
		$nuevaFactura["descripcion"] = $_REQUEST["descripcion"];
        $nuevaFactura["manoDeObra"] = $_REQUEST["manoDeObra"];
		$nuevaFactura["Pago"] = $_REQUEST["Pago"];

	}

	else // En caso contrario, vamos al formulario
		Header("Location: formulario_factura.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["registroFactura"] = $nuevaFactura;

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
		}else if(!is_numeric($nuevaFactura["manoDeObra"])) {
            $errores[] = "<p>La mano de Obra debe ser un número</p>";
        }else if($nuevaFactura["manoDeObra"]<0){
            $errores[] = "<p>La mano de Obra debe ser mayor que cero</p>";
        }
		//Validad descripcion
		if(strlen($nuevaFactura["descripcion"])>100){
			$errores[]="<p>La descripción debe de tener menos de 100 caracteres.</p>";
		}
        
        return $errores;
        }
	
?>
<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registroLinea"])) {
		
		// Recogemos los datos del formulario
        $nuevaLinea["numFactura"] = $_REQUEST["numFactura"];
        $nuevaLinea["pieza"] = $_REQUEST["pieza"];
		$nuevaLinea["cantidad"] = $_REQUEST["cantidad"];
	}

	else // En caso contrario, vamos al formulario
		Header("Location: formulario_linea_factura.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["registroLinea"] = $nuevaLinea;

	// Validamos el formulario en servidor 
    $errores = validarDatosLinea($nuevaLinea);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_linea_factura.php');
	} else
        Header('Location: accion_linea_factura.php');
        
	// Validación en servidor del formulario de línea de factura
    
	function validarDatosLinea($nuevaLinea){

		// Validación de la mano de obra		
		if($nuevaLinea["cantidad"]==""){ 
			$errores[] = "<p>Las unidades no pueden estar vacía</p>";
		}else if(!preg_match("/^[0-9]+$/", $nuevaLinea["cantidad"])) {
            $errores[] = "<p>Las unidades deben ser un número entero</p>";
        }
        if($nuevaLinea["cantidad"] <= 0){
            $errores[] = "<p>Las unidades deben ser mayor que cero</p>";
		}

        return $errores;
        }
	
?>
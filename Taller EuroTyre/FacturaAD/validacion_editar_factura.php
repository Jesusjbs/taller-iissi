<?php
    session_start();

    if(isset($_SESSION["factura"])) {
        $factura = $_SESSION["factura"];
    } else {
        Header("Location: factura.php");
    }

    $errores = validarDatosFactura($factura);

    if (count($errores)>0) {
        // Guardo en la sesión los mensajes de error y volvemos al formulario
        $_SESSION["errores"] = $errores;
            Header('Location: factura.php');
    } else {
        Header('Location: accion_modificar_factura.php');
    }

// Validación en servidor del formulario de factura
    
	function validarDatosFactura($nuevaFactura){

		// Validación de la mano de obra		
		if($nuevaFactura["manoDeObra"]==""){ 
			$errores[] = "<p>La mano de Obra no puede estar vacía</p>";
		}else if(!is_numeric($nuevaFactura["manoDeObra"])) {
            $errores[] = "<p>La mano de Obra debe ser un número</p>";
        }else if($nuevaFactura["manoDeObra"]<0){
            $errores[] = "<p>La mano de obra debe ser mayor que cero</p>";
		}else if(strlen($nuevaFactura["manoDeObra"])>10){
            $errores[] = "<p>La mano de obra debe contener menos de 10 dígitos</p>";
        } 
        //Validar tipo de pago
		if($nuevaFactura["Pago"]=="") 
            $errores[] = "<p>El tipo de pago no puede estar vacío, debe ser 'Efectivo' o 'Tarjeta'.</p>";
        else if((strcmp($nuevaFactura["Pago"], "Efectivo") != 0) && (strcmp($nuevaFactura["Pago"],  "Tarjeta") != 0)) {
        $errores[] = "<p>El tipo de pago no sigue el formato correcto, debe ser 'Efectivo' o 'Tarjeta'.</p>";
    }
		//Validar IVA
		if($nuevaFactura["IVA"]==""){
			$errores[] = "<p>El IVA  no puede estar vacío.</p>";
		}else if($nuevaFactura["IVA"]>1 || $nuevaFactura["IVA"]<0){
			$errores[] = "<p>El IVA debe de ser un valor comprendido entre 1 y 0.</p>";
		}else if(!is_numeric($nuevaFactura["IVA"])){
			$errores[] = "<p>El IVA debe de ser un número.</p>";
		}
		//Validar descripcion
		if(strlen($nuevaFactura["descripcion"])>100){
			$errores[]="<p>La descripción debe de tener menos de 100 caracteres.</p>";
		}
        
        return $errores;
        }
?>
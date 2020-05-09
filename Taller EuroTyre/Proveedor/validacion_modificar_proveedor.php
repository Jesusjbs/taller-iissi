<?php

session_start();

if(isset($_SESSION["prov"])) {
	$Proveedor = $_SESSION["prov"];
} else {
	Header("Location: proveedores.php");
}

$errores = validarDatosProveedor($Proveedor);

if (count($errores)>0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
		Header('Location: proveedores.php');
} else {
	Header('Location: accion_modificar_proveedor.php');
}
	// Validación en servidor de proveedor
    
	function validarDatosProveedor($Proveedor){
		// Validación del Nombre		
		if($Proveedor["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $Proveedor["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }else if(strlen($Proveedor["nombre"])>50){
			$errores[] = "<p>El nombre debe de tener menos de 50 caracteres.</p>";
		}
        
        // Validación del teléfono
		if($Proveedor["telefono"]=="") 
        $errores[] = "<p>El telefono no puede estar vacío</p>";
        else if(!preg_match("/^[0-9]{9}+$/", $Proveedor["telefono"])){
        $errores[] = "<p>El telefono debe contener 9 números: " . $Proveedor["telefono"]. "</p>";
       }

        // Validación de tipo Proveedor
		if($Proveedor["tipoProveedor"]=="") 
            $errores[] = "<p>El tipo de proveedor no puede estar vacío</p>";
        else if((strcmp($Proveedor["tipoProveedor"], "Residuos") != 0) && (strcmp($Proveedor["tipoProveedor"], "Piezas") != 0)) {
            $errores[] = "<p>El tipo de proveedor no sigue el formato correcto, debe ser 'Residuos' o 'Piezas'</p>";
        }

        // Validación del email
        if(!filter_var($Proveedor["email"], FILTER_VALIDATE_EMAIL) && $Proveedor["email"] != ""){
            $errores[] = $error . "<p>El email es incorrecto: " . $Proveedor["email"]. "</p>";
		}
		if(strlen($Proveedor["email"]) > 50){
			$errores[] = "<p>El email debe de tener menos de 50 caracteres.</p>";
		}
        
            return $errores;
        }
	
?>
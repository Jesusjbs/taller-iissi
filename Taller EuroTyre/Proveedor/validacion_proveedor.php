<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registroProveedor"])) {
		
		// Recogemos los datos del formulario
        $nuevoProveedor["nombre"] = $_REQUEST["nombre"];
        $nuevoProveedor["tipoProveedor"] = $_REQUEST["tipoProveedor"];
		$nuevoProveedor["email"] = $_REQUEST["email"];
		$nuevoProveedor["telefono"] = $_REQUEST["telefono"]; 
    }
    
	else // En caso contrario, vamos al formulario
		Header("Location: formulario_proveedor.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["registroProveedor"] = $nuevoProveedor;

	// Validamos el formulario en servidor 
    $errores = validarDatosProveedor($nuevoProveedor);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_proveedor.php');
	} else
        Header('Location: accion_proveedor.php');
        
	// Validación en servidor del formulario de proveedor
    
	function validarDatosProveedor($nuevoProveedor){
		// Validación del Nombre		
		if($nuevoProveedor["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $nuevoProveedor["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }
        
        // Validación del teléfono
		if($nuevoProveedor["telefono"]=="") 
        $errores[] = "<p>El telefono no puede estar vacío</p>";
        else if(!preg_match("/^[0-9]{9}+$/", $nuevoProveedor["telefono"])){
        $errores[] = "<p>El telefono debe contener 9 números: " . $nuevoProveedor["telefono"]. "</p>";
       }

        // Validación del email
        if(!filter_var($nuevoProveedor["email"], FILTER_VALIDATE_EMAIL) && $nuevoProveedor["email"] != ""){
            $errores[] = $error . "<p>El email es incorrecto: " . $nuevoProveedor["email"]. "</p>";
        }
        
            return $errores;
        }
	
?>
<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["dni"] = $_REQUEST["dni"];
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["telefono"] = $_REQUEST["telefono"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
		$nuevoUsuario["contraseña"] = $_REQUEST["contraseña"];
		$nuevoUsuario["confirmar"] = $_REQUEST["confirmar"];
    }
    
	else // En caso contrario, vamos al formulario
		Header("Location: formulario_usuario.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;

	// Validamos el formulario en servidor 
    $errores = validarDatosUsuario($nuevoUsuario);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_usuario.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
        Header('Location: accion_usuario.php');
        
	// Validación en servidor del formulario de alta de usuario
    
	function validarDatosUsuario($nuevoUsuario){
		// Validación del DNI
		if($nuevoUsuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}+$/", $nuevoUsuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números: " . $nuevoUsuario["dni"]. "</p>";
		}

		// Validación del Nombre		
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $nuevoUsuario["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }

        // Validación del apellidos
        if($nuevoUsuario["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $nuevoUsuario["apellidos"])) {
            $errores[] = "<p>Los apellidos solo pueden contener letras</p>";
        }

        // Validación del teléfono
		if($nuevoUsuario["telefono"]=="") 
            $errores[] = "<p>El telefono no puede estar vacío</p>";
        else if(!preg_match("/^[0-9]{9}+$/", $nuevoUsuario["telefono"])){
            $errores[] = "<p>El telefono debe contener 9 números: " . $nuevoUsuario["telefono"]. "</p>";
        }

		// Validación del email
		if($nuevoUsuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
        }
        
        // Validación de la dirección
		if($nuevoUsuario["direccion"]=="") 
            $errores[] = "<p>La dirección no puede estar vacía</p>";
		
		// Validación de la contraseña
		if(!isset($nuevoUsuario["contraseña"]) || strlen($nuevoUsuario["contraseña"])<6) {
			$errores [] = "<p>Contraseña no válida: debe tener al menos 6 caracteres</p>";
		} else if(!preg_match("/[a-z]+/", $nuevoUsuario["contraseña"]) || 
            !preg_match("/[A-Z]+/", $nuevoUsuario["contraseña"]) || !preg_match("/[0-9]+/", 
            $nuevoUsuario["contraseña"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y números</p>";
		} else if($nuevoUsuario["contraseña"] != $nuevoUsuario["confirmar"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
	
		return $errores;
	}

?>
<?php
	session_start();
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["registroMecanico"])) {
		
		// Recogemos los datos del formulario
        $nuevoMecanico["dni"] = $_REQUEST["dni"];
        $nuevoMecanico["nombre"] = $_REQUEST["nombre"];
		$nuevoMecanico["apellido"] = $_REQUEST["apellido"];
		$nuevoMecanico["Especialidad"] = $_REQUEST["Especialidad"];
		if(!isset($_REQUEST["jefe"])) 	$nuevoMecanico["jefe"] = 0;
		else $nuevoMecanico["jefe"] = 1;
		$nuevoMecanico["contraseña"] = $_REQUEST["contraseña"]; 
		$nuevoMecanico["confirmar"] = $_REQUEST["confirmar"]; 
    }
    
	else // En caso contrario, vamos al formulario
		Header("Location: formulario_mecanico.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["registroMecanico"] = $nuevoMecanico;

	// Validamos el formulario en servidor 
    $errores = validarDatosMecanico($nuevoMecanico);
    
    // Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formulario_mecanico.php');
	} else
        Header('Location: accion_mecanico.php');
        
	// Validación en servidor del formulario de alta de mecanico
    
	function validarDatosMecanico($nuevoMecanico){
		// Validación del DNI
		if($nuevoMecanico["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}+$/", $nuevoMecanico["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números: " . $nuevoMecanico["dni"]. "</p>";
		}

		// Validación del Nombre		
		if($nuevoMecanico["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $nuevoMecanico["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }else if(strlen($nuevoMecanico["nombre"])>50){
			$errores[] = "<p>El nombre debe de tener menos de 50 caracteres.</p>";
		}

        // Validación del apellidos
        if($nuevoMecanico["apellido"]=="") 
			$errores[] = "<p>El apellido no pueden estar vacíos</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $nuevoMecanico["apellido"])) {
            $errores[] = "<p>Los apellidos solo pueden contener letras</p>";
        }else if(strlen($nuevoMecanico["apellidos"])>50){
			$errores[] = "<p>Los apellidos deben de tener menos de 50 caracteres.</p>";
		}
        
		// Validación de la contraseña
		if(!isset($nuevoMecanico["contraseña"]) || strlen($nuevoMecanico["contraseña"])<6) {
			$errores [] = "<p>Contraseña no válida: debe tener al menos 6 caracteres</p>";
		} else if(!preg_match("/[a-z]+/", $nuevoMecanico["contraseña"]) || 
            !preg_match("/[A-Z]+/", $nuevoMecanico["contraseña"]) || !preg_match("/[0-9]+/", 
            $nuevoMecanico["contraseña"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y números</p>";
		} else if($nuevoMecanico["contraseña"] != $nuevoMecanico["confirmar"]){
			$errores[] = "<p>Las contraseñas introducidas no coinciden</p>";
		} else if(strlen($nuevoMecanico["contraseña"])>50){
			$errores[] = "<p>La contraseña debe de tener menos de 50 caracteres.</p>";
		}
	
		return $errores;
	}
	
?>
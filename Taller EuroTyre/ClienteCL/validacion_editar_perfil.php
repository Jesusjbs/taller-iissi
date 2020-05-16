<?php
	session_start();

    require_once("../Otros/gestionBD.php");
	require_once("./gestionarUsuarios.php");
	$conexion = crearConexionBD();

    if(isset($_SESSION["cliente"])) {
        $cliente = $_SESSION["cliente"];
		$Usuario["dni"] = $cliente["dni"];
		$Usuario["nombre"] = $cliente["nombre"];
		$Usuario["apellidos"] = $cliente["apellidos"];
		$Usuario["telefono"] = $cliente["telefono"];
		$Usuario["email"] = $cliente["email"];
		$Usuario["direccion"] = $cliente["direccion"];
		$Usuario["antigua"] = $cliente["antigua"];
		$Usuario["contraseña"] = $cliente["contraseña"];
		$Usuario["confirmar"] = $cliente["confirmar"];
    } else {
        Header("Location: perfil.php");
    }

	$errores = validarUsuario($Usuario);
	if($Usuario["antigua"] != "" && validaContraseña($conexion, $Usuario["dni"], $Usuario["antigua"]) == 0) {
		$errores[] = "<p>La contraseña antigua introducida no es correcta.</p>";
	}

    if (count($errores)>0) {
        // Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
			Header('Location: perfil.php');
    } else {
        // Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
        Header('Location: accion_modificar_perfil.php');
    }

    // Validación en servidor del formulario de alta de usuario
    

    function validarUsuario($Usuario) {
		// Validación del DNI
		if($Usuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}+$/", $Usuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números: " . $Usuario["dni"]. "</p>";
		}

		// Validación del Nombre		
		if($Usuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $Usuario["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }else if(strlen($Usuario["nombre"])>50){
			$errores[] = "<p>El nombre debe de tener menos de 50 caracteres.</p>";
		}

        // Validación del apellidos
        if($Usuario["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $Usuario["apellidos"])) {
            $errores[] = "<p>Los apellidos solo pueden contener letras</p>";
        }else if(strlen($Usuario["apellidos"])>50){
			$errores[] = "<p>Los apellidos deben de tener menos de 50 caracteres.</p>";
		}

        // Validación del teléfono
		if($Usuario["telefono"]=="") 
            $errores[] = "<p>El telefono no puede estar vacío</p>";
        else if(!preg_match("/^[0-9]{9}+$/", $Usuario["telefono"])){
            $errores[] = "<p>El telefono debe contener 9 números: " . $Usuario["telefono"]. "</p>";
        }

		// Validación del email
		if($Usuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($Usuario["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $Usuario["email"]. "</p>";
        }else if(strlen($Usuario["email"])>50){
			$errores[] = "<p>El email debe de tener menos de 50 caracteres.</p>";
		}

		//Validar dirección
		if(strlen($Usuario["direccion"])>50){
			$errores[] = "<p>La dirección no puede contener más de 50 caracteres.</p>";
		}

        // Validación de la contraseña

		if($Usuario["antigua"] != "" && $Usuario["contraseña"] != "" && strlen($Usuario["contraseña"])<6) {
			$errores [] = "<p>La nueva contraseña debe tener más de 6 caracteres</p>";
		}
		else if($Usuario["antigua"] == "" && $Usuario["contraseña"] != ""){
			$errores [] = "<p>Introduce la contraseña antigua para cambiarla.</p>";
		}
		 else if($Usuario["contraseña"] != "" && (!preg_match("/[a-z]+/", $Usuario["contraseña"]) || 
		 !preg_match("/[A-Z]+/", $Usuario["contraseña"]) || !preg_match("/[0-9]+/", $Usuario["contraseña"]))){
            $errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y números</p>";
        } else if($Usuario["contraseña"] != $Usuario["confirmar"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}else if(strlen($Usuario["contraseña"])>50){
			$errores[] = "<p>La contraseña debe de tener menos de 50 caracteres.</p>";
		}

        return $errores;
    }

    cerrarConexionBD($conexion);
?>     
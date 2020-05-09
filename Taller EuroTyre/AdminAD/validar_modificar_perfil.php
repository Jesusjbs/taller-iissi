<?php
	session_start();

    require_once("../Otros/gestionBD.php");
	require_once("./gestionarAdmin.php");
	$conexion = crearConexionBD();

    if(isset($_SESSION["administrador"])) {
        $administrador = $_SESSION["administrador"];
		$Usuario["dni"] = $administrador["dni"];
		$Usuario["nombre"] = $administrador["nombre"];
		$Usuario["apellido"] = $administrador["apellido"];
		$Usuario["especialidad"] = $administrador["especialidad"];
		$Usuario["antigua"] = $administrador["antigua"];
		$Usuario["contraseña"] = $administrador["contraseña"];
		$Usuario["confirmar"] = $administrador["confirmar"];
    } else {
        Header("Location: perfil.php");
    }

	$errores = validarUsuario($Usuario);
	if($Usuario["antigua"] != "" && compruebaContraseña($conexion, $Usuario["dni"], $Usuario["antigua"]) == 0) {
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
		else if(!preg_match("/^[0-9]{8}+$/"
		, $Usuario["dni"])){
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
        if($Usuario["apellido"]=="") 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $Usuario["apellido"])) {
            $errores[] = "<p>Los apellidos solo pueden contener letras</p>";
        }else if(strlen($Usuario["apellido"]) > 50){
			$errores[] = "<p>Los apellidos deben de tener menos de 50 caracteres.</p>";
		}
		
        // Validación de la Especialidad
		if($Usuario["especialidad"]=="") 
            $errores[] = "<p>La especialidad no puede estar vacía</p>";
        else if((strcmp($Usuario["especialidad"], "Mecánica") != 0) && (strcmp($Usuario["especialidad"], "Neumática") != 0)) {
            $errores[] = "<p>La especialidad no sigue el formato correcto, debe ser 'Mecánica' o 'Neumática'</p>";
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
		}else if(strlen($Usuario["contraseña"]) > 50){
			$errores[] = "<p>La contraseña debe de tener menos de 50 caracteres.</p>";
		}

        return $errores;
    }

    cerrarConexionBD($conexion);
?>     
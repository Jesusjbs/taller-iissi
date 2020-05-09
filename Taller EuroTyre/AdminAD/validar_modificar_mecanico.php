<?php
	session_start();

    require_once("../Otros/gestionBD.php");
	require_once("./gestionarAdmin.php");
	$conexion = crearConexionBD();

    if(isset($_SESSION["mec"])) {
        $mecanico = $_SESSION["mec"];

    } else {
        Header("Location: mecanicos.php");
    }

	$errores = validarMecanico($mecanico);

    if (count($errores)>0) {
        // Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
			Header('Location: mecanicos.php');
    } else {
        // Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
        Header('Location: accion_modificar_mecanico.php');
    }

    // Validación en servidor del formulario de alta de usuario
    

    function validarMecanico($mecanico) {
		// Validación del Nombre		
		if($mecanico["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $mecanico["nombre"])) {
            $errores[] = "<p>El nombre solo puede contener letras</p>";
        }else if(strlen($mecanico["nombre"])>50){
			$errores[] = "<p>El nombre debe tener menos de 50 caracteres.</p>";
		}

        // Validación del apellidos
        if($mecanico["apellido"]=="") 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
        else if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/", $mecanico["apellido"])) {
            $errores[] = "<p>Los apellidos solo pueden contener letras</p>";
        }else if(strlen($mecanico["apellido"]) > 50){
			$errores[] = "<p>Los apellidos deben tener menos de 50 caracteres.</p>";
        }
        
        // Validación de la Especialidad
		if($mecanico["Especialidad"]=="") 
            $errores[] = "<p>La especialidad no puede estar vacía</p>";
        else if((strcmp($mecanico["Especialidad"], "Mecánica") != 0) && (strcmp($mecanico["Especialidad"], "Neumática") != 0)) {
            $errores[] = "<p>La especialidad no sigue el formato correcto, debe ser 'Mecánica' o 'Neumática'</p>";
        }
        
        // Validación de jefe
		if($mecanico["jefe"]=="") 
            $errores[] = "<p>El campo jefe no puede estar vacío</p>";
        else if((strcmp($mecanico["jefe"], "SI") != 0) && (strcmp($mecanico["jefe"], "NO") != 0)) {
        $errores[] = "<p>El campo jefe solo puede tomar los valores 'SI' y 'NO' (Mayúscula)</p>";
        } else {
            if($mecanico["jefe"] == "NO") {
                $_SESSION["mec"]["jefe"] = 0;
            } else {
                $_SESSION["mec"]["jefe"] = 1;
            }
        }

        // Validación de la contraseña
		if(strlen($mecanico["contraseña"]) < 6) {
			$errores [] = "<p>La contraseña debe tener más de 6 caracteres</p>";
		}
        else if(!preg_match("/[a-z]+/", $mecanico["contraseña"]) || !preg_match("/[A-Z]+/", $mecanico["contraseña"]) || !preg_match("/[0-9]+/", $mecanico["contraseña"])){
            $errores[] = "<p>Contraseña no válida, debe contener letras mayúsculas y minúsculas y números</p>";
        } else if(strlen($mecanico["contraseña"]) > 50){
			$errores[] = "<p>La contraseña debe tener menos de 50 caracteres.</p>";
		}

        return $errores;
    }

    cerrarConexionBD($conexion);
?> 
<?php
	session_start();

    require_once("../Otros/gestionBD.php");
    include_once("gestionarAdmin.php");

    if(!isset($_SESSION["admin"])) {
        Header("Location: ../Otros/login.php");
    }
    $conexion = crearConexionBD();
    $esJefe = esJefe($conexion, $_SESSION["admin"]);

    if($esJefe == 0) {
        Header("Location: mecanicos.php");
    }
    cerrarConexionBD($conexion);
    
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['registroMecanico'])) {
		$registroMecanico['dni'] = "";
		$registroMecanico['nombre'] = "";
        $registroMecanico['apellido'] = "";
        $registroMecanico['Especialidad'] = "Mecánica";
        $registroMecanico['jefe'] = 0;
        $registroMecanico['contraseña'] = "";
        $registroMecanico['confirmar'] = "";
	
		$_SESSION['registroMecanico'] = $registroMecanico;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$registroMecanico = $_SESSION['registroMecanico'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Registro Mecánico</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_nosotros.css" />

    <link rel="shortcut icon" href="../img/logo.png"/>
    <link rel="apple-touch-icon" href="../img/logo.png"/>
</head>

<body>
    <?php  include_once("../Otros/cabeceraAdmin.php");
        if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
    ?>

    <h1>Registro de mecánico </h1>
    <p>Todos los campos son obligatorios</p>

    <form id="id_regMecanico" method="post" action="validacion_mecanico.php" novalidate>
        <fieldset>
            <div>
                <input id="id_jefe" type="checkbox" name="jefe" />
                <label for="id_jefe">Jefe</label>
            </div>
            <div>
                <label for="id_dni">DNI:</label>
                <input id="id_dni" type="text" name="dni" value="<?php echo $registroMecanico["dni"]; ?>" required />
            </div>
            <div>
                <label for="id_nombre">Nombre:</label>
                <input id="id_nombre" name="nombre" type="text" value="<?php echo $registroMecanico['nombre'];?>" required />
            </div>
            <div>
                <label for="id_apellido">Apellido:</label>
                <input id="id_apellido" name="apellido" type="text" value="<?php echo $registroMecanico['apellido'];?>" required />
            </div>

            <div>
                <label for="id_contraseña">Contraseña:</label>
                <input id="id_contraseña" name="contraseña" type="password" />
            </div>
            <div>
                <label for="id_confirmar">Confirmar contraseña:</label>
                <input id="id_confirmar" name="confirmar" type="password" />
            </div>

            <div>
                <label for="id_especialidad">Especialidad:</label>
                <input id="id_especialidad" type="radio" name="Especialidad" value="Mecánica" <?php if($registroMecanico["Especialidad"]=="Mecánica") echo ' checked ' ; ?>/>
                <label for = "id_especialidad">Mecánica</label>
            
                <input id="id_especialidad1" type="radio" name="Especialidad" value="Neumática" <?php if($registroMecanico["Especialidad"]=="Neumática") echo ' checked '; ?>/>
                <label for = "id_especialidad1">Neumática</label>
            </div>
            
            <button id="id_enviar" type="submit">Registrar</button>

        </fieldset>
    </form>

    <body>

</html>
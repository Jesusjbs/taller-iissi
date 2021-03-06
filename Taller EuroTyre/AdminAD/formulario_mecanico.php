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

    <title>Registro Trabajador</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_form_mecanico.css" />
    <script src="../ValidacionesJS/valida_mecanicos.js"></script>

    <link rel="shortcut icon" href="../img/logo.png"/>
    <link rel="apple-touch-icon" href="../img/logo.png"/>
</head>

<body>
    <?php  include_once("../Otros/cabecera.php");
        if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
    ?>
    <div id="id_divMecanico"> 
    <form id="id_regMecanico" method="post" action="validacion_mecanico.php" onsubmit="return validaForm()">
        <fieldset id="id_campo">
            <h1>Registro de trabajador </h1>
            <p id="id_obligatorio">Todos los campos son obligatorios</p>
            <div class="div">
                <input id="id_jefe" type="checkbox" name="jefe" /> 
                <label for="id_jefe">Jefe</label>
            </div>
            <br />
            <div class="div">
                <label for="id_dni">DNI:</label>
                <div class="campo">
                    <input id="id_dni" title="Debe contener 8 dígitos (sin letra)" type="text" name="dni" 
                        value="<?php echo $registroMecanico["dni"]; ?>" pattern="^[0-9]{8}" required />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_nombre">Nombre:</label>
                <div class="campo">
                    <input id="id_nombre" title="Solo debe contener letras y tener una longitud máxima de 50" name="nombre" type="text" 
                        value="<?php echo $registroMecanico['nombre'];?>" pattern="[a-zA-ZÑñ áéíóú]{1,50}" required />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_apellido">Apellido:</label>
                <div class="campo">
                    <input id="id_apellido" title="Solo debe contener letras y tener una longitud máxima de 50" name="apellido" type="text" 
                        value="<?php echo $registroMecanico['apellido'];?>" pattern="[a-zA-ZÑñáéíóú]{1,50}" required />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_contraseña">Contraseña:</label>
                <div class="campo">
                    <input id="id_contraseña" title="Mínimo 6 caracteres (Letra mayúscula, letra minúscula y número) y máximo 50" 
                        name="contraseña" type="password" 
                    pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,50}" required />
                </div> 
            </div>
            <br /> 
            <div class="div">
                <label for="id_confirmar">Confirmar contraseña:</label>
                <div class="campo">
                    <input id="id_confirmar" title="Mínimo 6 caracteres (Letra mayúscula, letra minúscula y número) y máximo 50" 
                    name="confirmar" type="password" required oninput="this.setCustomValidity('')"  />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_especialidad">Especialidad:</label>
                <div class="campo">
                    <input id="id_especialidad" type="radio" name="Especialidad" 
                        value="Mecánica" <?php if($registroMecanico["Especialidad"]=="Mecánica") echo ' checked ' ; ?>/>
                    <label for = "id_especialidad">Mecánica</label>
                
                    <input id="id_especialidad1" type="radio" name="Especialidad" 
                        value="Neumática" <?php if($registroMecanico["Especialidad"]=="Neumática") echo ' checked '; ?>/>
                    <label for = "id_especialidad1">Neumática</label>
                </div>
            </div>
            
            <button id="id_enviar" type="submit">Registrar</button>

        </fieldset>
    </form>
    </div>
    </body>

</html>
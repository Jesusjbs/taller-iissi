<?php
	session_start();

    require_once("../Otros/gestionBD.php");
    require_once("../AdminAD/gestionarAdmin.php");
    require_once("gestionarProveedor.php");

    if(!isset($_SESSION["admin"])) {
        Header("Location: ../Otros/login.php");
    }

    $conexion = crearConexionBD();
    $esJefe = esJefe($conexion, $_SESSION["admin"]);

    if($esJefe == 0) {
        Header("Location: proveedores.php");
    }
    cerrarConexionBD($conexion);
    
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['registroProveedor'])) {
		$registroProveedor['nombre'] = "";
        $registroProveedor['tipoProveedor'] = "Piezas";
        $registroProveedor['email'] = "";
        $registroProveedor['telefono'] = "";
	
		$_SESSION['registroProveedor'] = $registroProveedor;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$registroProveedor = $_SESSION['registroProveedor'];
			
	if (isset($_SESSION["errores"]))
        $errores = $_SESSION["errores"];
        unset($_SESSION["errores"]);        
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">

    <title>Registro Proveedor</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_form_proveedor.css" />

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

    <div id="id_divProveedor">
    <form id="id_regProveedor" method="post" action="validacion_proveedor.php">
        <fieldset id="id_campo">
            <h1>Registro de proveedor</h1>
            <p id="id_obligatorio">*Obligatorio</p>
            <br />
            <div class="div">
                <label for="id_nombre">Nombre*:</label>
                <div class="campo"> 
                    <input id="id_nombre" title="Sólo letras mayúsculas o minúsculas" type="text" name="nombre" 
                        value="<?php echo $registroProveedor["nombre"]; ?>" pattern="[a-zA-ZÑñ áéíóú]+" maxlength="50" required />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_tipoProveedor">Tipo de Proveedor:</label>
                <div class="campo">
                    <input id="id_tipoProveedor" type="radio" name="tipoProveedor" 
                        value="Piezas" <?php if($registroProveedor["tipoProveedor"]=="Piezas") echo ' checked ' ; ?>/>
                    <label for = "id_tipoProveedor">Piezas</label>
                
                    <input id="id_tipoProveedor1" type="radio" name="tipoProveedor" 
                        value="Residuos" <?php if($registroProveedor["tipoProveedor"]=="Residuos") echo ' checked '; ?>/>
                    <label for = "id_tipoProveedor1">Residuos</label>
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_email">Email:</label>
                <div class="campo"> 
                    <input id="id_email" name="email" type="email" value="<?php echo $registroProveedor['email'];?>" maxlength="50" />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_telefono">Teléfono*:</label>
                <div class="campo"> 
                    <input id="id_telefono" title="Debe contener 9 dígitos" name="telefono" type="text" 
                        value="<?php echo $registroProveedor['telefono'];?>" pattern="^[0-9]{9}" required/>
                </div>
            </div>
            <button id="id_enviar" type="submit">Registrar</button>
        </fieldset>
    </form>
    </div>
    </body>

</html>
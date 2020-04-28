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
        $registroProveedor['tipoProveedor'] = "DePiezas";
        $registroProveedor['email'] = "";
        $registroProveedor['telefono'] = "";
	
		$_SESSION['registroProveedor'] = $registroProveedor;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$registroProveedor = $_SESSION['registroProveedor'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Registro Proveedor</title>
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

    <h1>Registro de proveedor</h1>
    <p>*Obligatorio</p>

    <form id="id_regProveedor" method="post" action="validacion_proveedor.php" novalidate>
        <fieldset>
            <div>
                <label for="id_nombre">Nombre*:</label>
                <input id="id_nombre" type="text" name="nombre" value="<?php echo $registroProveedor["nombre"]; ?>" required />
            </div>
            <div>
                <label for="id_tipoProveedor">Tipo de Proveedor*:</label>
                <input id="id_tipoProveedor" type="radio" name="tipoProveedor" value="DePiezas" <?php if($registroProveedor["tipoProveedor"]=="DePiezas") echo ' checked ' ; ?>/>
                <label for = "id_tipoProveedor">Piezas</label>
            
                <input id="id_tipoProveedor1" type="radio" name="tipoProveedor" value="DeResiduos" <?php if($registroProveedor["tipoProveedor"]=="DeResiduos") echo ' checked '; ?>/>
                <label for = "id_tipoProveedor1">Residuos</label>
            </div>
            <div>
                <label for="id_email">Email:</label>
                <input id="id_email" name="email" type="text" value="<?php echo $registroProveedor['email'];?>"  />
            </div>
            <div>
                <label for="id_telefono">Teléfono*:</label>
                <input id="id_telefono" name="telefono" type="text" value="<?php echo $registroProveedor['telefono'];?>" required/>
            </div>
            <button id="id_enviar" type="submit">Registrar</button>
        </fieldset>
    </form>

    <body>

</html>
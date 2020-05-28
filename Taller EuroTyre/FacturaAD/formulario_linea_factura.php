<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
    if(!isset($_SESSION["admin"])){
        Header("Location: ../Otros/login.php");	
    }

    if (!isset($_SESSION['registroLinea'])) {
		$registroLinea['cantidad'] = "";
        $registroLinea['pieza'] = "";
		$registroLinea['numFactura'] = $_REQUEST["numFactura"];
	
		$_SESSION['registroLinea'] = $registroLinea;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$registroLinea = $_SESSION['registroLinea'];
			
	if (isset($_SESSION["errores"]))
        $errores = $_SESSION["errores"];
        unset($_SESSION["errores"]);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">

    <title>Registrar Línea de Factura</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_form_lineaFact.css" />

    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="apple-touch-icon" href="../img/logo.png">
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

    <div id="id_divLinea">
    <form id="id_regLinea" method="post" action="validacion_linea.php" >
        <input type="hidden" name="numFactura" value="<?php echo $registroLinea['numFactura']; ?>" />
        <fieldset id="id_campo">
            <h1>Registrar Línea de Factura</h1>
            <p id="id_obligatorio">* Obligatorio</p>
            
            <div class="div">
                <label for="id_pieza">Pieza*:</label>
                <div class="campo">
                    <select id="id_pieza" name="pieza" required> 
                        <?php 
                        require_once("../Otros/gestionBD.php");
                        require_once("gestionarFacturas.php");
                        $conexion = crearConexionBD();
                        $piezas = consultaPiezas($conexion);
                        
                        foreach($piezas as $pieza) {
                        ?>
                                <option value="<?php echo $pieza["OID_P"] ?>">
                                <?php echo  $pieza["NOMBRE"] ?></option>
                        <?php } 
                        cerrarConexionBD($conexion);
                        ?>
                    </select>
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_cantidad">Unidades*:</label>
                <div class="campo">
                    <input id="id_cantidad" title="Debe ser un valor entero comprendido entre 0 y 9999" name="cantidad" type="text" 
                        value="<?php echo $registroLinea['cantidad'];?>" pattern="^[1-9]+[0-9]{0,3}$" required />
                </div>
            </div>
            <br />
            <button id="id_enviar" type="submit">Añadir</button>

        </fieldset>
    </form>
    </div>
    </body>

</html>
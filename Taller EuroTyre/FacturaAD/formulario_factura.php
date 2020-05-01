<?php
	session_start();

    require_once("gestionarFacturas.php");

    if(!isset($_SESSION["admin"])) {
        Header("Location: ../Otros/login.php");
    } 
    
/*    if(isset($_REQUEST["oid_r"])) {
        $oidr = 
        $dni = 
    }
*/
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['registroFactura'])) {
        $registroFactura['dni'] = $_REQUEST["dni"];
        $registroFactura['oidr'] = $_REQUEST["oid_r"];
        $registroFactura['descripcion'] = "";
        $registroFactura['manoDeObra'] = "";
        $registroFactura['IVA'] = "0.21";
        $registroFactura['Pago'] = "Efectivo";
        
	
		$_SESSION['registroFactura'] = $registroFactura;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
        $registroFactura = $_SESSION['registroFactura'];
        /* if(isset($_SESSION["oidr"])&& isset($_SESSION["dni"])) {
            $oidr = $_SESSION["oidr"];
            $dni = $_SESSION["dni"];
        }else{
            ?> <p>Fallooooo</p><?php
        } */
    }		
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Creación de Factura</title>
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

    <h1>Registro de factura para reparación <?php echo $registroFactura['dni'] ?></h1>
    <p>*Obligatorio</p>

    <form id="id_regFactura" method="post" action="validacion_factura.php" novalidate>
        <fieldset>
            <input id="id_oidr" type="hidden" name="oidr" value="<?php echo $registroFactura['oidr'] ?>" />
            <div>
                <label for="id_dni">Dni de cliente:</label>
                <input size="5px" id="id_dni" type="text" name="dni" value="<?php echo $registroFactura['oidr']?>" disabled/>
            </div>
            <div>
                <label for="id_descripcion">Descripción:</label>
                <input id="id_descripcion" type="text" name="descripcion" value="<?php echo $registroFactura["descripcion"]; ?>" />
            </div>
            <div>
                <label for="id_manoDeObra">Mano de Obra*:</label>
                <input id="id_manoDeObra" type="text" name="manoDeObra" value="<?php echo $registroFactura["manoDeObra"]; ?>" required />
            </div>
            <div>
                <label for="id_iva">IVA*:</label>
                <input id="id_iva" type="text" name="iva" value="<?php echo $registroFactura["IVA"]; ?>" required />
            </div>
            <div>
                <label for="id_Pago">Tipo de Pago*:</label>
                <input id="id_Pago" type="radio" name="Pago" value="Efectivo" <?php if($registroFactura["Pago"]=="Efectivo") echo ' checked ' ; ?>/>
                <label for = "id_Pago">Efectivo</label>
            
                <input id="id_tipoPago1" type="radio" name="Pago" value="Tarjeta" <?php if($registroFactura["Pago"]=="Tarjeta") echo ' checked '; ?>/>
                <label for = "id_Pago1">Tarjeta</label>
            </div>
            <button id="id_enviar" type="submit">Crear</button>
        </fieldset>
    </form>

    <body>

</html>
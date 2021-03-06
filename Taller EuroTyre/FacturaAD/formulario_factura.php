<?php
	session_start();

    require_once("gestionarFacturas.php");

    if(!isset($_SESSION["admin"])) {
        Header("Location: ../Otros/login.php");
    } 
    if(!isset($_SESSION["reparacion"]) && !isset($_SESSION['registroFactura'])) {
        Header("Location: ../ReparacionesAD/home.php");
    }

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['registroFactura'])) {
        $registroFactura['dni'] = $_SESSION["reparacion"]["dni"];
        $registroFactura['oidr'] = $_SESSION["reparacion"]["oid_r"];
        $registroFactura['descripcion'] = "";
        $registroFactura['manoDeObra'] = "";
        $registroFactura['IVA'] = 0.21;
        $registroFactura['Pago'] = "Efectivo";

		$_SESSION['registroFactura'] = $registroFactura;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
        $registroFactura = $_SESSION['registroFactura'];
    }		

    if(isset($_SESSION["reparacion"])) {
        unset($_SESSION["reparacion"]);
    }

	if (isset($_SESSION["errores"]))
        $errores = $_SESSION["errores"];
        unset($_SESSION["errores"]);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Creación de Factura</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_form_factura.css" />
    <script src="../ValidacionesJS/valida_factura.js" ></script>
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
    <div id = id_divFactura>
    <form id="id_regFactura" method="post" action="validacion_factura.php" onsubmit="return valida1()">
        <fieldset id="id_campo">
            <h1>Registro de factura para reparación <?php echo $registroFactura['oidr'];?></h1>
            <p id="id_obligatorio">*Obligatorio</p>
            <input id="id_oidr" type="hidden" name="oidr" value="<?php echo $registroFactura['oidr']; ?>" />
            <div class="div">
                <label for="id_dni">DNI del cliente:</label>
                <div class="campo">
                    <input size="5" id="id_dni" type="text" name="dni" value="<?php echo $registroFactura['dni'];?>" readonly="readonly" />
                </div>
            </div>
            <br />
            <div class = "div">
                <label for="id_descripcion">Descripción:</label><br/>
                <div class="campo"> 
                    <textarea id="id_descripcion" name="descripcion" rows="3" cols="31" maxlength="100"
                        value="<?php echo $registroFactura["descripcion"]; ?>"><?php echo $registroFactura["descripcion"]; ?></textarea>
                </div>
            </div>
            <br /><br /><br />
            <div class = "div">
                <label for="id_manoDeObra">Mano de Obra*:</label>
                <div class="campo">
                <input id="id_manoDeObra" type="text" name="manoDeObra" 
                    value="<?php echo str_replace(',','.', $registroFactura["manoDeObra"]);?>" oninput="this.setCustomValidity('')" required />
                </div>
            </div>
            <br />
            <div class = "div">
                <label for="id_iva">IVA*:</label>
                <div class="campo">
                    <input id="id_iva" size="3" type="text" name="IVA" value="<?php echo str_replace(',','.', $registroFactura["IVA"]);?>" 
                    required oninput="this.setCustomValidity('')"/>
                </div>
            </div>
            <br />
            <div class = "div">
                <label for="id_Pago">Tipo de Pago*:</label>
                <div class="campo">
                    <input id="id_Pago" type="radio" name="Pago" 
                        value="Efectivo" <?php if($registroFactura["Pago"]=="Efectivo") echo ' checked ' ; ?>/>
                    <label for = "id_Pago">Efectivo</label>
                
                    <input id="id_Pago1" type="radio" name="Pago" 
                        value="Tarjeta" <?php if($registroFactura["Pago"]=="Tarjeta") echo ' checked '; ?>/>
                    <label for = "id_Pago1">Tarjeta</label>
                </div> 
            </div>
            <button id="id_enviar" type="submit">Crear</button>
        </fieldset>
    </form>
    </div>

    </body>

</html>
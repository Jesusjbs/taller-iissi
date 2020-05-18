<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarFacturas.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["registroFactura"])) {
		$registroFactura = $_SESSION["registroFactura"];
		$_SESSION["registroFactura"] = null;
		
        $_SESSION["errores"] =null;
	}
	else 
		Header("Location: formulario_factura.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style_accion_usuario.css" />
  <title>Factura registrada</title>
</head>

<body>
	<?php
		include_once("../Otros/cabecera.php");
	?>

	<main>
        <?php 	
            if(crearFactura($conexion, $registroFactura)) {		
                $_SESSION["oid_r"] = $registroFactura["oidr"];
                Header("Location: factura.php");
		 } else { ?>
			<h1>Fallo al realizar la operación.</h1>
			<div id="id_div">
			<form action="../FacturaAD/formulario_factura.php" method="post">
                    <input type="hidden" value="<?php echo $registroFactura["oidr"];?>" name="oid_r" />
                    <input type="hidden" value="<?php echo $registroFactura["dni"];?>" name="dni" />
                    <button id="id_formFact" type="submit">Reintentar</button>
            </form>
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
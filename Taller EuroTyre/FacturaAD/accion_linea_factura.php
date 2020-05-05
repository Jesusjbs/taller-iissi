<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarFacturas.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["registroLinea"])) {
		$registroLinea = $_SESSION["registroLinea"];
		$_SESSION["registroLinea"] = null;
		
        $_SESSION["errores"] =null;
	}
	else 
		Header("Location: formulario_linea_factura.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Línea de factura registrada</title>
</head>

<body>
	<?php
		include_once("../Otros/cabecera.php");
	?>

	<main>
        <?php 	
            if(crearLineaFactura($conexion, $registroLinea)) {		
                $_SESSION["numFactura"] = $registroLinea["numFactura"];
                Header("Location: factura.php");
		 } else { ?>
			<h1>Fallo al realizar la operación.</h1>
			<div >
			<form action="../FacturaAD/formulario_linea_factura.php" method="post">
                    <input type="hidden" value="<?php echo $registroLinea["numFactura"];?>" name="numFactura" />
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
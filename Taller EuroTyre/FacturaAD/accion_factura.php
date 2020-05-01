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
  <title>Factura registrada</title>
</head>

<body>
	<?php
		include_once("../Otros/cabeceraAdmin.php");
	?>

	<main>
        <?php 	
            if(crearFactura($conexion, $registroFactura)) {		
                $_SESSION["oid_r"] = $registroFactura["oidr"];
                Header("Location: factura.php");
		 } else { ?>
			<h1>Fallo al realizar la operación.</h1>
			<div >	
				Pulsa <a href="formulario_factura.php">aquí</a> para volver al formulario.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
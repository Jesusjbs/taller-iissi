<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarProveedor.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["registroProveedor"])) {
		$registroProveedor = $_SESSION["registroProveedor"];
        
        $_SESSION["registroProveedor"] = null;
        $_SESSION["errores"] =null;
	}
	else 
		Header("Location: formulario_proveedor.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style_accion_usuario.css" />
  <title>Registrado proveedor</title>
</head>

<body>
	<?php
		include_once("../Otros/cabecera.php");
	?>

	<main>
        <?php 	
            if(contratarProveedor($conexion, $registroProveedor)) {
				Header("Location: proveedores.php");
		 } else { ?>
			<div id="id_div">
				<h1>Ya existe un proveedor con alguno de los datos registrados.</h1>
				 <p>Pulsa <a href="formulario_proveedor.php">aquí</a> para volver al formulario.</p>
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
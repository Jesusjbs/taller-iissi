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
  <title>Registrado proveedor</title>
</head>

<body>
	<?php
		include_once("../Otros/cabeceraAdmin.php");
	?>

	<main>
        <?php 	
            if(contratarProveedor($conexion, $registroProveedor)) { ?>		
			
			<h1>Se ha registrado correctamente el proveedor.</h1>
			<div >	
				Pulsa <a href="proveedores.php">aquí</a> para acceder a la vista de proveedores .
			</div>
		<?php } else { ?>
			<h1>Fallo al realizar la operación.</h1>
			<div >	
				Pulsa <a href="formulario_proveedor.php">aquí</a> para volver al formulario.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
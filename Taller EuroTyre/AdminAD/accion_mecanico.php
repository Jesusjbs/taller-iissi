<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarAdmin.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["registroMecanico"])) {
		$nuevoMecanico = $_SESSION["registroMecanico"];
        
        $_SESSION["registroMecanico"] = null;
        $_SESSION["errores"] =null;
	}
	else 
		Header("Location: formulario_mecanico.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registrado correctamente</title>
</head>

<body>
	<?php
		include_once("../Otros/cabecera.php");
	?>

	<main>
        <?php 	
            if(contratarMecanico($conexion, $nuevoMecanico)) {
				Header("Location: mecanicos.php");
		 } else { ?>
			<h1>Ya existe un mecánico con el dni introducido.</h1>
			<div >	
				Pulsa <a href="formulario_mecanico.php">aquí</a> para volver al formulario.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
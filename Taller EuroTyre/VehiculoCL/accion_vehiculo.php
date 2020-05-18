<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarVehiculo.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["registro"])) {
		$nuevoVehiculo = $_SESSION["registro"];
        
        $_SESSION["registro"] = null;
        $_SESSION["errores"] =null;
	}
	else 
		Header("Location: formulario_vehiculo.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style_accion_vehiculo.css" />
  <title>Registrado correctamente</title>
</head>

<body>
	<?php
		include_once("../Otros/cabecera.php");
	?>

	<main>
        <?php 	
            if(alta_vehiculo($conexion, $nuevoVehiculo,$_SESSION['login'])) {	
				Header("Location: mis_vehiculos.php"); 
		    } else { ?>
			<h1>El vehículo ya existe en la base de datos.</h1>
			<div id="id_div">	
				Pulsa <a href="formulario_vehiculo.php">aquí</a> para volver al formulario.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>


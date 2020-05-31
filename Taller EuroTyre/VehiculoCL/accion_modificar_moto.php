<?php	
	session_start();	
	
	if (isset($_SESSION["moto"])) {
		$moto = $_SESSION["moto"];
		unset($_SESSION["moto"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarVehiculo.php");
		
		$conexion = crearConexionBD();

		$excep = editarMoto($conexion, $moto);
		
		cerrarConexionBD($conexion);
		?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/style_accion_usuario.css" />
	<title>Registrado vehículo</title>
</head>

<body>
	<?php 
		include_once("../Otros/cabecera.php");
		if($excep<>"") { ?>
	<div id="id_div">
		<h1>Ya existe una motocicleta con el número de bastidor introducido.</h1>
		<p>Pulsa <a href="mis_vehiculos.php">aquí</a> para volver.</p>
	</div>

	<?php
		} else Header("Location: mis_vehiculos.php");

	} else 
		Header("Location: mis_vehiculos.php"); 
?>
</body>

</html>
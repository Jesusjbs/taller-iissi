<?php
	session_start();
	
	require_once("../Otros/gestionBD.php");
	require_once("gestionarCitas.php");

	if(!isset($_SESSION["login"])) {
		header("Location: ../Otros/login.php");
	}
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION['cita'])) {
		$nuevaCita = $_SESSION['cita'];
		
		$_SESSION['cita'] = null;
		$_SESSION['errores'] = null;
	}
	else 
		Header("Location: home.php");

		$conexion = crearConexionBD(); 
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Cita realizada</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="../css/style_accion_cita.css" />
		<link rel="shortcut icon" href="../img/logo.png">
		<link rel="apple-touch-icon" href="../img/logo.png">

    </head>
    
   <body>
	<?php
				if(crea_cita($conexion, $_SESSION["login"], $nuevaCita)) { ?>		
				<div id="id_div">
				<h2 id="id_parrafo">Su cita con fecha <?php echo date('d/m/Y',strtotime($nuevaCita['dia'])); ?> ha sido solicitada correctamente, para más datos, dirigase a la pestaña de 
				<a href="selecciona_vehiculo.php">consultas</a></h2>
				</div>

			<?php } else { ?>
				<div id="id_div">	
					<h2>Datos erróneos, vuelva a introducirlos</h2>
					Pulsa <a href="home.php">aquí</a> para volver al formulario.
				</div>
			<?php } ?>

   </body> 
</html>
<?php

	cerrarConexionBD($conexion);
?>
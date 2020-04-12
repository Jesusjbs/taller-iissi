<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");

	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION['cita'])) {
		$nuevaCita = $_SESSION['cita'];
		// También se puede utilizar la función unset()
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

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Cita realizada</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="./img/logo.png">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>
    
   <body>
	<?php 	
				if(crea_cita($conexion, $_SESSION["login"], $nuevaCita)) { ?>		
				<p>Su cita con fecha <?php echo date('d/m/Y',strtotime($nuevaCita['dia'])); ?> ha sido solicitada correctamente, para más datos, dirigase a la pestaña de <a href="#">consultas</a></p>

			<?php } else { ?>
				<h1>Datos erróneos, vuelva a introducirlos</h1>
				<div >	
					Pulsa <a href="home.php">aquí</a> para volver al formulario.
				</div>
			<?php } ?>

   </body> 
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>
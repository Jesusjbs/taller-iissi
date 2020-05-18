<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarUsuarios.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];

		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formulario_usuario.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registrado correctamente</title>
  <link rel="stylesheet" type="text/css" href="../css/style_accion_usuario.css" />

</head>

<body>
	<main>
        <?php 	
            if(alta_cliente($conexion, $nuevoUsuario)) { ?>		
			<?php
				 $_SESSION["login"] = $nuevoUsuario["dni"];
				 include_once("../Otros/cabecera.php");
			?>
			<div id="id_div">	
			<h1>Te has registrado correctamente como <?php echo $nuevoUsuario["nombre"]; echo " ". $nuevoUsuario["apellidos"];?></h1>
				<p>Pulsa <a href="../CitaCL/home.php">aquí</a> para acceder a la página de inicio del taller.</p>
			</div>
		<?php } else { 
			include_once("../Otros/cabecera.php"); ?>
			<div id="id_div">	
				<h1>El usuario ya existe en la base de datos.</h1>
				<p>Pulsa <a href="formulario_usuario.php">aquí</a> para volver al formulario.</p>
			</div>
		<?php } ?>
	</main>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>


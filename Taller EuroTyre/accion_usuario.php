<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarUsuarios.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	// Se recupera la variable de sesión y se anula
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		// También se puede utilizar la función unset()
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formulario_usuario.php");	

	// CONEXIÓN A LA BASE DE DATOS
	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>INSERTAR TÍTULO</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
        <?php 	
            if(alta_cliente($conexion, $nuevoUsuario)) { ?>		
			<h1>Te has registrado correctamente como <?php echo $nuevoUsuario["nombre"]; echo $nuevoUsuario["apellidos"];?></h1>
			<div >	
				Pulsa <a href="home.php">aquí</a> para acceder a la página de inicio del taller.
			</div>
		<?php } else { ?>
			<h1>El usuario ya existe en la base de datos.</h1>
			<div >	
				Pulsa <a href="formulario_usuario.php">aquí</a> para volver al formulario.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>


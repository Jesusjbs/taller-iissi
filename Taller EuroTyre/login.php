<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	if (isset($_POST["submit"])){
		$dni= $_POST["dni"];
		$pass = $_POST["pass"];


		$conexion = crearConexionBD();
	
		$existeCliente = consultarCliente($conexion, $dni, $pass);
		
		cerrarConexionBD($conexion);

		if(!$existeCliente) {
			$login = "";
		} else {

			$_SESSION["login"] = $dni;

			header("Location: home.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Taller EuroTyre</title>
		<link rel="stylesheet" type="text/css" href="./css/style_index.css" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="./img/logo.png">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>

	<body>

	<?php 
	if (isset($login)) {
		echo "<div class=\'error\'>";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}
	?>

		<section id="id_superior">
			<header>
				<img id="id_logo" src="./img/logo.png" height="125px" alt="Logo EuroTyre"/>
			</header>
		</section>

        <!-- Divisor central de login -->		
		<section id="id_principal">
        <!-- Login del usuario -->
			<div id="id_secundario">
				<div id="id_transparencia"></div>
				<div id="id_usuario">
					<p style="position: relative;z-index: 1;font-size: large;color: #3d4045;">Inicia sesión como usuario</p>
					<form id="id_formuser" method="POST" action="login.php">
						<fieldset id="id_campouser">
							<img alt="user.png" style="width: 15px; height: 15px;" src="./img/user.png" />
							<label for="id_username">Usuario:</label>
							<input size="25" id="id_username" name="username" type="text" required/>
							<br><br>

							<img alt="pass.png" style="width: 15px; height: 15px;" src="./img/pass.png" />
							<label for="id_userpass">Contraseña:</label>
							<input size="25" id="id_userpass" name="userpass" type="password" required/>
							<button id="id_btuser" type="submit">Iniciar Sesión</button>
						</fieldset>
					</form>
				</div>
        <!-- Divisor de registro -->
				<div id="id_register">
					<p style="color: #FBDE1B">
						¿No tienes una cuenta?
					</p>
					<a id="id_btregistro" href="formulario_usuario.php">Regístrate</a>
				</div>
			</div>
		</section>
        <!-- Divisor inferior footer -->		
		
		<div id="id_inferior">
			<footer id="id_footer">
				<p>Al usar este sitio, reconoces haber leído y entendido nuestra <a href="terminos.php">Política de Privacidad y nuestros Términos y Condiciones</a>.</p>
			</footer>
		</div>
	</body>
</html>
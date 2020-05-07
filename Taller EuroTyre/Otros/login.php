<?php
	session_start();
  	
  	include_once("../Otros/gestionBD.php");
	include_once("../ClienteCL/gestionarUsuarios.php");
	include_once("../AdminAD/gestionarAdmin.php");
	
	 // Si se redirecciona a esta pagina con una sesión activa, se cierra (Para cerrar sesión)
	if(isset($_SESSION["login"])){
		$_SESSION["login"] = null;
	}

	if(isset($_SESSION["admin"])){
		$_SESSION["admin"] = null;
	}
	
	
	if (isset($_POST['submit'])){
		$dni= $_POST['dni'];
		$pass = $_POST['pass'];


		$conexion = crearConexionBD();
	
		$existeCliente = consultarCliente($conexion, $dni, $pass);
		$existeMecanico = consultarMecanico($conexion, $dni, $pass);
		cerrarConexionBD($conexion);

		if(!$existeCliente & !$existeMecanico) {
			$login = "";
		} else if($existeCliente){
			$_SESSION["login"] = $dni;
			header("Location: ../CitaCL/home.php");
		} else {
			$_SESSION["admin"] = $dni;
			header("Location: ../ReparacionesAD/home.php");

		}
	}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">

		<title>Taller EuroTyre</title>
		<link rel="stylesheet" type="text/css" href="../css/style_index.css" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<link rel="shortcut icon" href="../img/logo.png">
		<link rel="apple-touch-icon" href="../img/logo.png">
	</head>

	<body>

	<?php 
	if (isset($login)) {
		echo "<div class=\'error\'>";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}
	?>

		<div id="id_superior">
			<header>
				<img id="id_logo" src="../img/logo.png" alt="Logo EuroTyre"/>
			</header>
		</div>

        <!-- Divisor central de login -->		
		<div id="id_principal">
        <!-- Login del usuario -->
			<div id="id_secundario">
				<div id="id_transparencia"></div>
				<div id="id_usuario">
					<p style="position: relative;z-index: 1;font-size: large;color: #3d4045;">Iniciar sesión</p>
					<form id="id_formuser" method="POST" action="login.php">
						<fieldset id="id_campouser">
							<img alt="user.png" style="width: 15px; height: 15px;" src="../img/user.png" />
							<label for="id_dni">Usuario:</label>
							<input size="33" id="id_dni" name="dni" type="text" placeholder="DNI" required/>
							<br><br>

							<img alt="pass.png" style="width: 15px; height: 15px;" src="../img/pass.png" />
							<label for="id_pass">Contraseña:</label>
							<input size="33" id="id_pass" name="pass" type="password" required/>
							<button id="id_btuser" name="submit" type="submit">Iniciar Sesión</button>
						</fieldset>
					</form>
				</div>
        <!-- Divisor de registro -->
				<div id="id_register">
					<p style="color: #FBDE1B">
						¿No tienes una cuenta?
					</p>
					<a id="id_btregistro" href="../ClienteCL/formulario_usuario.php">Regístrate</a>
				</div>
			</div>
		</div>
        <!-- Divisor inferior footer -->		
		
		<div id="id_inferior">
			<footer id="id_footer">
				<p>Al usar este sitio, reconoces haber leído y entendido nuestra <a href="../Otros/terminos.php">Política de Privacidad y nuestros Términos y Condiciones</a>.</p>
			</footer>
		</div>
	</body>
</html>

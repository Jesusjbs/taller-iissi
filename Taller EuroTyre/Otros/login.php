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
	<div id="id_superior">
			<header>
				<img id="id_logo" src="../img/logo.png" alt="Logo EuroTyre"/>
				<div class="icons">
                    <a target="_blank" href="https://m.facebook.com/Eurotyre-1942028509455716/?ref=bookmarks"><img src="../img/fb.png" style="width:50px;height:50px;"/></a>
                    <a target="_blank" href="https://mobile.twitter.com/EurotyreEs"><img src="../img/twitter.png" style="width:50px;height:50px;"/></a>
                </div>
			</header>
	</div>
	<?php 
	if (isset($login)) {
		echo "<div id=\"div_errores\" class=\"error\">";
		echo "El DNI y la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.";
		echo "</div>";
	}
	?>

        <!-- Divisor central de login -->		
		<div id="id_principal">
        <!-- Login del usuario -->
			<div id="id_secundario">
				<div id="id_transparencia"></div>
				<div id="id_usuario">
					<p id="id_pInicio">Iniciar sesión</p>
					<form id="id_formuser" method="POST" action="login.php">
						<fieldset id="id_campouser">
							<img alt="user.png" id="id_userImg" src="../img/user.png" />
							<label for="id_dni">Usuario:</label>
							<input size="31" id="id_dni" title="Ocho dígitos (sin letra)" name="dni" type="text" 
							placeholder="DNI" pattern="^[0-9]{8}" required/>
							<br><br>

							<img id="id_passImg" alt="pass.png" src="../img/pass.png" />
							<label for="id_pass">Contraseña:</label>
							<input size="31" id="id_pass" name="pass" type="password" required/>
							<button id="id_btuser" name="submit" type="submit">Iniciar Sesión</button>
						</fieldset>
					</form>
				</div>
        <!-- Divisor de registro -->
				<div id="id_register">
					<p id="id_pAux">
						¿No tienes una cuenta?
					</p>
					<a id="id_btregistro" href="../ClienteCL/formulario_usuario.php">Regístrate</a>
				</div>
			</div>
		</div>
        <!-- Divisor inferior footer -->		
		
		<div id="id_inferior">
			<footer id="id_footer">
			<div id="id_divValidaCSS">
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img style="border:0;width:88px;height:31px"
						src="http://jigsaw.w3.org/css-validator/images/vcss"
						alt="¡CSS Válido!" />
				</a>
			</div>
			<div id="id_divValidaHTML">
				<img style="border:0;width:88px;height:31px;cursor:pointer" src="../img/valid_icon.png" alt="¡HTML Válido!" />
			</div>
				<p>Al usar este sitio, reconoces haber leído y entendido nuestra <a href="../Otros/terminos.php">Política de Privacidad y nuestros Términos y Condiciones</a>.</p>
			</footer>
		</div>
	</body>
</html>

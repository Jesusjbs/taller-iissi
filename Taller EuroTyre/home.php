<?php
	session_start();

	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['cita'])) {
		$cita["auto"] = "";
		$cita["dia"] = "";
		$cita["itv"] = "";
		$cita["presupuesto"] = 0;
		
		$_SESSION['cita'] = $cita;
	}

	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$cita = $_SESSION['cita'];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>home</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./css/style_home.css" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="./img/logo.png">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>

	<body>
		<?php
			include_once("cabecera.php");

				// Mostrar los errores de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
		?>

		<div id="id_cita">
			<form id="id_formCita" method="POST" action="validacion_cita.php">
				<fieldset id="id_campo"></fieldset>
					<h1>Solicitar Cita</h1>
					<br/>
<!--					<label for="id_auto">Elige de entre tus vehículos*:</label>
					<br/>
	-->				
		  			<div class="div">
						<label for="id_auto">Introduzca su matrícula*:</label>
						<div class="campo">
							<input class="campo" id="id_auto" name="auto" type="text" required/>
						</div>
					</div>
					<br/><br/>

					<div id="id_nota">
						<p>Nota: Si no encuenta su vehiculo
							en la lista, debe de registrarlo en
							el siguiente <a href="#">enlace</a></p>
					</div>
					  
					<div class="div">
						<label for="id_dia">Elige un día*:</label>
						<div class="campo">
							<input id="id_dia" name="dia" type="date" required/>
							<img alt="date.png" style="width: 2.5%; height: 2.5%;margin-bottom: -0.7%" src="./img/date.png" />
							</div>
					</div>
					<br/><br/>

					<div class="div">
						<label for="id_itv" >Próxima ITV:</label>
						<div class="campo">
							<input id="id_itv" name="itv" type="date" required/>
							<img alt="date.png" style="width: 2.5%; height: 2.5%;margin-bottom: -0.7%" src="./img/date.png" />
						</div>
					</div>
					<br/><br/>

					<div id="id_divPresupuesto">
						<input id="id_presuspuesto" name="presupuesto" type="checkbox"/>
						<label for="id_presupuesto">Quiero solicitar un presupuesto</label>
					</div>
					<br/><br/>

					<button id="id_solicitar" name="submit" type="submit">Solicitar</button>
				</fieldset>
			</form>
		</div>
	</body>
</html>

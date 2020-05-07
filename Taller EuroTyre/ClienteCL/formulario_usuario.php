<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['dni'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['telefono'] = "";
		$formulario['email'] = "";
		$formulario['direccion'] = "";
		$formulario['pass'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	
	else
		$formulario = $_SESSION['formulario'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8">

	<title>Regístrate</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style_register.css" />

	<link rel="shortcut icon" href="../img/logo.png">
	<link rel="apple-touch-icon" href="../img/logo.png">
</head>

<body>
	
	<?php
	  include_once("../Otros/cabecera.php");
	
	
	// Mostrar los errores de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	<div id="id_registro">
	<form id="id_altaUsuario" method="post" action="validacion_usuario.php" novalidate>
		<h1>Crea una cuenta</h1>
		<p style="color: red;margin-left: 20%;">* Obligatorio</p>
		<fieldset id="id_campoRegister">
		<div id="id_nombreCompleto">
			<div>
				<input class="campo" id="id_nombre" name="nombre" type="text" size="15" placeholder="Nombre *"
					value="<?php echo $formulario['nombre'];?>" required />
			</div>

			<div id="id_divApellidos">
				<input class="campo" id="id_apellidos" name="apellidos" type="text" size="20" placeholder="Apellidos *"
					value="<?php echo $formulario['apellidos'];?>" required />
			</div>
			<br><br>
		</div>
			<div class="div">
				<label for="id_dni">DNI*:</label>
				<input class="campo" id="id_dni" name="dni" type="text" placeholder="12345678" size="12" pattern="^[0-9]{8}"
					title="Ocho dígitos (sin letra)" value="<?php echo $formulario['dni'];?>" required>
					<br><br>
			</div>

			<div class="div">
				<label for="id_telefono">Teléfono*:</label>
				<input class="campo" id="id_telefono" name="telefono" type="text" size="14" placeholder="XXX-XXX-XXX" 
				pattern="^[0-9]{9}"
					title="Nueve dígitos" value="<?php echo $formulario['telefono'];?>" required>
					<br><br>
			</div>

			<div class="div">
				<label for="id_email">Email:</label>
				<input class="campo" size="30"  id="id_email" name="email" type="email" placeholder="ejemplo@compañia.dominio"
					value="<?php echo $formulario['email'];?>" />
					<br><br>
			</div>
			
			<div class="div">
			<label for="id_direccion">Dirección:</label>
				<input class="campo" id="id_direccion" name="direccion" type="text" size="35"
				placeholder="Calle/Avda. (Reina Mercedes) Nº XXX"
					value="<?php echo $formulario['direccion'];?>" />
					<br><br>
			</div>
			
			<div class="div">
			<label for="id_contraseña">Contraseña*:</label>
				<input class="campo" id="id_contraseña" name="contraseña" type="password" title="Mínimo 6 caracteres (Letra mayúscula, letra minúscula y número)" required/>
				<br><br>
			</div>
			
			<div class="div">
			<label for="id_confirmar">Confirmar Contraseña*:</label>
				<input class="campo" id="id_confirmar" name="confirmar" type="password" title="Confirmación de contraseña" required />
				<br>
			</div>
			
			<p style="text-align: center;">Al hacer clic en Enviar, aceptas nuestros <a href="../Otros/terminos.php">Términos y Condiciones</a></p>

			<button id="id_enviar" type="submit">Enviar</button>
			
		</fieldset>
	</form>
	</div>
</body>

</html>
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
		unset($_SESSION["errores"]);
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
	<form id="id_altaUsuario" method="post" action="validacion_usuario.php" >
		<h1>Crea una cuenta</h1>
		<p id="id_obligatorio">* Obligatorio</p>
		<br />
		<fieldset id="id_campo">
		  
			<div class="div">
				<div class="campo">
					<input id="id_nombre" title="El nombre debe de contener menos de 50 letras" name="nombre" type="text" size="15" placeholder="Nombre*"
						value="<?php echo $formulario['nombre'];?>" pattern="[a-zA-ZÑñáéíóú]{1,50}" required />
				</div>
			</div>
			<div class="div">
				<div class="campo">
					<input id="id_apellidos" title="El apellido debe de contener menos de 50 letras" name="apellidos" type="text" size="20" placeholder="Apellidos*"
						value="<?php echo $formulario['apellidos'];?>" pattern="[a-zA-ZÑñáéíóú]{1,50}" required />
				</div>
			</div>	
			<br />
			<div class="div">
				<label for="id_dni">DNI*:</label>
		  		<div class="campo">
					<input id="id_dni" name="dni" type="text" placeholder="12345678" size="12" 
					pattern="^[0-9]{8}" title="Ocho dígitos (sin letra)" value="<?php echo $formulario['dni'];?>" required>
				</div>
			</div>
			<br />
			<div class="div">
				<label for="id_telefono">Teléfono*:</label>
				<div class="campo">
					<input id="id_telefono" name="telefono" type="text" size="14" placeholder="XXX-XXX-XXX" 
					pattern="^[0-9]{9}"
						title="Nueve dígitos" value="<?php echo $formulario['telefono'];?>" required />
					</div>
			</div>
			<br />
			<div class="div">
				<label for="id_email">Email:</label>
				<div class="campo">
					<input size="30"  id="id_email" name="email" type="email" placeholder="ejemplo@compañia.dominio" maxlength="50"
						value="<?php echo $formulario['email'];?>" />
				</div>
			</div>
			<br />
			
			<div class="div">
			<label for="id_direccion">Dirección:</label>
				<div class="campo">
				<input id="id_direccion" title="Solo debe contener letras y dígitos y tene una longitud máxima de 50" name="direccion" type="text" size="35" placeholder="Calle/Avda. (Reina Mercedes) Nº XXX"
					value="<?php echo $formulario['direccion'];?>" pattern="[a-zA-ZÑñáéíóú0-9]{0,50}" />
				</div>
			</div>
			<br />
			<div class="div">
				<label for="id_contraseña">Contraseña*:</label>
				<div class="campo"> 
					<input id="id_contraseña" name="contraseña" type="password" 
					pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" 
					title="Mínimo 6 caracteres (Letra mayúscula, letra minúscula y número)" required/>
				</div>
			</div>
			<br />
			
			<div class="div">
				<label for="id_confirmar">Confirmar Contraseña*:</label>
				<div class="campo">
					<input id="id_confirmar" name="confirmar" type="password" title="Confirmación de contraseña" required />
				</div>
			</div>

			<p id="id_terminos">Al hacer clic en Enviar, aceptas nuestros <a href="../Otros/terminos.php">Términos y Condiciones</a></p>

			<button id="id_enviar" type="submit">Enviar</button>
			
		</fieldset>
	</form>
	</div>
</body>

</html>
<?php 
	session_start();
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Error</title>
  <link rel="stylesheet" type="text/css" href="../css/style_excepcion.css" />
</head>
<body>	
	
<?php	
	include_once("cabecera.php"); 
?>	

	<div>
		
		<?php if ($destino<>"") { ?>
		<div id="id_div">
		<h2>Ups!</h2>
		<p>Ocurrió un problema durante el procesado de los datos.Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.</p>
		</div>
		<?php } else { ?>
		<div id="id_div">
		<h2>Ups!</h2>
		<p>Ocurrió un problema para acceder a la base de datos. Pulse <a href="../Otros/login.php">Aquí</a> para volver a la página de inicio.</p>
		</div>
		<?php } ?>
	</div>
		
	<div class='excepcion'>	
		<?php echo "Información relativa al problema: $excepcion;" ?>
	</div>

<!--<?php	
	include_once("pie.php");
?>-->	

</body>
</html>
<?php	
	session_start();	
	
	if (isset($_SESSION["prov"])) {
		$prov = $_SESSION["prov"];
		unset($_SESSION["prov"]);
		
		require_once("../Otros/gestionBD.php");
		require_once("gestionarProveedor.php");
		

		$conexion = crearConexionBD();

		$excep = editarProveedor($conexion, $prov);

		cerrarConexionBD($conexion);

		?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style_accion_usuario.css" />
	<title>Registrado proveedor</title>
	</head>
	<body>
	<?php
		include_once("../Otros/cabecera.php");
		
		if($excep<>""){ ?>
		<div id="id_div">
			<h1>Ya existe un proveedor con alguno de los datos introducidos.</h1>
			<p>Pulsa <a href="proveedores.php">aquí</a> para volver.</p>
		</div>

		<?php } else {
			Header("Location: proveedores.php");
		} ?>
	</body>
</html>
<?php
	} else {
		Header("Location: proveedores.php"); 
	}
?>
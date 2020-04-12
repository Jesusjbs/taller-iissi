<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarVehiculo.php");

		if(!isset($_SESSION["login"])){
			Header("Location: login.php");	
			
		}else{

			$conexion = crearConexionBD();

            $consulta = consultaCoche($conexion,$_SESSION["login"]);
            $consultaMoto = consultaMoto($conexion,$_SESSION["login"]);

			cerrarConexionBD($conexion);
		}

	
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Mis vehículos</title>
</head>

<body>

<?php
    include_once("cabecera.php");
?>

    <main>

    <?php
        $i = 1;
		foreach($consulta as $vehiculo) {

	?>

        <article class="libro">
            <p>Coche <?php echo " ".$i++." : ";?></p>
                        <div><?php echo $vehiculo[26]." ".$vehiculo[17]." ".$vehiculo[7]?></div>
        </article>

    <?php 

        } 
    ?>
        <?php
        $n = 1;
		foreach($consultaMoto as $vehiculo) {

	?>

        <article class="libro">
            <p>Motocicleta <?php echo " ".$n++." : ";?></p>
                        <div><?php echo $vehiculo[23]." ".$vehiculo[16]." ".$vehiculo[7]?></div>
        </article>

    <?php 

        } 
    ?>
    <a href="formulario_vehiculo.php"> AÑADIR VEHÍCULO</a>
    </main>
</body>

</html>
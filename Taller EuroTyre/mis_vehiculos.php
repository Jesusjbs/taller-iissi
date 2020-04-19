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
    <form method="post" action="controlador_vehiculo.php">

    <?php
        $i = 1;
		foreach($consulta as $vehiculo) {

	?>

        <div class="botones_fila">
            <p>Coche <?php echo " ".$i++." : ";?></p>
                        <div><?php echo $vehiculo[26]." ".$vehiculo[17]." ".$vehiculo[7]?></div>
        <?php //if (isset() and ( == $vehiculo[7])
        ?>              
            <button id="borrar" name="borrar" type="submit" class="editar_fila">
			<img src="img/delete_button.png" style="width:30px;height:30px" class="editar_fila" alt="Borrar vehículo">
			</button>
        </div>

    <?php

        } 
    ?>
        <?php
        $n = 1;
		foreach($consultaMoto as $vehiculo) {

	?>

        <article class="coche">
            <p>Motocicleta <?php echo " ".$n++." : ";?></p>
                        <div><?php echo $vehiculo[23]." ".$vehiculo[16]." ".$vehiculo[7]?></div>
        </article>

    <?php 

        } 
    ?>
    <a href="formulario_vehiculo.php"> AÑADIR VEHÍCULO</a>
    </form>
    </main>
</body>

</html>
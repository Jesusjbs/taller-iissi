<?php
	session_start();

	require_once("../Otros/gestionBD.php");
    require_once("../VehiculoCL/gestionarVehiculo.php");
    
    if(!isset($_SESSION["login"])) {
        Header("Location: ../Otros/login.php");	
    }

    if(isset($_SESSION["vehiculo"])) {
      unset($_SESSION["vehiculo"]);
    }
        $conexion = crearConexionBD();

        $coches = consultaCoche($conexion,$_SESSION["login"]);
        $motos = consultaMoto($conexion,$_SESSION["login"]);

        cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="#" />
    <title>Selecciona vehículo</title>
  </head>

  <body>
    <?php
    include_once("../Otros/cabecera.php");
    ?>
    <main>
      <form id="id_selecVehiculo" method="post" action="consulta.php">
        <h1>Selecciona un vehiculo</h1>
        <fieldset id="id_campo">
          <select id="id_vehiculo" name="vehiculo">
            <optgroup label="COCHES">
              <?php foreach($coches as $coche) { ?>
              <option value="<?php echo $coche[7] ?>">
                <?php echo $coche[26] .  ' '; echo $coche[17] . ' ('; echo $coche[7] . ')'?></option>
              <?php } ?>
            </optgroup>
            
            <optgroup label="MOTOCICLETAS">
              <?php foreach($motos as $moto) { ?>
              <option value="<?php echo $moto[7] ?>">
                <?php echo $moto[23] . ' '; echo $moto[16] . ' ('; echo $moto[7] . ')'?></option>
              <?php } ?>
            </optgroup>
          </select>
          <button id="id_enviar" type="submit">Seleccionar</button>
        </fieldset>
      </form>
    </main>
  </body>
</html>

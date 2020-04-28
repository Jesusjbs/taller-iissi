<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
    if(!isset($_SESSION["login"])){
        Header("Location: ../Otros/login.php");	
    }

    if (!isset($_SESSION['registro'])) {
		$registro['tipo'] = "COCHE";
		$registro['furgoneta'] = 0;
        $registro['modelo'] = "";
		$registro['matricula'] = "";
		$registro['color'] = "";
	
		$_SESSION['registro'] = $registro;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$registro = $_SESSION['registro'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Registro Vehículo</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_nosotros.css" />

    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="apple-touch-icon" href="../img/logo.png>
</head>

<body>
    <?php  include_once("../Otros/cabecera.php");
        if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
    ?>
    <h1>Registro de vehículo</h1>
    <p>* Obligatorio</p>

    <form id="id_regVehiculo" method="post" action="validacion_vehiculo.php" novalidate>
        <fieldset>
            <div>
                <input id="id_tipo1" type="radio" name="tipo" value="COCHE" <?php if($registro["tipo"]=="COCHE") echo ' checked '; ?>/>
                <label for="id_tipo1">Coche</label>
            </div>

            <div>
                <input id="id_tipo2" type="radio" name="tipo" value="MOTO" <?php if($registro["tipo"]=="MOTO") echo ' checked '; ?>/>
                <label for=="id_tipo2">Moto</label>
            </div>
            <div>
                <input id="id_tipo1.1" type="checkbox" name="furgoneta" />
                <label for="id_tipo1.1">Furgoneta</label>
            </div>
            <div>
                <label for="id_modelo">Vehículo*:</label>
                <select id="id_modelo" name="modelo"> 
                    <?php 
                    require_once("../Otros/gestionBD.php");
                    require_once("gestionarVehiculo.php");
                    $conexion = crearConexionBD();
                    $marcas = consultaMarcas($conexion);
                   
                    foreach($marcas as $marca) {
                      ?>
                      
                      <optgroup label="<?php echo $marca[1] ?>">
                      <?php 
                        $modelosC = consultaMC($conexion, $marca[0]);
                        $modelosM = consultaMM($conexion, $marca[0]);
                        
                        foreach($modelosC as $modeloC) {
                            ?>
                            <option value="<?php echo $modeloC[0] . ' '; echo $modeloC[1] ?>">
                            <?php echo $modeloC[1] ?></option>
                        <?php }

                        foreach($modelosM as $modeloM) {
                            ?>
                            <option value="<?php echo $modeloM[0] . ' '; echo $modeloM[1] ?>">
                            <?php echo $modeloM[1] ?></option>
                        <?php }
                      ?>
                      </optgroup>
                    <?php } 
                    cerrarConexionBD($conexion);
                    ?>

                </select>
            </div>
            <div>
                <label for="id_matricula">Matrícula*:</label>
                <input id="id_matricula" name="matricula" type="text" value="<?php echo $registro['matricula'];?>" required />
            </div>
            <div>
                <label for="id_color">Color:</label>
                <input id="id_color" name="color" type="text" value="<?php echo $registro['color'];?>" />
            </div>

            <button id="id_enviar" type="submit">Registrar</button>

        </fieldset>
    </form>

    <body>

</html>
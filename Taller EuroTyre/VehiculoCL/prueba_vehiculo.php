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
        unset($_SESSION["errores"]);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">

    <title>Registro Vehículo</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/#" />

    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="apple-touch-icon" href="../img/logo.png">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
            $('#id_tipo2').click(function() {
                $('#id_tipo3').prop("disabled", true);
            });

            $('#id_tipo1').click(function() {
                $('#id_tipo3').removeAttr('disabled');
            });

			// EJERCICIO 4: Uso de AJAX con JQuery para cargar de manera asíncrona los municipios según la provincia seleccionada
			// Manejador de evento sobre el campo de provincias
			$("#id_marca").on("change", function() {
				// Llamada AJAX con JQuery, pasándole el valor de la provincia como parámetro
				$.get("jsp.php", { marcaModelo : $("#id_marca").val()}, function(data) {
					// Borro los municipios que hubiera antes en el datalist
					$("#opcionesModelos").empty();
					// Adjunto al datalist la lista de municipios devuelta por la consulta AJAX
					$("#opcionesModelos").append(data);
				});
			});
		});
	</script>
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

    <div id="id_divVehiculo">
    <form id="id_regVehiculo" method="post" action="validacion_vehiculo.php" novalidate>
        <fieldset id="id_campo">
            <h1>Registro de vehículo</h1>
            <p id="id_obligatorio">* Obligatorio</p>
            <div id="id_cocheBtn">
                <input id="id_tipo1" type="radio" name="tipo" value="COCHE" <?php if($registro["tipo"]=="COCHE") echo ' checked '; ?>/>
                <label for="id_tipo1">Coche</label>
            </div>

            <div id = "id_motoBtn">
                <input id="id_tipo2" type="radio" name="tipo" value="MOTO" <?php if($registro["tipo"]=="MOTO") echo ' checked '; ?>/>
                <label for="id_tipo2">Moto</label>
            </div>
            <br />
            <div id="id_furgonetaBtn">
                <input id="id_tipo3" type="checkbox" name="furgoneta" />
                <label for="id_tipo3">Furgoneta</label>
            </div>
            <br />
            <div class="div">
                <label id = "id_distancia" for="id_marca">Marca*:</label>
                <div class="campo"> 
                <select id="id_marca" name="marca"> 
                    <?php 
                    require_once("../Otros/gestionBD.php");
                    require_once("gestionarVehiculo.php");
                    $conexion = crearConexionBD();
                    $marcas = consultaMarcas($conexion);
                   
                    foreach($marcas as $marca) {
                        echo "<option label='" . $marca[1] . "' value='" . $marca[0] . "'>";
                    }
                        $modelosC = consultaMC($conexion, $marca[0]);
                        $modelosM = consultaMM($conexion, $marca[0]);
                    ?>
                    </select>
                    <br />
                    <label for="id_modelo">Modelo*:</label>
                    <select id="id_modelo">
                    <optgroup id="opcionesModelos">

                    </optgroup>
                    </select>
                    </div>
                    <div>
                  <!-- <select>
                   <?php
                    foreach($modelosM as $modeloM) {
                        ?>
                        <option value="<?php echo $modeloM[0] . ' '; echo $modeloM[1] ?>">
                        <?php echo $modeloM[1] ?></option>
                    <?php }
                    ?>
                    </select> -->
                    <?php
                    cerrarConexionBD($conexion);
                    ?>

                </select>
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_matricula">Matrícula*:</label>
                <div class="campo">
                <input id="id_matricula" name="matricula" type="text" value="<?php echo $registro['matricula'];?>" required />
                </div>
            </div>
            <br />
            <div class="div">
                <label for="id_color">Color:</label>
                <div class="campo">
                <input id="id_color" name="color" type="text" value="<?php echo $registro['color'];?>" />
                </div>
            </div>
            <br />
            <button id="id_enviar" type="submit">Registrar</button>

        </fieldset>
    </form>
    </div>
    </body>

</html>
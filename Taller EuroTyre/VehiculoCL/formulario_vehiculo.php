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
    <link rel="stylesheet" type="text/css" href="../css/style_form_vehiculo.css" />

    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="apple-touch-icon" href="../img/logo.png">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script>
        // Inicialización de elementos y eventos cuando el documento se carga completamente
        $(document).ready(function () {
            //Inicialmente los campos de moto de moto están oculto, ya que tenemos el checked en coche
            $('#campoMoto').hide();

            //Inicialmente rellenamos los campo de marca y modelos de coches (para que salgan en la marca predeterminada un modelo)
            $.get("Vehiculo_AJAX.php", { marcaModeloC: $("#id_marcaC").val() }, function (data) {
                // Borro los modelos de coches que hubiera antes en el optgroup
                $("#opcionesModelosC").empty();
                // Adjunto al optgroup la lista de modelos de coches devuelta por la consulta AJAX
                $("#opcionesModelosC").append(data);
            });

            //Inicialmente rellenamos los campo de marca y modelos de motos (para que salgan en la marca predeterminada un modelo)
            $.get("Vehiculo_AJAX.php", { marcaModeloM: $("#id_marcaM").val() }, function (data) {
                // Borro los modelos de motos que hubiera antes en el opgroup
                $("#opcionesModelosM").empty();
                // Adjunto al optgroup la lista de modelos de motos devuelta por la consulta AJAX
                $("#opcionesModelosM").append(data);
            });

            //Inicialmente está marcado coche, por tanto desabilitamos los select de marca y modelo de motos (para que así no se envíen)
            $('#id_marcaM').prop("disabled", true);
            $('#id_modeloM').prop("disabled", true);

            //Al seleccionar tipo moto, ocultamos el divisor de coche y desabilitamos y habilitamos los campos correspondientes 
            //(furgoneta-> off, campoCoche-> oculto, campoMoto-> visible, marcaCoche-> off, modeloCoche-> off, marcaMoto-> on, modeloMoto-> on)
            $('#id_tipo2').click(function () {
                $('#id_tipo3').prop("disabled", true);
                $('#campoCoche').hide();
                $('#campoMoto').show();
                $('#id_marcaM').removeAttr('disabled');
                $('#id_modeloM').removeAttr('disabled');
                $('#id_marcaC').prop("disabled", true);
                $('#id_modeloC').prop("disabled", true);
            });
            
            //Al seleccionar tipo coche, ocultamos el divisor de moto y desabilitamos y habilitamos los campos correspondientes 
            //(furgoneta-> on, campoCoche-> visible, campoMoto-> oculto, marcaCoche-> on, modeloCoche-> on, marcaMoto-> off, modeloMoto-> off)
            $('#id_tipo1').click(function () {
                $('#id_tipo3').removeAttr('disabled');
                $('#campoMoto').hide();
                $('#campoCoche').show();
                $('#id_marcaC').removeAttr('disabled');
                $('#id_modeloC').removeAttr('disabled');
                $('#id_marcaM').prop("disabled", true);
                $('#id_modeloM').prop("disabled", true);
            });

            // Manejador de evento sobre el campo de marca
            $("#id_marcaC").on("change", function () {
                // Llamada AJAX con JQuery, pasándole el OID de la marca seleccionada
                $.get("Vehiculo_AJAX.php", { marcaModeloC: $("#id_marcaC").val() }, function (data) {
                // Borro los modelos de coches que hubiera antes en el optgroup
                $("#opcionesModelosC").empty();
                // Adjunto al optgroup la lista de modelos de coches devuelta por la consulta AJAX
                $("#opcionesModelosC").append(data);
                });
            });

            $("#id_marcaM").on("change", function () {
                // Llamada AJAX con JQuery, pasándole el OID de la marca seleccionada
                $.get("Vehiculo_AJAX.php", { marcaModeloM: $("#id_marcaM").val() }, function (data) {
                // Borro los modelos de motos que hubiera antes en el optgroup
                $("#opcionesModelosM").empty();
                // Adjunto al optgroup la lista de modelos de motos devuelta por la consulta AJAX
                $("#opcionesModelosM").append(data);
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
        <form id="id_regVehiculo" method="post" action="validacion_vehiculo.php">
            <fieldset id="id_campo">
                <h1>Registro de vehículo</h1>
                <p id="id_obligatorio">* Obligatorio</p>
                <div id="id_cocheBtn">
                    <input id="id_tipo1" type="radio" name="tipo" value="COCHE" checked />
                    <label for="id_tipo1">Coche</label>
                </div>

                <div id="id_motoBtn">
                    <input id="id_tipo2" type="radio" name="tipo" value="MOTO" />
                    <label for="id_tipo2">Moto</label>
                </div>
                <br />
                <div id="id_furgonetaBtn">
                    <input id="id_tipo3" type="checkbox" name="furgoneta" />
                    <label for="id_tipo3">Furgoneta</label>
                </div>
                <div class="div">
                    <br />
                    <!-- CAMPOS DE COCHE -->
                    <div id="campoCoche">
                        <label for="id_marcaC">Marca*:</label>
                        <select id="id_marcaC" name="marca">
                    <?php 
                    require_once("../Otros/gestionBD.php");
                    require_once("gestionarVehiculo.php");
                    $conexion = crearConexionBD();
                    $marcasCoche = consultarMarcasCoches($conexion);

                    foreach($marcasCoche as $marca) {
                        echo "<option label='" . $marca[0] . "' value='" . $marca[1] . "'>";
                    }
                    ?>
                        </select>
                        <br /><br />
                        <label for="id_modeloC">Modelo*:</label>
                        <select id="id_modeloC" name="modelo">
                            <optgroup label="MODELOS" id="opcionesModelosC">
                                <!-- AJAX -->
                            </optgroup>
                        </select>
                        <br /><br />
                    </div>
                    <!-- CAMPOS DE MOTO -->
                    <div id="campoMoto">
                        <label for="id_marcaM">Marca*:</label>
                        <select id="id_marcaM" name="marca">
                    <?php 
                    $marcasMotos = consultarMarcasMotos($conexion);

                    foreach($marcasMotos as $marca) {
                        echo "<option label='" . $marca[0] . "' value='" . $marca[1] . "'>";
                    }
                    ?>
                        </select>
                        <br /><br />
                        <label for="id_modeloM">Modelo*:</label>
                        <select id="id_modeloM" name="modelo">
                            <optgroup label="MODELOS" id="opcionesModelosM">
                                <!-- AJAX -->
                            </optgroup>
                        </select>
                        <?php
                    cerrarConexionBD($conexion);
                    ?><br /><br />
                    </div>
                </div>
                <div class="div">
                    <label for="id_matricula">Matrícula*:</label>
                    <div class="campo">
                        <input id="id_matricula" name="matricula" type="text" pattern="^[0-9]{4}[A-Z]{3}$"
                            value="<?php echo $registro['matricula'];?>" required />
                    </div>
                </div>
                <br />
                <div class="div">
                    <label for="id_color">Color:</label>
                    <div class="campo">
                        <input id="id_color" name="color" type="text" pattern="[a-zA-ZÑñáéíó ú]{0,50}" value="<?php echo $registro['color'];?>" />
                    </div>
                </div>
                <br />
                <button id="id_enviar" type="submit">Registrar</button>

            </fieldset>
        </form>
    </div>
</body>

</html>
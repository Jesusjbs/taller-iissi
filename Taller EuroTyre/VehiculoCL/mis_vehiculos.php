<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarVehiculo.php");

		if(!isset($_SESSION["login"])){
			Header("Location: ../Otros/login.php");	
			
		}else{
            if(isset($_SESSION["coche"])){
                $coche = $_SESSION["coche"];
                unset($_SESSION["coche"]);
            }

            if(isset($_SESSION["moto"])){
                $moto = $_SESSION["moto"];
                unset($_SESSION["moto"]);
            }

            if(isset($_SESSION["errores"])){
                $errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }

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
    <link rel="stylesheet" type="text/css" href="../css/style_mis_vehiculos.css" />
    <title>Mis vehículos</title>
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

    <main>
        
        <?php
        $i = 1;
		foreach($consulta as $vehiculo) {
	    ?>
        <div class="id_coche">
        <article class="coche">
            <form method="post" action="controlador_coche.php">
                <div class="fila_vehiculo">
                    <div class="dato_vehiculo">

                        <input name="matricula" type="hidden" value="<?php echo $vehiculo[7];?>" />
                        <input name="color" type="hidden" value="<?php  echo $vehiculo[8];?>" />
                        <input name="kilometraje" type="hidden"
                            value="<?php  echo $vehiculo[9];?>" />
                        <input name="proxITV" type="hidden" value="<?php  echo $vehiculo[10];?>" />
                        <input name="numBastidor" type="hidden"
                            value="<?php  echo $vehiculo[11];?>" />
                        
                        <?php
                if(isset($coche) and ($coche["matricula"] == $vehiculo[7])){ 
                    $objFechaITV = date_create_from_format('d/m/y', $vehiculo[10]);
                    ?>
                        <h2>Coche en edición...</h2>
                        <table>
                            <tr>
                                <td>Marca:</td>
                                <td><?php echo $vehiculo[26];?></td>
                            </tr>
                            <tr>
                                <td>Modelo:</td>
                                <td><?php echo $vehiculo[17];?></td>
                            </tr>
                            <tr>
                                <td>Matrícula:</td>
                                <td><?php echo $vehiculo[7];?></td>
                            </tr>
                            <tr>
                                <td>Color:</td>
                                <td><input class="campo" name="color" type="text" value="<?php echo $vehiculo[8];?>" /></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td> <input class="campo" name="kilometraje" type="text" value="<?php echo $vehiculo[9];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><input class="campo" name="numBastidor" type="text" value="<?php  echo $vehiculo[11];?>" /></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><input class="campo" name="proxITV" type="date" value="<?php echo $objFechaITV->format('Y-m-d') ; ?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                            <h2>Coche <?php echo " ".$i;?></h2>
                            <table>
                            <tr>
                                <td>Marca:</td>
                                <td><?php echo $vehiculo[26];?></td>
                            </tr>
                            <tr>
                                <td>Modelo:</td>
                                <td><?php echo $vehiculo[17];?></td>
                            </tr>
                            <tr>
                                <td>Matrícula:</td>
                                <td><?php echo $vehiculo[7];?></td>
                            </tr>
                            <tr>
                                <td>Color:</td>
                                <td><?php echo $vehiculo[8];?></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td><?php echo $vehiculo[9];?></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><?php echo $vehiculo[11];?></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><?php echo $vehiculo[10];?></td>
                            </tr>
                        </table><br />
                        
                        <?php 
                        $i++;
                    } ?>
                    </div>

                    <div class="id_botonesCoches">
                        <?php
                if(isset($coche) and ($coche["matricula"] == $vehiculo[7])){ ?>
                        <!-- Botón de grabar -->
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button name="editar" type="submit" class="editar_fila">
                            <img src="../img/edite_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar coche">
                        </button>
                        <?php } ?>
                        <button name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar coche">
                        </button><br /><br />
                        
                    </div>
                </div>
            </form>
        </article>
        </div>
        <?php }
        $n = 1;
		foreach($consultaMoto as $vehiculo) {?>
        <div class="id_moto">
        <article class="moto">
            <form method="post" action="controlador_moto.php">
                <div class="fila_vehiculo_moto">
                    <div class="dato_vehiculo_moto">

                        <input name="matricula" type="hidden" value="<?php echo $vehiculo[7];?>" />
                        <input name="color" type="hidden" value="<?php  echo $vehiculo[8];?>" />
                        <input name="kilometraje" type="hidden"
                            value="<?php  echo $vehiculo[9];?>" />
                        <input name="proxITV" type="hidden" value="<?php  echo $vehiculo[10];?>" />
                        <input id="id_numBastidorM" name="numBastidor" type="hidden"
                            value="<?php  echo $vehiculo[11];?>" />
                        
                        <?php
                if(isset($moto) and ($moto["matricula"] == $vehiculo[7])){ ?>
                    <h2>Moto en edición...</h2>
                        <table>
                            <tr>
                                <td>Marca:</td>
                                <td><?php echo $vehiculo[23];?></td>
                            </tr>
                            <tr>
                                <td>Modelo:</td>
                                <td><?php echo $vehiculo[16];?></td>
                            </tr>
                            <tr>
                                <td>Matrícula:</td>
                                <td><?php echo $vehiculo[7];?></td>
                            </tr>
                            <tr>
                                <td>Color:</td>
                                <td><input class="campo" name="color" type="text" value="<?php echo $vehiculo[8];?>" /></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td> <input class="campo" name="kilometraje" type="text" value="<?php echo $vehiculo[9];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><input class="campo" name="numBastidor" type="text" value="<?php  echo $vehiculo[11];?>" /></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><input class="campo" name="proxITV" type="date" value="<?php  echo $vehiculo[10];?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $n++ ;} else { ?>
                            <h2>Moto <?php echo " ".$n;?></h2>
                            <table>
                            <tr>
                                <td>Marca:</td>
                                <td><?php echo $vehiculo[23];?></td>
                            </tr>
                            <tr>
                                <td>Modelo:</td>
                                <td><?php echo $vehiculo[16];?></td>
                            </tr>
                            <tr>
                                <td>Matrícula:</td>
                                <td><?php echo $vehiculo[7];?></td>
                            </tr>
                            <tr>
                                <td>Color:</td>
                                <td><?php echo $vehiculo[8];?></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td><?php echo $vehiculo[9];?></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><?php echo $vehiculo[11];?></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><?php echo $vehiculo[10];?></td>
                            </tr>
                        </table><br />
                        
                        <?php 
                        $n++;
                    } ?>
                    </div>
                </div>
                    <div class="id_botonesMotos">
                        <?php
                if(isset($moto) and ($moto["matricula"] == $vehiculo[7])){ ?>
                        <!-- Botón de grabar -->
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button name="editar" type="submit" class="editar_fila">
                            <img src="../img/edite_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar moto">
                        </button>
                        <?php } ?>
                        <button  id = "id_editar" name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar moto">
                        </button><br /><br />
                        
                    </div>
                </div>
            </form>
        </article>
        </div>
        
        <?php }?>
                        
        <div id="id_mas">
            <a id="id_añadir" href="formulario_vehiculo.php"><img style="width: 40px; height: 40px;" src="../img/add_button.png"
                class="añadir_Vehiculo" alt="Añadir Vehículo"></a>
        </div>
    </main>
</body>

</html>
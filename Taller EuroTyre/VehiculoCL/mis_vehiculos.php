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
    include_once("../Otros/cabecera.php");
    ?>

    <main>
        <?php
        $i = 1;
		foreach($consulta as $vehiculo) {

	    ?>

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
                if(isset($coche) and ($coche["matricula"] == $vehiculo[7])){ ?>
                        <table>
                            <tr>
                                <th>Coche en edición...</th>
                                <td></td>
                            </tr>
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
                                <td><input id="id_color" name="color" type="text" value="<?php echo $vehiculo[8];?>" /></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td> <input id="id_kilometraje" name="kilometraje" type="text" value="<?php echo $vehiculo[9];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><input id="id_numBastidor" name="numBastidor" type="text" value="<?php  echo $vehiculo[11];?>" /></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><input id="id_proxITV" name="proxITV" type="date" value="<?php echo $vehiculo[10];?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                        
                            <table>
                            <tr>
                                <td><h2>Coche <?php echo " ".$i;?></h2></td>
                                <td></td>
                            </tr>
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
        <?php }
        $n = 1;
		foreach($consultaMoto as $vehiculo) {?>

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
                        <table>
                            <tr>
                                <td><h2>Moto en edición...</h2></td>
                                <td></td>
                            </tr>
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
                                <td><input id="id_color" name="color" type="text" value="<?php echo $vehiculo[8];?>" /></td>
                            </tr>
                            <tr>
                                <td>Kilometraje:</td>
                                <td> <input id="id_kilometraje" name="kilometraje" type="text" value="<?php echo $vehiculo[9];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nº Bastidor:</td>
                                <td><input id="id_numBastidor" name="numBastidor" type="text" value="<?php  echo $vehiculo[11];?>" /></td>
                            </tr>
                            <tr>
                                <td>Prox. ITV:</td>
                                <td><input id="id_proxITV" name="proxITV" type="date" value="<?php  echo $vehiculo[10];?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $n++ ;} else { ?>
                        
                            <table>
                            <tr>
                                <th><Moto <?php echo " ".$n;?>></th>
                                <td></td>
                            </tr>
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
                        <button name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar moto">
                        </button><br /><br />
                        
                    </div>
                </div>
            </form>
        </article>
        <?php }?>

        <a href="formulario_vehiculo.php"><img style="width: 30px; height: 30px;" src="../img/add_button.png"
                class="añadir_Vehiculo" alt="Añadir Vehículo"></a>

    </main>
</body>

</html>
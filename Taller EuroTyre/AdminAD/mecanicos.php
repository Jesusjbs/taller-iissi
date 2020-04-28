<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("gestionarAdmin.php");

		if(!isset($_SESSION["admin"])){
			Header("Location: ../Otros/login.php");	
			
		}else{
            if(isset($_SESSION["mec"])){
                $mec = $_SESSION["mec"];
                unset($_SESSION["mec"]);
            }
            

            $conexion = crearConexionBD();
            $esJefe = esJefe($conexion, $_SESSION["admin"]);
            $consulta = infoMecanicos($conexion);

			cerrarConexionBD($conexion);
		}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Plantilla de EuroTyre</title>
</head>

<body>

    <?php
    include_once("../Otros/cabeceraAdmin.php");
    ?>

    <main>
        <h1>Plantilla</h1>
        <?php
        $i = 1;
		foreach($consulta as $mecanico) {
	    ?>
        <article class="mecanico">
        <form method="post" action="controlador_mecanico.php">
                <div class="fila_mecanico">
                    <div class="dato_mecanico">
                        <input id="id_dni" name="dni" type="hidden" value="<?php echo $mecanico[0];?>" />
                        <input id="id_nombre" name="nombre" type="hidden" value="<?php  echo $mecanico[1];?>" />
                        <input id="id_apellido" name="apellido" type="hidden" value="<?php  echo $mecanico[2];?>" />
                        <input id="id_Especialidad" name="Especialidad" type="hidden" value="<?php  echo $mecanico[3];?>" />
                        <input id="id_jefe" name="jefe" type="hidden" value="<?php  echo $mecanico[4];?>" />
                        <input id="id_constraseña" name="contraseña" type="hidden" value="<?php  echo $mecanico[5];?>" />
                        <?php
                if(isset($mec) and ($mec["dni"] == $mecanico[0])){ ?>
                        <table>
                            <tr>
                                <th><h2>Trabajador en edición...</h2></th>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td><input id="id_dni" name="dni" type="text" value="<?php echo $mecanico[0];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><input id="id_nombre" name="nombre" type="text" value="<?php echo $mecanico[1];?>" /></td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td><input id="id_apellido" name="apellido" type="text" value="<?php echo $mecanico[2];?>" /></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><input id="id_especialidad" name="Especialiad" type="text" value="<?php echo $mecanico[3];?>" /></td>
                            </tr>
                            <tr>
                                <td>Jefe:</td>
                                <td> <input id="id_jefe" name="jefe" type="text" value="<?php echo $mecanico[4];?>" /></td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td><input id="id_contraseña" name="contraseña" type="text" value="<?php  echo $mecanico[5];?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                        
                    <table>
                            <tr>
                            <?php if($mecanico[4] == 1) { ?>
                                <th><h2>Jefe</h2></th>
                            <?php } else { ?>
                                <th><h2>Trabajador<?php echo " ".$i;?></h2></th>
                            <?php } ?>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td><?php echo $mecanico[0];?></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><?php echo $mecanico[1];?></td>
                            </tr>
                            <tr>
                                <td>Apellidos:</td>
                                <td><?php echo $mecanico[2];?></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><?php echo $mecanico[3];?></td>
                            </tr>
                        </table><br />

                        <?php 
                        $i++;
                    } ?>
                    </div>
                
                    <?php if($esJefe == 1) { ?>
                    <div class="id_botonesMecanico">
                        <?php
                    if(isset($mec) and ($mec["dni"] == $mecanico[0])) { ?>
                        <!-- Botón de grabar -->
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/edite_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar trabajador">
                        </button>
                        <?php } ?>
                        <button id="borrar" name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar trabajador">
                        </button><br /><br />
                    </div>
                        <?php } ?>
                </div>
            </form>
        </article>
    <?php } if($esJefe == 1) { ?>
        <a href="formulario_mecanico.php"><img style="width: 30px; height: 30px;" src="../img/add_button.png"
                class="añadir_mecanico" alt="Añadir Mecánico"></a>
        <?php } ?>
    </main>
</body>

</html>
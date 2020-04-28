<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("./gestionarAdmin.php");

		if(!isset($_SESSION["admin"])){
			Header("Location: ../Otros/login.php");		
        } else {
            if(isset($_SESSION["administrador"])) {
                $administrador = $_SESSION["administrador"];
                unset($_SESSION["administrador"]);
            }
            
            $conexion = crearConexionBD(); 
            $consultas = datosMecanico($conexion,$_SESSION["admin"]);
		    cerrarConexionBD($conexion);
        }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
</head>

<body>

    <?php
    include_once("../Otros/cabeceraAdmin.php");

	foreach($consultas as $consulta) {
	?>
    <article class="perfil">
            <form method="post" action="controlador_perfil.php">
                <div class="fila_usuario">
                    <div class="dato_usuario">
                        <input id="id_dni" name="dni" type="hidden" value="<?php echo $consulta[0];?>" />
                        <input id="id_nombre" name="nombre" type="hidden" value="<?php  echo $consulta[1];?>" />
                        <input id="id_apellido" name="apellido" type="hidden" value="<?php  echo $consulta[2];?>" />
                        <input id="id_especialidad" name="especialidad" type="hidden" value="<?php  echo $consulta[3];?>" />
                        <input id="id_contraseña" name="contraseña" type="hidden" value="<?php  echo $consulta[4];?>" />

                        
                        <?php
                if(isset($administrador)){ ?>
                        <table>
                            <tr>
                                <th><h2>Editando datos...</h2></th>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td><input id="id_dni" name="dni" type="text" value="<?php echo $consulta[0];?>" /></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><input id="id_nombre" name="nombre" type="text" value="<?php echo $consulta[1];?>" /></td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td><input id="id_apellido" name="apellido" type="text" value="<?php echo $consulta[2];?>" /></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><input id="id_especialidad" name="especialidad" type="text" value="<?php echo $consulta[3];?>" /></td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td><input id="id_contraseña" name="contraseña" type="password" /></td>
                            </tr>
                        </table><br />
                        
                        <?php } else { ?>
                        
                            <table>
                            <tr>
                                <th><h2>MIS DATOS</h2></th>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td><?php echo $consulta[0];?></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><?php echo $consulta[1];?></td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td><?php echo $consulta[2];?></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><?php echo $consulta[3];?></td>
                            </tr>
                            <tr> 
                                <td>Contraseña:</td>
                                <td>***********</td>
                            </tr>
                        </table><br />
                        
                        <?php 
                    } ?>
                    </div>

                    <div class="id_botonesAdministrador">
                        <?php
                if(isset($administrador)){ ?>
                        <!-- Botón de grabar -->
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/UserEdite.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar perfil">
                        </button>
                        <br /><br />
                        <?php } ?>
                    </div>
                </div>
            </form>
        </article>
    <?php } ?>
</body>
</html>
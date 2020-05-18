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

            if(isset($_SESSION["errores"])){
                $errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
			cerrarConexionBD($conexion);
		}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style_mecanicos.css" />
    <script src="../ValidacionesJS/valida_mecanicos.js"></script>
    <title>Plantilla de EuroTyre</title>
</head>

<body>
    <?php                     
        include_once("../Otros/cabecera.php");
    ?>
    <main>
        <h1>Plantilla</h1>
        <?php
        $i = 1;
		foreach($consulta as $mecanico) {
	    ?>
        <div class="mecanicos">
        <article class="mecanico">
        <form method="post" name="formulario" action="controlador_mecanico.php" onsubmit="return valida()">
                <div class="fila_mecanico">
                    <div class="dato_mecanico">
                        <input name="dni" type="hidden" value="<?php echo $mecanico[0];?>" />
                        <input name="nombre" type="hidden" value="<?php  echo $mecanico[1];?>" />
                        <input name="apellido" type="hidden" value="<?php  echo $mecanico[2];?>" />
                        <input name="Especialidad" type="hidden" value="<?php  echo $mecanico[3];?>" />
                        <input name="jefe" type="hidden" value="<?php  echo $mecanico[4];?>" />
                        <input name="contraseña" type="hidden" value="<?php  echo $mecanico[5];?>" />
                        <?php
                if(isset($mec) and ($mec["dni"] == $mecanico[0])){ 
                    ?>
                <h2>Trabajador en edición...</h2>
                <?php 
                    if (isset($errores) && count($errores)>0) { 
                        echo "<div id=\"div_errores\" class=\"error\">";
                        echo "<h4> Errores en el formulario:</h4>";
                        foreach($errores as $error) echo $error; 
                            echo "</div>";
                        }
                ?>
                        <table id="id_tabla">
                            <tr>
                                <td>DNI:</td>
                                <td><?php echo $mecanico[0];?></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><input class="campo" title="Solo debe contener letras y tener una longitud máxima de 50" 
                                    name="nombre" type="text" value="<?php echo $mecanico[1];?>" pattern="[a-zA-ZÑñáéíóú]{1,50}" required/></td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td><input class="campo" title="Solo debe contener letras y tener una longitud máxima de 50" 
                                    name="apellido" type="text" value="<?php echo $mecanico[2];?>"  pattern="[a-zA-ZÑñáéíóú]{1,50}" required/></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><input class="campo" id ="id_especialidad" name="Especialidad" type="text" value="<?php echo $mecanico[3];?>" 
                                    required oninput="this.setCustomValidity('')" /></td>
                            </tr>
                            <tr>
                                <td>Jefe:</td>
                                <?php if($mecanico[4] == 0) {
                                    $jefe = "NO";
                                } else {
                                    $jefe = "SI";
                                } ?>
                                <td><input class="campo" id="id_jefe" name="jefe" type="text" value="<?php echo $jefe;  ?>"
                                            required oninput="this.setCustomValidity('')" /></td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td><input class="campo" title="Mínimo 6 caracteres (Letra mayúscula, letra minúscula y número) y máximo 50." 
                                    name="contraseña" type="text" value="<?php  echo $mecanico[5];?>" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,50}" required/></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                            <?php if($mecanico[4] == 1) { ?>
                                <h2>Jefe</h2>
                            <?php } else { ?>
                                <h2>Trabajador<?php echo " ".$i;?></h2>
                            <?php } ?>
                        
                    <table id="id_tabla">
    
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
                        <button title="Confirmar Cambios" autofocus id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button title="Editar Trabajador" id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/UserEdite.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar trabajador">
                        </button>
                        <?php } ?>
                        <button title="Eliminar Trabajador" id="borrar" name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar trabajador">
                        </button><br /><br />
                    </div>
                        <?php } ?>
                </div>
            </form>
        </article>
        </div>
    <?php } if($esJefe == 1) { ?>
    <div id="id_mas">
        <a title="Añadir Trabajador" id="id_añadir" href="formulario_mecanico.php"><img style="width: 30px; height: 30px;" src="../img/add_button.png"
                class="añadir_mecanico" alt="Añadir Mecánico"></a>
        </div>
        <?php } ?>
    </main>
</body>

</html>
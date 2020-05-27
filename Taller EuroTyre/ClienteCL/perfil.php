<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("./gestionarUsuarios.php");

		if(!isset($_SESSION["login"])){
			Header("Location: ../Otros/login.php");		
        } else {
            if(isset($_SESSION["cliente"])) {
                $cliente = $_SESSION["cliente"];
                unset($_SESSION["cliente"]);
            }
            
            $conexion = crearConexionBD(); 
            $consultas = datosCliente($conexion,$_SESSION["login"]);
		    cerrarConexionBD($conexion);            
        }

        if (isset($_SESSION["errores"])) {
            $errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" type="text/css" href="../css/style_perfilCL.css" />
</head>

<body>

    <?php
    include_once("../Otros/cabecera.php");

    if (isset($errores) && count($errores)>0) { 
        echo "<div id=\"div_errores\" class=\"error\">";
        echo "<h4> Errores al editar perfil:</h4>";
        foreach($errores as $error) echo $error; 
        echo "</div>";
    }

	foreach($consultas as $consulta) {
    ?>
    <article class="perfil">
            <form method="post" action="controlador_perfil.php">
                <div class="fila_usuario">
                    <div class="dato_usuario">
                        <input name="dni" type="hidden" value="<?php echo $consulta[0];?>" />
                        <input name="nombre" type="hidden" value="<?php  echo $consulta[1];?>" />
                        <input name="apellidos" type="hidden" value="<?php  echo $consulta[2];?>" />
                        <input name="telefono" type="hidden" value="<?php  echo $consulta[3];?>" />
                        <input name="email" type="hidden" value="<?php  echo $consulta[4];?>" />
                        <input name="direccion" type="hidden" value="<?php  echo $consulta[5];?>" />
                        <input name="contraseña" type="hidden" value="<?php  echo $consulta[6];?>" />
                        
                        <?php
                if(isset($cliente)){ ?>
                        <h2 id="id_editando">Editando datos...</h2>
                        <table id="id_tableEdit">
                            <tr>
                                <td>DNI:</td>
                                <td><?php echo $consulta[0];?></td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><input class="campo" title="Solo debe contener letras y tener una longitud máximo 50" name="nombre"
                                 type="text" value="<?php echo $consulta[1];?>" pattern="[a-zA-ZÑñáé íóú]{1,50}" required /></td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td><input class="campo" title="Solo debe contener letras y tener una longitud máximo 50" name="apellidos"
                                 type="text" value="<?php echo $consulta[2];?>" pattern="[a-zA-ZÑñ áéíóú]{1,50}" required /></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td><input class="campo" title="Nueve dígitos" name="telefono" type="text" value="<?php echo $consulta[3];?>"
                                pattern="^[0-9]{9}" required /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input class="campo" name="email" type="email" value="<?php echo $consulta[4];?>" maxlength="50" /></td>
                            </tr>
                            <tr>
                                <td>Dirección:</td>
                                <td><input class="campo" title="Solo debe contener letras y dígitos y tene una longitud máxima de 50" name="direccion"
                                 type="text" value="<?php  echo $consulta[5];?>" pattern="[a-zA-ZÑñºá éíóú0-9]{0,50}" /></td>
                            </tr>
                            <tr>
                                <td>Antigua contraseña:</td>
                                <td><input class="campo" name="antigua" type="password" /></td>
                            </tr>
                            <tr>
                                <td>Nueva contraseña:</td>
                                <td><input class="campo" name="contraseña" type="password" /></td>
                            </tr>
                            <tr>
                                <td>Confirmar nueva contraseña:</td>
                                <td><input class="campo" name="confirmar" type="password" /></td>
                            </tr>
                        </table><br />
                        
                        <?php } else { ?>
                            <h2 id="id_misDatos">MIS DATOS</h2>
                            <table id="id_table">
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
                                <td>Teléfono:</td>
                                <td><?php echo $consulta[3];?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $consulta[4];?></td>
                            </tr>
                            <tr>
                                <td>Dirección:</td>
                                <td><?php echo $consulta[5];?></td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td>***********</td>
                            </tr>
          
                        </table><br />
                        
                        <?php 
                    } ?>
                    </div>

                    <div class="id_botonesClientes">
                        <?php
                if(isset($cliente)){ ?>
                        <!-- Botón de grabar -->
                        <button title="Confirmar Cambios" id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button title="Editar Perfil" id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/UserEdite.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar perfil">
                        </button>
                        <br /><br />
                        <?php } ?>
                    </div>
                </div>
            </form>
        </article>
    <?php } 
			include_once("../Otros/validacion.html");
	?>
</body>
</html>
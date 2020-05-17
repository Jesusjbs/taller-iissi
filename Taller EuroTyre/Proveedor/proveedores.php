<?php
	session_start();

	require_once("../Otros/gestionBD.php");
    require_once("../AdminAd/gestionarAdmin.php");
    require_once("gestionarProveedor.php");

		if(!isset($_SESSION["admin"])){
			Header("Location: ../Otros/login.php");	
			
		}else{
            if(isset($_SESSION["prov"])){
                $prov = $_SESSION["prov"];
                unset($_SESSION["prov"]);
            }
            

            $conexion = crearConexionBD();
            $esJefe = esJefe($conexion, $_SESSION["admin"]);
            $consulta = consultaProveedores($conexion);

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
    <link rel="stylesheet" type="text/css" href="../css/style_proveedores.css" />
    <script src="../ValidacionesJS/valida_proveedor.js" type="text/javascript"></script>
    <title>Proveedores de EuroTyre</title>
</head>

<body>

    <?php
    include_once("../Otros/cabecera.php");
    ?>

    <main>
        <h1>Proveedores de EuroTyre</h1>
        <?php
        $i = 1;
		foreach($consulta as $proveedor) {
        ?>

        <article class="proveedor">
        <form method="post" action="controlador_proveedor.php" onsubmit="return valida()">
                <div class="fila_proveedor">
                    <div class="dato_proveedor">
                        <input name="oid_p" type="hidden" value="<?php echo $proveedor[0];?>" />
                        <input name="nombre" type="hidden" value="<?php echo $proveedor[2];?>" />
                        <input name="tipoProveedor" type="hidden" value="<?php  echo $proveedor[1];?>" />
                        <input name="email" type="hidden" value="<?php  echo $proveedor[3];?>" />
                        <input name="telefono" type="hidden" value="<?php  echo $proveedor[4];?>" />
                        <?php
                            if(isset($prov) and ($prov["oid_p"] == $proveedor[0])){ 
                        ?>
                        <h2>Proveedor en edición...</h2>
                        <?php
                            if (isset($errores) && count($errores)>0) { 
                                echo "<div id=\"div_errores\" class=\"error\">";
                                echo "<h4> Errores en el formulario:</h4>";
                                foreach($errores as $error) echo $error; 
                                    echo "</div>";
                            }
                        ?>
                        <table>
                            <tr>
                                <td>Nombre:</td>
                                <td><input class="campo" title="Sólo letras mayúsculas o minúsculas" name="nombre" type="text" 
                                value="<?php echo $proveedor[2];?>" pattern="[a-zA-ZÑñáéíóú]+" required /></td>
                            </tr>
                            <tr>
                                <td>Tipo de Proveedor:</td>
                                <td><input class="campo" id="id_tipo" name="tipoProveedor" type="text" 
                                    value="<?php echo $proveedor[1];?>" required oninput="this.setCustomValidity('')" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input class="campo" name="email" type="email" value="<?php echo $proveedor[3];?>" maxlength="50"/></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td><input class="campo" title="Debe contener 9 dígitos" name="telefono" type="text" 
                                value="<?php echo $proveedor[4];?>" pattern="^[0-9]{9}" required/></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                    <h2>Proveedor<?php echo " ".$i;?></h2>
                    <table>
                            <tr>
                                <td>Nombre:</td>
                                <td><?php echo $proveedor[2];?></td>
                            </tr>
                            <tr>
                                <td>Tipo de Proveedor:</td>
                                <td><?php echo $proveedor[1];?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $proveedor[3];?></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td><?php echo $proveedor[4];?></td>
                            </tr>
                        </table><br />

                        <?php 
                        $i++;
                    } ?>
                    </div>
                
                    <?php if($esJefe == 1) { ?>
                    <div class="id_botonesProveedor">
                        <?php
                    if(isset($prov) and ($prov["oid_p"] == $proveedor[0])) { ?>
                        <!-- Botón de grabar -->
                        <button autofocus id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/edit.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar proveedor">
                        </button>
                        <?php } ?>
                        <button id="borrar" name="borrar" type="submit" class="editar_fila">
                            <img src="../img/delete_button.jpg" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Borrar proveedor">
                        </button><br /><br />
                    </div>
                        <?php } ?>
                </div>
            </form>
        </article>
    <?php } ?>
    <?php  if($esJefe == 1) { ?>
        <div id="id_mas">
        <a href="formulario_proveedor.php"><img style="width: 30px; height: 30px;" src="../img/add_button.png"
                class="añadir_proveedor" alt="Añadir Proveedor"></a>
    </div>
        <?php } ?>
    </main>
</body>
</html>
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

			cerrarConexionBD($conexion);
		}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Proveedores de EuroTyre</title>
</head>

<body>

    <?php
    include_once("../Otros/cabeceraAdmin.php");
    ?>

    <main>
        <h1>Proveedores de EuroTyre</h1>
        <?php
        $i = 1;
		foreach($consulta as $proveedor) {
	    ?>
        <article class="proveedor">
        <form method="post" action="controlador_proveedor.php">
                <div class="fila_proveedor">
                    <div class="dato_proveedor">
                        <input id="id_oidP" name="oid_p" type="hidden" value="<?php echo $proveedor[0];?>" />
                        <input id="id_nombre" name="nombre" type="hidden" value="<?php echo $proveedor[2];?>" />
                        <input id="id_tipoProveedor" name="tipoProveedor" type="hidden" value="<?php  echo $proveedor[1];?>" />
                        <input id="id_email" name="email" type="hidden" value="<?php  echo $proveedor[3];?>" />
                        <input id="id_telefono" name="telefono" type="hidden" value="<?php  echo $proveedor[4];?>" />
                        <?php
                if(isset($prov) and ($prov["oid_p"] == $proveedor[0])){ ?>
                        <table>
                            <tr>
                                <th><h2>Proveedor en edición...</h2></th>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td><input id="id_nombre" name="nombre" type="text" value="<?php echo $proveedor[2];?>" /></td>
                            </tr>
                            <tr>
                                <td>Tipo de Proveedor:</td>
                                <td><input id="id_tipoProveedor" name="tipoProveedor" type="text" value="<?php echo $proveedor[1];?>" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input id="id_email" name="email" type="text" value="<?php echo $proveedor[3];?>" /></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td><input id="id_telefono" name="telefono" type="text" value="<?php echo $proveedor[4];?>" /></td>
                            </tr>
                        </table><br />
                        
                        <?php  $i++ ;} else { ?>
                    <table>
                            <tr>
                                <th><h2>Proveedor<?php echo " ".$i;?></h2></th>
                            </tr>
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
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/edite_button.png" style="width: 30px; height: 30px;" class="editar_fila"
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
        <a href="formulario_proveedor.php"><img style="width: 30px; height: 30px;" src="../img/add_button.png"
                class="añadir_proveedor" alt="Añadir Proveedor"></a>
        <?php } ?>
    </main>
</body>
</html>
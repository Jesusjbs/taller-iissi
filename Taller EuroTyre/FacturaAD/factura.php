<?php
	session_start();

	require_once("../Otros/gestionBD.php");
    require_once("gestionarFacturas.php");
    
    if(!isset($_SESSION["admin"]))
        Header("Location: ../Otros/login.php");
    else {
        
        if(!isset($_SESSION["oid_r"])) {
            $_SESSION["oid_r"] = $_REQUEST["oid_r"];
        }
        
        if(isset($_SESSION["factura"])) {
            $factura = $_SESSION["factura"];
            unset($_SESSION["factura"]);
        }

        
    }
    $conexion=crearConexionBD();
    $filas=consultaFactura($conexion,$_SESSION["oid_r"]);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Factura</title>
</head>

<body>

    <?php
	include_once("../Otros/cabecera.php");
    ?>
    <main>
        <?php
		foreach($filas as $fila) { 
	?>
        <article class="factura">
            <form method="post" action="controlador_factura.php">
                <div class="fila_factura">
                    <div class="datos_factura">
                       <!-- <input id="id_oidr" name="OID_R" type="hidden" value="<?php echo $fila["OID_R"]; ?>" />  -->
                        <input id="id_numFactura" name="numFactura" type="hidden" value="<?php echo $fila["NUMFACTURA"];?>" />
                        <input id="id_descripcion" name="descripcion" type="hidden" value="<?php  echo $fila["DESCRIPCIÓN"];?>" />
                        <input id="id_manoDeObra" name="manoDeObra" type="hidden" value="<?php  echo $fila["MANODEOBRA"];?>" />
                        <input id="id_iva" name="IVA" type="hidden" value="<?php  echo $fila["IVA"];?>" />
                        <input id="id_Pago" name="Pago" type="hidden" value="<?php  echo $fila["PAGO"];?>" />
                        <?php
                        if(isset($factura) and ($factura["numFactura"] == $fila["NUMFACTURA"])){ ?>
                        <table>
                            <tr>
                                <th>
                                    <h2>Editando factura con ID: <?php echo $fila["NUMFACTURA"]; ?></h2>
                                </th>
                            </tr>
                            <tr>
                                <td>DNI del Cliente:</td>
                                <td><?php echo $fila["DNI"]; ?></td>
                            </tr>
                            <tr>
                                <td>Fecha de Emisión:</td>
                                <td><?php echo $fila["FECHAEMISIÓN"]; ?></td>
                            </tr>
                            <tr>
                                <td>Descripción:</td>
                                <td><textarea id="id_descripcion" name="descripcion" rows="2" cols="40" 
                                        value="<?php echo $fila["DESCRIPCIÓN"]; ?>"><?php echo $fila["DESCRIPCIÓN"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Mano de Obra:</td>
                                <td><input id="id_manoDeObra" name="manoDeObra" type="text" 
                                    value="<?php echo str_replace(',','.', $fila["MANODEOBRA"]);?>" /></td>
                            </tr>
                            <tr>
                                <td>Tipo de Pago:</td>
                                <td><input id="id_Pago" name="Pago" type="text" value="<?php echo $fila["PAGO"];?>" /></td>
                            </tr>
                            <tr>
                                <td>IVA:</td>
                                <td><input id="id_iva" name="IVA" type="text" 
                                    value="<?php echo str_replace(',','.', $fila["IVA"]);?>"/></td>
                            </tr>
                            <tr>
                                <td>IMPORTE: <?php echo " ".$fila["MANODEOBRA"] + $fila["IMPORTE"]." €"; ?></td>
                            </tr><br />
                        </table>
                        <?php } else { ?>

                        <table>
                            <tr>
                                <th>
                                    <h2>Factura con ID: <?php echo $fila["NUMFACTURA"]; ?></h2>
                                </th>
                            </tr>
                            <tr>
                                <td>DNI del Cliente:</td>
                                <td><?php echo $fila["DNI"]; ?></td>
                            </tr>
                            <tr>
                                <td>Fecha de Emisión:</td>
                                <td><?php echo $fila["FECHAEMISIÓN"]; ?></td>
                            </tr>
                            <tr>
                                <td>Descripción:</td>
                                <td><?php echo $fila["DESCRIPCIÓN"];?></td>
                            </tr>
                            <tr>
                                <td>Mano de Obra:</td>
                                <td><?php echo $fila["MANODEOBRA"];?></td>
                            </tr>
                            <tr>
                                <td>Tipo de pago:</td>
                                <td><?php echo $fila["PAGO"];?></td>
                            </tr>
                            <tr>
                                <td>IVA:</td>
                                <td><?php echo 100*number_format(str_replace(',','.', $fila["IVA"]),2)." %"; ?></td>
                            </tr>
                            <?php
                            $lineas = consulta_linea($conexion, $fila["NUMFACTURA"],  $fila["OID_R"]);
                            $n = 1;
                            foreach($lineas as $linea) { ?>
                            <tr>
                                <th>Línea de Factura <?php echo $n; ?></th>
                                <td>
                                <input type="hidden" value="<?php echo $linea["OID_LFC"];?>" name="OID_LFC" />
                                <button id="id_formFact" type="submit">Eliminar Línea</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Pieza:</td>
                                <td><?php echo $linea["NOMBRE"];?></td>
                            </tr>
                            <tr>
                                <td>Unidades:</td>
                                <td><?php echo $linea["CANTIDAD"];?></td>
                            </tr>
                            <tr>
                                <td>Precio unitario:</td>
                                <td><?php echo $linea["PRECIOUNITARIO"]." €";?></td>
                            </tr>
                            <?php $n++; } ?>
                            <tr>
                                <th>Importe total: <?php echo " ".$fila["MANODEOBRA"] + $fila["IMPORTE"]." €";?></th>
                            </tr>
                        </table><br />

                        <?php 
                    } ?>
                    </div>

                    <div class="id_botonesFactura">
                        <?php
                if(isset($factura) and ($factura["numFactura"] == $fila["NUMFACTURA"])){ ?>
                        <!-- Botón de grabar -->
                        <button title="Confirmar Cambios" id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button title="Editar Factura" id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/edit_bill.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar Factura">
                        </button><br /><br />
                        </div>
                        <?php } ?>
                </div>
            </form>
        </article>
        <label id="id_formFact" >Líneas de Factura:</label>
            <form action="../FacturaAD/formulario_linea_factura.php" method="post">
                <input type="hidden" value="<?php echo $fila["NUMFACTURA"];?>" name="numFactura" />
                <button id="id_formFact" type="submit">Añadir Línea</button>
            </form>
        <?php
        }
        cerrarConexionBD($conexion);?>
    </main>
</body>

</html>

    
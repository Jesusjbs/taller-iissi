<?php
	session_start();

	require_once("../Otros/gestionBD.php");
    require_once("gestionarFacturas.php");
    
    if(!isset($_SESSION["admin"]))
        Header("Location: ../Otros/login.php");
    else {
        
        if(!isset($_SESSION["oid_r"])) {
            $_SESSION["oid_r"] = $_SESSION["reparacion"]["oid_r"];
        }
        
        if(isset($_SESSION["factura"])) {
            $factura = $_SESSION["factura"];
            unset($_SESSION["factura"]);
        }

        if(isset($_SESSION["reparacion"])) {
            $reparacion = $_SESSION["reparacion"];
            unset($_SESSION["reparacion"]);
        }

        if (isset($_SESSION["errores"]))
            $errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
    }
    $conexion=crearConexionBD();
    $filas=consultaFactura($conexion,$_SESSION["oid_r"]);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Factura</title>
    <link rel="stylesheet" type="text/css" href="../css/style_facturaAD.css" />
    <script src="../ValidacionesJS/valida_factura.js"></script>
</head>

<body>

    <?php
    include_once("../Otros/cabecera.php");
    if (isset($errores) && count($errores)>0) { 
        echo "<div id=\"div_errores\" class=\"error\">";
        echo "<h4> Errores en el formulario:</h4>";
        foreach($errores as $error) echo $error; 
        echo "</div>";
      }
    ?>
    <main>
        <?php
		foreach($filas as $fila) { 
	?>
        <article class="factura">
            <form method="post" action="controlador_factura.php"  onsubmit="return valida2()" >
                <div class="fila_factura">
                    <div class="datos_factura">
                       <!-- <input id="id_oidr" name="OID_R" type="hidden" value="<?php echo $fila["OID_R"]; ?>" />  -->
                        <input name="numFactura" type="hidden" value="<?php echo $fila["NUMFACTURA"];?>" />
                        <input name="descripcion" type="hidden" value="<?php  echo $fila["DESCRIPCIÓN"];?>" />
                        <input name="manoDeObra" type="hidden" value="<?php  echo $fila["MANODEOBRA"];?>" />
                        <input name="IVA" type="hidden" value="<?php  echo $fila["IVA"];?>" />
                        <input name="Pago" type="hidden" value="<?php  echo $fila["PAGO"];?>" />
                        <?php
                        if(isset($factura) and ($factura["numFactura"] == $fila["NUMFACTURA"])){ ?>
                        <h2>Editando factura con ID: <?php echo $fila["NUMFACTURA"]; ?></h2>
                        <table id="id_tablaFactura">
                            <tr>
                                <td class="h">DNI del Cliente:</td>
                                <td><?php echo $fila["DNI"]; ?></td>
                            </tr>
                            <tr>
                                <td>Fecha de Emisión:</td>
                                <td><?php echo $fila["FECHAEMISIÓN"]; ?></td>
                            </tr>
                            <tr>
                                <td>Descripción:</td>
                                <td><textarea class="campo" id="id_descripcion" name="descripcion" rows="2" cols="40" 
                                        maxlength="100" value="<?php echo $fila["DESCRIPCIÓN"]; ?>"><?php echo $fila["DESCRIPCIÓN"]; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Mano de Obra:</td>
                                <td><input class="campo" id="id_manoDeObra" name="manoDeObra" type="text" 
                                    value="<?php echo str_replace(',','.', $fila["MANODEOBRA"]);?>"
                                    required oninput="this.setCustomValidity('')" /></td>
                            </tr>
                            <tr>
                                <td>Tipo de Pago:</td>
                                <td><input class="campo" id="id_tipoPago" name="Pago" type="text" value="<?php echo $fila["PAGO"];?>"
                                oninput="this.setCustomValidity('')" required /></td>
                            </tr>
                            <tr>
                                <td>IVA:</td>
                                <td><input class="campo" id="id_iva" name="IVA" type="text" 
                                    value="<?php echo str_replace(',','.', $fila["IVA"]);?>" required
                                    oninput="this.setCustomValidity('')" /></td>
                            </tr>
                            <?php $importeFinal = number_format(str_replace(',','.', $fila["MANODEOBRA"]),2) 
                                + number_format(str_replace(',','.',$fila["IMPORTE"]),2); ?>
                            <tr>
                                <td id="id_importe"><h3>IMPORTE:</h3></td>
                                <td id="id_pago"><h3><?php echo $fila["MANODEOBRA"]+$fila["IMPORTE"]." €";?></h3></td>
                            </tr>
                        </table>
                        <?php } else { ?>
                        <h2>Factura con ID: <?php echo $fila["NUMFACTURA"]; ?></h2>
                        <table id="id_tablaFactura">
                            <tr>
                                <td class="h">DNI del Cliente:</td>
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
                                <button class="formFact" type="submit">Eliminar Línea</button>
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
                            <?php $n++; } 
                            $importeFinal = number_format(str_replace(',','.', $fila["MANODEOBRA"]),2) 
                                + number_format(str_replace(',','.',$fila["IMPORTE"]),2); ?>
                            <tr>
                                <td id="id_importe"><h3>Importe total:</h3></td>
                                <td id="id_pago"><h3><?php echo $fila["MANODEOBRA"]+$fila["IMPORTE"]." €";?></td>
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
                        <?php } ?>
                    </div>
                </div>
            </form>
        </article>
            <div id="id_divEnviar">
            <form action="../FacturaAD/formulario_linea_factura.php" method="post">
                <input type="hidden" value="<?php echo $fila["NUMFACTURA"];?>" name="numFactura" />
                <button title="Añadir Línea" id="id_formFact" type="submit">Añadir Línea</button>
            </form>
            </div>
        <?php
        }
        cerrarConexionBD($conexion);?>
    </main>
</body>

</html>

    
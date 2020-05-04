<?php
    session_start();

	require_once("../Otros/gestionBD.php");
    require_once("gestionarCitas.php");
    
    $oid = $_REQUEST["oidR"];
    
    if(!isset($_SESSION["login"]))
        Header("Location: ../Otros/login.php");
    else {
        if(!isset($oid)) Header("Location: consulta.php");
    }
    $conexion = crearConexionBD();
    $facturas = consulta_factura($conexion,$oid,$_SESSION["login"]);
    cerrarConexionBD($conexion);


?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <title>Factura</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
        <script src="https://unpkg.com/jspdf-autotable"></script>

        <script>
            function convertirPDF() {
                var pdf = new jsPDF();

                pdf.autoTable({ html: '#my-table' });
                pdf.save('Factura.pdf');
            }
        </script>
    </head>
    <body>

    <?php
    include_once("../Otros/cabecera.php");
    $i = 0;

    foreach($facturas as $fact) {
    ?>
        <main>
            <table id="my-table">
                <tr>
                    <th><h2>Factura con ID: <?php echo $fact["NUMFACTURA"]; ?></h2></th>
                    <th></th>
                </tr>
                <tr>
                    <td>Descripción:</td>
                    <td><?php echo $fact["DESCRIPCIÓN"]; ?></td>
                </tr>
                <tr>
                    <td>Mano de obra:</td>
                    <td><?php echo $fact["MANODEOBRA"]." €";?></td>
                </tr>
                <tr>
                    <td>IVA:</td>
                    <td><?php echo substr($fact["IVA"],1)." %";?></td>
                </tr>
                <tr>
                    <td>Fecha de Emisión:</td>
                    <td><?php echo $fact["FECHAEMISIÓN"];?></td>
                </tr>
                <tr>
                    <td>Tipo de Pago:</td>
                    <td><?php echo $fact["PAGO"];?></td>
                </tr>
                <?php
                $lineas = consulta_linea($conexion, $fact["NUMFACTURA"], $oid);
                $n = 1;
                foreach($lineas as $linea) { ?>
                <tr>
                    <th>Línea de Factura <?php echo $n; ?></th>
                    <td></td>
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
                    <th>Importe total:</th>
                    <th><?php echo $fact["MANODEOBRA"] + $fact["IMPORTE"]." €";?></th>
                </tr>
            </table><br />
        </main>
        <a href="javascript:convertirPDF()">Descargar</a>
    <?php 
        $i++;
    } 
    if($i == 0) { ?>
        <br /><br /><p>La factura correspondiente a la reparación con ID <?php echo $oid ?> no está disponible aún. Disculpe las molestias.</p>
    <?php
    }
    
    ?>
    
    </body>
</html>
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
    </head>
    <body>

    <?php
    include_once("../Otros/cabecera.php");
    $i = 0;
    foreach($facturas as $fact) {
    ?>
        <main>
        <h1>Factura</h1>
        <table>
            <tr>
                <th><h2>Factura con ID: <?php echo $fact["NUMFACTURA"]; ?></h2></th>
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
                <td>Importe:</td>
                <td><?php echo $fact["IMPORTE"]." €";?></td>
            </tr>
            <tr>
                <td>Fecha de Emisión:</td>
                <td><?php echo $fact["FECHAEMISIÓN"];?></td>
            </tr>
            <tr>
                <td>Tipo de Pago:</td>
                <td><?php echo $fact["PAGO"];?></td>
            </tr>
        </table><br />
        </main>
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
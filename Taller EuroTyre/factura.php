<?php
    session_start();

	require_once("gestionBD.php");
    require_once("gestionarCitas.php");
    
    $oid = $_REQUEST["oidR"];
    
    if(!isset($_SESSION["login"]))
        Header("Location: login.php");
    else {
        if(!isset($oid)) Header("Location: consulta.php");
    }
    $conexion = crearConexionBD();
    $fact = consulta_factura($conexion,$oid);
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
	include_once("cabecera.php");
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
                <td><?php echo $fact["IVA"]." €";?></td>
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
    </body>
</html>
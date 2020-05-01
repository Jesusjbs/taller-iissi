<?php
    session_start();

    require_once("../Otros/gestionBD.php");
    //require_once("../gestionBD.php");
    $oid = $_REQUEST["oid_r"];
    
    if(!isset($_SESSION["admin"]))
        Header("Location: ../Otros/login.php");
    else {
        if(!isset($oid)) Header("Location: consulta.php");
    }
    $conexion = crearConexionBD();
    //$facturas = consulta_factura($conexion,$oid,$_SESSION["login"]);
    cerrarConexionBD($conexion);
    
    
    ?>
<!DOCTYPE html>
<html lang="es">
<p>FACTURA:</p>
</html>

    
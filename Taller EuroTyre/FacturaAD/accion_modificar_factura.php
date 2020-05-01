<?php   
    session_start();    
        
        if (isset($_SESSION["factura"])) {
            require_once("../Otros/gestionBD.php");
            require_once("gestionarFacturas.php");

            $factura = $_SESSION["factura"];
 
            $conexion = crearConexionBD();
    
            $excep = editarFactura($conexion,$factura);
            unset($_SESSION["factura"]);
            cerrarConexionBD($conexion);
            
            if($excep<>""){
                $_SESSION["excepcion"] = $excep;
                header("Location: ../Otros/excepcion.php");
    
            } else Header("Location: factura.php");
            
        }
    
        else
            Header("Location: ../Otros/login.php"); ?>
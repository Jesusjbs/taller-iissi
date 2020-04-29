<?php   
    session_start();    
    
    if (isset($_SESSION["reparacion"])) {
        $reparacion = $_SESSION["reparacion"];
        
        $oid_r = $reparacion["oid_r"];
        $estado = $reparacion["estado"];
        $fechaInicio = $reparacion["fechaInicio"];
        $fechaFin = $reparacion["fechaFin"];
        $matriculaC = $reparacion["matriculaC"];
        $matriculaM = $reparacion["matriculaM"];
        $fechaSolicitud = $reparacion["fechaSolicitud"];
        $numCita = $reparacion["numCita"];
        $tienePresupuesto = $reparacion["tienePresupuesto"];
        $dni = $reparacion["dni"];
        unset($_SESSION["reparacion"]);

        require_once("../Otros/gestionBD.php");
        require_once("gestionarReparacion.php");
        
        $conexion = crearConexionBD();

        $excep = editarReparacion($conexion, $oid_r, $estado,$fechaInicio, $fechaFin, $tienePresupuesto,$numCita);
        cerrarConexionBD($conexion);
        
        if($excep<>""){
            $_SESSION["excepcion"] = $excep;
            header("Location: ../Otros/excepcion.php");

        } else Header("Location: home.php");
        
    }

    else
        Header("Location: ../Otros/login.php"); 
?>
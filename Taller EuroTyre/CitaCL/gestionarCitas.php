<?php

 function crea_cita($conexion,$usuario, $cita) {
    $consulta = "CALL insertar_cita(:presupuesto, :dni, :dia, :auto, :itv)";
    try {
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':presupuesto',$cita["presupuesto"]);
        $stmt -> bindParam(':dni',$usuario);
        $stmt -> bindParam(':dia',date('d/m/Y',strtotime($cita['dia'])));
        $stmt -> bindParam(':auto',$cita["auto"]);
        $stmt -> bindParam(':itv',date('d/m/Y',strtotime($cita['itv'])));
        $stmt -> execute();
        return $stmt;
    }
    catch(PDOException $err) {
        echo $err -> GetMessage();
        return false;
    }

}

function consulta_factura($conexion, $oid,$dni) {
    $consulta = "SELECT * FROM FACTURASCLIENTES WHERE OID_R = $oid and DNI=$dni";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

function consulta_linea($conexion, $num, $oid) {
    $consulta = "SELECT * FROM PIEZAS, LÍNEASFACTURASCLIENTES, REPARACIONES WHERE LÍNEASFACTURASCLIENTES.NUMFACTURA = $num
         and REPARACIONES.OID_R = $oid and LÍNEASFACTURASCLIENTES.OID_P = PIEZAS.OID_P";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

?>
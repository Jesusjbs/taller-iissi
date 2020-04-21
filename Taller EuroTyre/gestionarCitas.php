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

function consulta_factura($conexion, $oid) {
    $consulta = "SELECT * FROM FACTURASCLIENTES WHERE OID_R = $oid";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

?>
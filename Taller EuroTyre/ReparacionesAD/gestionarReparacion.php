<?php


function editarReparacion($conexion, $oid_r, $estado,$fechaInicio, $fechaFin, $tienePresupuesto,$numCita) {
    try{
        $stmt=$conexion->prepare('CALL EDITARREPARACION(:oid_r, :estado, :fechaInicio, :fechaFin, :tienePresupuesto,:numCita)');
        $stmt->bindParam(':oid_r',$oid_r);
        $stmt->bindParam(':estado',$estado);
        $stmt->bindParam(':fechaInicio',date('d/m/Y',strtotime($fechaInicio)));
        $stmt->bindParam(':fechaFin',date('d/m/Y',strtotime($fechaFin)));
        $stmt->bindParam(':tienePresupuesto',$tienePresupuesto);
        $stmt->bindParam(':numCita',$numCita);
        $stmt->execute();
        
        return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function cuentaFactura($conexion,$oid_r) {
   $consulta = 'SELECT COUNT(*) AS TOTAL FROM FACTURASCLIENTES WHERE OID_R=:oid';
   $stmt = $conexion->prepare($consulta);
   $stmt->bindParam(':oid',$oid_r);
   $stmt->execute();
   return $stmt->fetchColumn();
}
?>
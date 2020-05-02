<?php

function consultaFactura($conexion, $oidr) {
    try {
        $consulta = "SELECT * FROM FACTURASCLIENTES WHERE OID_R=$oidr";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt;
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

function crearFactura($conexion, $factura) {
    try{
        $stmt=$conexion->prepare('CALL CREARFACTURA(:oidr, :descripcion, :manoDeObra,:iva, :pago, :dni)');
        $stmt->bindParam(':oidr',$factura["oidr"]);
        $stmt->bindParam(':descripcion',$factura["descripcion"]);
        $stmt->bindParam(':manoDeObra',$factura["manoDeObra"]);
        $stmt->bindParam(':iva',$factura["IVA"]);
        $stmt->bindParam(':pago',$factura["Pago"]);
        $stmt->bindParam(':dni',$factura["dni"]);
		$stmt->execute();
		return $stmt;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

function editarFactura($conexion, $factura) {
    try{
        $stmt=$conexion->prepare('CALL EDITARFACTURA(:numFactura, :descripcion, :manoDeObra,:iva, :pago)');
        $stmt->bindParam(':numFactura',$factura["numFactura"]);
        $stmt->bindParam(':descripcion',$factura["descripcion"]);
        $stmt->bindParam(':manoDeObra',$factura["manoDeObra"]);
        $stmt->bindParam(':iva',$factura["IVA"]);
        $stmt->bindParam(':pago',$factura["Pago"]);
        
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}



?>
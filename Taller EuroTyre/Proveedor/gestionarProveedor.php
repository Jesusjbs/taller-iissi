<?php

function consultaProveedores($conexion) {
    try {
        $consulta = "SELECT * FROM PROVEEDORES";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt;
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

function editarProveedor($conexion, $oid, $tipo, $nombre, $email, $telefono) {
    try{
        $stmt=$conexion->prepare('CALL EDITARPROVEEDOR(:oid, :tipo, :nombre, :email, :telefono)');
        $stmt->bindParam(':oid',$oid);
        $stmt->bindParam(':tipo',$tipo);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':telefono',$telefono); 
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function contratarProveedor($conexion, $proveedor) {
    try{
        $stmt=$conexion->prepare('CALL CONTRATARPROVEEDOR(:tipo, :nombre, :email, :telefono)');
        $stmt->bindParam(':tipo',$proveedor["tipoProveedor"]);
        $stmt->bindParam(':nombre',$proveedor["nombre"]);
        $stmt->bindParam(':email',$proveedor["email"]);
        $stmt->bindParam(':telefono',$proveedor["telefono"]);
		$stmt->execute();
		return $stmt;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
function eliminarProveedor($conexion,$oid_p){
    try{
        $stmt=$conexion->prepare('CALL ELIMINARPROVEEDOR(:oid_p)');
        $stmt->bindParam(':oid_p',$oid_p);
        $stmt->execute();
        return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }

}

?>
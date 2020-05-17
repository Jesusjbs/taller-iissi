<?php

 function alta_vehiculo($conexion,$registro,$dni) {
    $consulta = "CALL insertar_vehiculo(:tipo, :furgoneta, :modelo, :matricula,:dni, :color)";
    try {
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':tipo',$registro['tipo']);
        $stmt -> bindParam(':furgoneta',$registro["furgoneta"]);
        $stmt -> bindParam(':modelo',$registro["modelo"]);
        $stmt -> bindParam(':matricula',$registro["matricula"]);
        $stmt -> bindParam(':dni',$dni);
        $stmt -> bindParam(':color',$registro["color"]);
        $stmt -> execute();
        return $stmt;
    }
    catch(PDOException $err) {
        echo $err -> GetMessage();
        return false;
    }
}

function consultaCoche($conexion,$dni){
    $consulta = "SELECT DISTINCT * FROM CLIENTES, COCHES,MODELOSCOCHES,MARCAS"
        . " WHERE COCHES.dni = $dni AND CLIENTES.dni= COCHES.dni AND COCHES.oid_mc=MODELOSCOCHES.oid_mc AND MODELOSCOCHES.oid_m="
        . "MARCAS.oid_m";
    try{
        return $conexion->query($consulta);
    }
    catch(PDOException $err) {
        echo $err -> GetMessage();
        return false;
    }
}

function consultaMoto($conexion,$dni){
    $consulta = "SELECT DISTINCT * FROM CLIENTES, MOTOCICLETAS,MODELOSMOTOS,MARCAS"
        . " WHERE MOTOCICLETAS.dni = $dni AND CLIENTES.dni=MOTOCICLETAS.dni AND MOTOCICLETAS.oid_mM=MODELOSMOTOS.oid_mm"
        . " AND MODELOSMOTOS.oid_m=MARCAS.oid_m";
    try{
        return $conexion->query($consulta);
    }
    catch(PDOException $err) {
        echo $err -> GetMessage();
        return false;
    }
}

function consultaMarcas($conexion) {
    $consulta = "SELECT * FROM MARCAS";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

function consultarMarcasCoches($conexion) {
    $consulta = "SELECT DISTINCT NOMBRE,MARCAS.OID_M FROM MARCAS, MODELOSCOCHES WHERE MARCAS.OID_M IN MODELOSCOCHES.OID_M ORDER BY NOMBRE";
    try {
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

function consultarMarcasMotos($conexion){
    $consulta = "SELECT DISTINCT NOMBRE,MARCAS.OID_M FROM MARCAS, MODELOSMOTOS WHERE MARCAS.OID_M IN MODELOSMOTOS.OID_M ORDER BY NOMBRE";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}
function consultaMC($conexion, $oidm) {
    $consulta = "SELECT * FROM MODELOSCOCHES WHERE OID_M = $oidm";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

function consultaMM($conexion, $oidm) {
    $consulta = "SELECT * FROM MODELOSMOTOS WHERE OID_M = $oidm";
    try{    
        return $conexion -> query($consulta);
    } catch(PDOException $e) {
        echo $e -> GetMessage();
        return false;
    }
}

function cuentaModelos($conexion, $nombre) {
    $consulta = "SELECT COUNT(*) AS TOTAL FROM MODELOSMOTOS WHERE MODELO=:nombre";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function eliminarMoto($conexion,$matricula){
    try{
        $stmt=$conexion->prepare('CALL ELIMINARMOTO(:matricula)');
        $stmt->bindParam(':matricula',$matricula);
        $stmt->execute();
        return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }

}
function eliminarCoche($conexion,$matricula){
    try{
        $stmt=$conexion->prepare('CALL ELIMINARCOCHE(:matricula)');
        $stmt->bindParam(':matricula',$matricula);
        $stmt->execute();
        return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }

}

function editarCoche($conexion,$coche){
    try{
        $stmt=$conexion->prepare('CALL EDITARCOCHE(:matricula, :color, :kilometraje, :proxITV, :numBastidor)');
        $stmt->bindParam(':matricula',$coche["matricula"]);
        $stmt->bindParam(':color',$coche["color"]);
        $stmt->bindParam(':kilometraje',$coche["kilometraje"]);
        $proxITV = date('d/m/Y',strtotime($coche["proxITV"]));
        $stmt->bindParam(':proxITV',$proxITV);
        $stmt->bindParam(':numBastidor',$coche["numBastidor"]);
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function editarMoto($conexion,$moto){
    try{
        $stmt=$conexion->prepare('CALL EDITARMOTO(:matricula, :color, :kilometraje, :proxITV, :numBastidor)');
        $stmt->bindParam(':matricula',$moto["matricula"]);
        $stmt->bindParam(':color',$moto["color"]);
        $stmt->bindParam(':kilometraje',$moto["kilometraje"]);
        $proxITV = date('d/m/Y',strtotime($moto["proxITV"]));
        $stmt->bindParam(':proxITV',$proxITV);
        $stmt->bindParam(':numBastidor',$moto["numBastidor"]);
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function cuentaVehiculo($conexion,$matricula) {
    try{
        $consulta = "SELECT COUNT(*) AS TOTAL FROM REPARACIONES WHERE (MATRÍCULAC = '$matricula' OR MATRÍCULAM = '$matricula')";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchColumn();

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

?>

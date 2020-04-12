<?php

 function alta_vehiculo($conexion,$registro,$dni) {
    $consulta = "CALL insertar_vehiculo(:tipo, :furgoneta, :marca, :modelo, :matricula,:dni, :color)";
    try {
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':tipo',$registro['tipo']);
        $stmt -> bindParam(':furgoneta',$registro["furgoneta"]);
        $stmt -> bindParam(':marca',$registro["marca"]);
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

?>

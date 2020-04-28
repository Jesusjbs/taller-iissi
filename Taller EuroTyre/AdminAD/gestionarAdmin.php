<?php

function consultarMecanico($conexion,$dni,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM MECÁNICOS WHERE DNI=:dni AND CONTRASEÑA=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':dni',$dni);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
} 

function datosMecanico($conexion, $dni) {
    try {
        $consulta = "SELECT * FROM MECÁNICOS WHERE DNI = $dni";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt;
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

function infoMecanicos($conexion) {
    try {
        $consulta = "SELECT * FROM MECÁNICOS";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt;
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

function editarMecanico($conexion, $dni, $nombre, $apellido, $especialidad, $contraseña) {
    try{
        $stmt=$conexion->prepare('CALL EDITARMECANICO(:dni, :nombre, :apellido, :especialidad, :contraseña)');
        $stmt->bindParam(':dni',$dni);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':especialidad',$especialidad);
        $stmt->bindParam(':contraseña',$contraseña); 
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function editarPlantilla($conexion, $mecanico) {
    try{
        $stmt=$conexion->prepare('CALL EDITARPLANTILLA(:dni, :nombre, :apellido, :especialidad,:jefe, :contraseña)');
        $stmt->bindParam(':dni',$mecanico['dni']);
        $stmt->bindParam(':nombre',$mecanico['nombre']);
        $stmt->bindParam(':apellido',$mecanico['apellido']);
        $stmt->bindParam(':especialidad',$mecanico['Especialidad']);
        $stmt->bindParam(':jefe',$mecanico['jefe']);
        $stmt->bindParam(':contraseña',$mecanico['contraseña']); 
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function contratarMecanico($conexion, $mecanico) {
    try{
        $stmt=$conexion->prepare('CALL CONTRATAR_MECANICO(:dni, :nombre, :apellido, :especialidad,:jefe, :contraseña)');
        $stmt->bindParam(':dni',$mecanico["dni"]);
        $stmt->bindParam(':nombre',$mecanico["nombre"]);
        $stmt->bindParam(':apellido',$mecanico["apellido"]);
        $stmt->bindParam(':especialidad',$mecanico["Especialidad"]);
        $stmt->bindParam(':jefe',$mecanico["jefe"]);
        $stmt->bindParam(':contraseña',$mecanico["contraseña"]);
		$stmt->execute();
		return $stmt;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
function eliminarMecanico($conexion,$dni){
    try{
        $stmt=$conexion->prepare('CALL ELIMINARMECANICO(:dni)');
        $stmt->bindParam(':dni',$dni);
        $stmt->execute();
        return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }

}

function esJefe($conexion, $dni) {
	try {
        $consulta = "SELECT ESJEFE FROM MECÁNICOS WHERE DNI = $dni";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt->fetchColumn();
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

?>
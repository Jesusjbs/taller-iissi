<?php

 function alta_cliente($conexion,$usuario) {
    $consulta = "CALL insertar_cliente(:dni, :nombre, :apellidos, :telefono, :email, :direccion, :contraseña)";
    try {
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':dni',$usuario["dni"]);
        $stmt -> bindParam(':nombre',$usuario["nombre"]);
        $stmt -> bindParam(':apellidos',$usuario["apellidos"]);
        $stmt -> bindParam(':telefono',$usuario["telefono"]);
        $stmt -> bindParam(':email',$usuario["email"]);
        $stmt -> bindParam(':direccion',$usuario["direccion"]);
        $stmt -> bindParam(':contraseña',$usuario["contraseña"]);
        $stmt -> execute();
        return $stmt;
    }
    catch(PDOException $err) {
        return false;
    }
}

function consultarCliente($conexion,$dni,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE DNI=:dni AND CONTRASEÑA=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':dni',$dni);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function datosCliente($conexion, $dni) {
    try {
        $consulta = "SELECT * FROM CLIENTES WHERE DNI = $dni";
        $stmt = $conexion->prepare($consulta);
        $stmt-> execute();
        return $stmt;
    } catch(PDOException $err) {
            echo $err -> GetMessage();
            return false;
    }
}

function editarCliente($conexion, $dni, $nombre, $apellido, $telefono, $email, $direccion, $contraseña) {
    try{
        $stmt=$conexion->prepare('CALL EDITARPERFIL(:dni, :nombre, :apellido, :telefono, :email, :direccion, :contraseña)');
        $stmt->bindParam(':dni',$dni);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':direccion',$direccion);
        $stmt->bindParam(':contraseña',$contraseña);
		$stmt->execute();
		return "";

    }catch(PDOException $e){
        return $e->getMessage();
    }
}

function validaContraseña($conexion, $dni, $contraseña) {
    $consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE DNI=:dni AND CONTRASEÑA=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':dni',$dni);
	$stmt->bindParam(':pass',$contraseña);
	$stmt->execute();
	return $stmt->fetchColumn();
}

?>
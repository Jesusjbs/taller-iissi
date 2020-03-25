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
        echo $err -> GetMessage();
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
?>
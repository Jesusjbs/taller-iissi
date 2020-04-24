<?php

function consultarMecanico($conexion,$dni,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM MECÁNICOS WHERE DNI=:dni AND CONTRASEÑA=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':dni',$dni);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
} ?>
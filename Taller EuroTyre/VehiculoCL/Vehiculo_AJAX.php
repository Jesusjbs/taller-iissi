<?php
require_once("../Otros/gestionBD.php");
$conexion = crearConexionBD();

// Si llegamos a este script por haber seleccionado una marca
if(isset($_GET["marcaModeloC"])){
    
    // consultamos la lista de modelos de coches dada una marca
    $resultado = listarModelosCoches($conexion, $_GET["marcaModeloC"]);
    
    if($resultado != NULL){
        // Para cada modelo del listado devuelto
        foreach($resultado as $modelo){
            echo "<option label='" . $modelo["MODELO"] . "' value='" . $modelo["OID_MC"] . "'/>";  
        }
    }
    unset($_GET["marcaModeloC"]);
}

if(isset($_GET["marcaModeloM"])){
    // Consultamos la lista de modelos de motos dada una marca
    $resultado = listarModelosMotos($conexion, $_GET["marcaModeloM"]);
    
    if($resultado != NULL){
        // Para cada modelo del listado devuelto
        foreach($resultado as $modelo){
            echo "<option label='" . $modelo["MODELO"] . "' value='" . $modelo["OID_MM"] . "'/>";  
        }
    }
    // Cerramos la conexión y borramos de la sesión la variable
    unset($_GET["marcaModeloM"]);
}

function listarModelosCoches($conexion, $marca){
	try {
		$consulta = "SELECT MODELO, OID_MC FROM MODELOSCOCHES WHERE OID_M=:marc";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':marc',$marca);	

		$stmt->execute();	

		return $stmt;
	} catch(PDOException $e) {
		return NULL;
    }
}

function listarModelosMotos($conexion, $marca){
	try {
		$consulta = "SELECT MODELO, OID_MM FROM MODELOSMOTOS WHERE OID_M=:marc";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':marc',$marca);	

		$stmt->execute();	

		return $stmt;
	} catch(PDOException $e) {
		return NULL;
    }
}
cerrarConexionBD($conexion);
?>
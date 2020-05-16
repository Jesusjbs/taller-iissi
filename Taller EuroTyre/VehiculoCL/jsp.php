<?php
require_once("../Otros/gestionBD.php");

// EJERCICIO 4: Código que se ejecutará en la llamada AJAX a este script

// Si llegamos a este script por haber seleccionado una provincia
if(isset($_GET["marcaModelo"])){
    // Abrimos una conexión con la BD y consultamos la lista de municipios dada una provincia
    $conexion = crearConexionBD();
    $resultado = listarModelosCoches($conexion, $_GET["marcaModelo"]);
    
    if(resultado != NULL){
        // Para cada municipio del listado devuelto
        foreach($resultado as $modelo){
            // Creamos options con valores = oid_municipio y label = nombre del municipio
            echo "<option label='" . $modelo["MODELO"] . "' value='" . $modelo["OID_MC"] . "'/>";  
        }
    }
    // Cerramos la conexión y borramos de la sesión la variable "provincia"
    unset($_GET["marcaModelo"]);
    cerrarConexionBD($conexion);
}


// Función que devuelve el listado de municipios de una provincia dada
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

// FIN DE EJERCICIO 4 
?>
<?php
	session_start();

	require_once("../Otros/gestionBD.php");
	require_once("../Otros/consultaPaginada.php");
    
    if(!isset($_SESSION["login"]))
        Header("Location: ../Otros/login.php");

    if(!isset($_REQUEST["vehiculo"])) {
        if(!isset($_SESSION["vehiculo"])) {
            Header("Location: selecciona_vehiculo.php");
        } else {
            $vehiculo = $_SESSION["vehiculo"];
        }   
    } else {
        $vehiculo = $_REQUEST["vehiculo"];
        $_SESSION["vehiculo"] = $vehiculo;
    }
	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ? 
	// ¿Hay una sesión activa? 
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 4);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 4;
		
	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	
	// La consulta que ha de paginarse
	$query = "SELECT CITAS.NUMCITA, CITAS.FECHASOLICITUD, REPARACIONES.ESTADO, REPARACIONES.FECHAINICIO, REPARACIONES.FECHAFIN, " 
	."REPARACIONES.MATRÍCULAC, REPARACIONES.MATRÍCULAM, REPARACIONES.OID_R "
		."FROM CITAS,REPARACIONES "
		."WHERE (REPARACIONES.MATRÍCULAC ='".$vehiculo."' OR REPARACIONES.MATRÍCULAM = '".$vehiculo
			."') AND CITAS.NUMCITA = REPARACIONES.NUMCITA AND CITAS.DNI =".$_SESSION["login"]
		." ORDER BY CITAS.FECHASOLICITUD DESC";
	$_SESSION["query"] = $query;
	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;
	
	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);
	cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style_consultaCL.css" />
    <title>Consultas</title>
</head>

<body>

    <?php
	include_once("../Otros/cabecera.php");
    ?>
    <main>
        
    <div id="id_tablas">
    <h1 id="id_titulo">Consultas</h1>
    <?php
		foreach($filas as $fila) {
    ?>
           
        <table id="id_tabla">
            <tr>
                <td><h2>Cita con ID: <?php echo $fila["NUMCITA"]; ?></h2> </td>
                <td></td>
            </tr>
            <tr>
                <td>Fecha de Solicitud:</td>
                <td><?php echo $fila["FECHASOLICITUD"]; ?></td>
            </tr>
            <tr>
                <td>Fecha de Reparación:</td>
                <td><?php echo $fila["FECHAINICIO"];?></td>
            </tr>
            <tr>
                <td>Estado de Reparación:</td>
                <td><?php echo $fila["ESTADO"];?></td>
            </tr>
            <tr>
                <td>Fecha de Finalización:</td>
                <td><?php echo $fila["FECHAFIN"];?></td>
            </tr>
            <tr>
                <td>Matrícula:</td>
                <td><?php echo $fila["MATRÍCULAC"];  echo $fila["MATRÍCULAM"];?></td>
            </tr>
            <tr>
                <td>Factura:</td>
                <td><form action="factura.php" method="get">
                    <input type="hidden" value="<?php echo $fila["OID_R"];?>" name="oidR" />
                    <button id="id_btnFactura" type="submit">Ver Factura</button>
                </form></td>
            </tr>
        </table>
    <?php
        }
    ?>
    </div>
        <nav id="id_paginacion">
            <div id="id_enlaces">
            <?php
				for($i = 1;$i<=$total_paginas;$i++){		
						//Creamos la url que nos va a llevar a la página que queremos excepto si es la página seleccionada 
						echo "<a id='id_pag' href='" . "consulta.php?PAG_NUM=" . $i . "&PAG_TAM=" . $pag_tam . "'>" . $i . "</a>";						
				} 
			?>
		    </div>
		<br/><br/>
		<form id="id_form" method="get" action="consulta.php">
			<!-- Formulario que contiene el número y cambio de tamaño de página -->
			
			<input type="hidden" id= "pag_num" name="PAG_NUM" value="<?php echo $pagina_seleccionada;?>" />
			
			<input type="number" id= "pag_tam" name="PAG_TAM" value="<?php echo $pag_tam;?>" min="1" max="4" />
			
			<input id="id_enviar" type="submit" value="Cambiar"/>
		</form>
        </nav>
    </main>
</body>

</html>
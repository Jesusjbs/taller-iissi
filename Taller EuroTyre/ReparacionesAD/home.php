<?php
	session_start();

	require_once("../Otros/gestionBD.php");
    require_once("../Otros/consultaPaginada.php");
    require_once("../ReparacionesAD/gestionarReparacion.php");
    
    if(!isset($_SESSION["admin"]))
        Header("Location: ../Otros/login.php");
    else {
        if(isset($_SESSION["reparacion"])) {
            $reparacion = $_SESSION["reparacion"];
            unset($_SESSION["reparacion"]);
        }
        if(isset($_SESSION["oid_r"])) {
            unset($_SESSION["oid_r"]);
        }
    }

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ? 
	// ¿Hay una sesión activa? 
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;
		
	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	
	// La consulta que ha de paginarse
    $query = 'SELECT CITAS.NUMCITA, CITAS.FECHASOLICITUD, CITAS.DNI , REPARACIONES.ESTADO, CITAS.TIENEPRESUPUESTO,'
        .'REPARACIONES.FECHAINICIO, REPARACIONES.FECHAFIN, REPARACIONES.MATRÍCULAC, REPARACIONES.MATRÍCULAM, REPARACIONES.OID_R '
		.'FROM CITAS,REPARACIONES '
		.'WHERE '
			.'CITAS.NUMCITA = REPARACIONES.NUMCITA'
		.' ORDER BY CITAS.FECHASOLICITUD DESC';
	
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
	
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Inicio</title>
</head>

<body>

    <?php
	include_once("../Otros/cabeceraAdmin.php");
    ?>
    <main>
        <h1>Reparaciones</h1>
        <?php
		foreach($filas as $fila) { 
	?>
        <article class="reparacion">
            <form method="post" action="controlador_reparacion.php">
                <div class="fila_reparacion">
                    <div class="datos_reparacion">
                        <input id="id_oidr" name="oid_r" type="hidden" value="<?php echo $fila["OID_R"];?>" />
                        <input id="id_estado" name="estado" type="hidden" value="<?php  echo $fila["ESTADO"];?>" />
                        <input id="id_fechaSolicitud" name="fechaSolicitud" type="hidden" value="<?php  echo $fila["FECHASOLICITUD"];?>" />
                        <input id="id_fechaInicio" name="fechaInicio" type="hidden" value="<?php  echo $fila["FECHAINICIO"];?>" />
                        <input id="id_fechaFin" name="fechaFin" type="hidden"
                            value="<?php  echo $fila["FECHAFIN"];?>" />
                        <input id="id_matriculaC" name="matriculaC" type="hidden" value="<?php  echo $fila["MATRÍCULAC"];?>" />
                        <input id="id_matriculaM" name="matriculaM" type="hidden" value="<?php  echo $fila["MATRÍCULAM"];?>" />
                        <input id="id_numCita" name="numCita" type="hidden" value="<?php  echo $fila["NUMCITA"];?>" />
                        <input id="id_tienePresupuesto" name="tienePresupuesto" type="hidden" value="<?php  echo $fila["TIENEPRESUPUESTO"];?>" />
                        <input id="id_dni" name="dni" type="hidden" value="<?php  echo $fila["DNI"];?>" />

                        <?php
                if(isset($reparacion) and ($reparacion["oid_r"] == $fila["OID_R"])){ ?>
                        <table>
                            <tr>
                                <th>
                                    <h2>Editando reparación con ID: <?php echo $fila["OID_R"]; ?></h2>
                                </th>
                            </tr>
                            <tr>
                                <td>Fecha de Solicitud:</td>
                                <td><?php echo $fila["FECHASOLICITUD"]; ?></td>
                            </tr>
                            <tr>
                                <td>Fecha de Reparación:</td>
                                <td><input id="id_fechaInicio" name="fechaInicio" type="date" 
                                        value="<?php echo $fila["FECHAINICIO"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Estado de Reparación:</td>
                                <td><input id="id_estado" name="estado" type="text" value="<?php echo $fila["ESTADO"];?>" /></td>
                            </tr>
                            <tr>
                                <td>Presupuesto:</td>
                                <td><input id="id_tienePresupuesto" name="tienePresupuesto" type="text" 
                                        value="<?php echo $fila["TIENEPRESUPUESTO"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Fecha de Finalización:</td>
                                <td><input id="id_fechaFin" name="fechaFin" type="date" 
                                        value="<?php echo $fila["FECHAFIN"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Matrícula:</td>
                                <td><?php echo $fila["MATRÍCULAC"];  echo $fila["MATRÍCULAM"];?></td>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td><?php echo $fila["DNI"]; ?></td>
                            </tr><br />
                        </table>
                        <?php } else { ?>

                        <table>
                            <tr>
                                <th>
                                    <h2>Reparación con ID: <?php echo $fila["OID_R"]; ?></h2>
                                </th>
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
                                <td>Presupuesto:</td>
                                <td><?php echo $fila["TIENEPRESUPUESTO"];?></td>
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
                                <td>DNI:</td>
                                <td><?php echo $fila["DNI"];?></td>
                            </tr>

                        </table><br />

                        <?php 
                    } ?>
                    </div>

                    <div class="id_botonesReparacion">
                        <?php
                if(isset($reparacion) and ($reparacion["oid_r"] == $fila["OID_R"])){ ?>
                        <!-- Botón de grabar -->
                        <button id="grabar" name="grabar" type="submit" class="editar_fila">
                            <img src="../img/commit_button.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Guardar modificación">
                        </button>
                        <?php } else { ?>
                        <!-- Botón de editar -->
                        <button id="editar" name="editar" type="submit" class="editar_fila">
                            <img src="../img/edit_repair.png" style="width: 30px; height: 30px;" class="editar_fila"
                                alt="Editar reparacion">
                        </button><br /><br />
                        </div>
                        <?php } ?>
                </div>
            </form>
        </article>
        <?php if(cuentaFactura($conexion, $fila["OID_R"]) == 1) { ?>
                <label id="id_formFact" >Factura:</label>
                <form action="../FacturaAD/factura.php" method="post">
                    <input type="hidden" value="<?php echo $fila["OID_R"];?>" name="oid_r" />
                    <button id="id_formFact" type="submit">Ver Factura</button>
                    </form>
        <?php } else { ?>
            <label id="id_formFact" >Factura:</label>
                <form action="../FacturaAD/formulario_factura.php" method="post">
                    <input type="hidden" value="<?php echo $fila["OID_R"];?>" name="oid_r" />
                    <input type="hidden" value="<?php echo $fila["DNI"];?>" name="dni" />
                    <button id="id_formFact" type="submit">Crear Factura</button>
                </form>
            <?php }
        }
            
        cerrarConexionBD($conexion);?>

        <nav>
            <div id="enlaces">
                <?php
				for($i = 1;$i<=$total_paginas;$i++){		
						//Creamos la url que nos va a llevar a la página que queremos excepto si es la página seleccionada 
						echo "<a href='" . "home.php?PAG_NUM=" . $i . "&PAG_TAM=" . $pag_tam . "'>" . $i . "</a>";						
				} 
			?>
            </div>

            <form method="get" action="home.php">
                <!-- Formulario que contiene el número y cambio de tamaño de página -->

                <input type="hidden" id="pag_num" name="PAG_NUM" value="<?php echo $pagina_seleccionada;?>" />

                <input type="number" id="pag_tam" name="PAG_TAM" value="<?php echo $pag_tam;?>" min="1"
                    max="<?php echo $total_registros; ?>" />

                <input type="submit" value="Cambiar" />
            </form>
        </nav>
    </main>
</body>

</html>
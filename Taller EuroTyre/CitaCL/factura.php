<?php
    session_start();

	require_once("../Otros/gestionBD.php");
    require_once("gestionarCitas.php");
    
    $oid = $_REQUEST["oidR"];
    
    if(!isset($_SESSION["login"]))
        Header("Location: ../Otros/login.php");
    else {
        if(!isset($oid)) Header("Location: consulta.php");
    }
    $conexion = crearConexionBD();
    $facturas = consulta_factura($conexion,$oid,$_SESSION["login"]);
    cerrarConexionBD($conexion);


?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Factura</title>
    <link rel="stylesheet" type="text/css" href="../css/style_facturaCL.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>

    <script>
      function convertirPDF() {
        var pdf = new jsPDF();

        pdf.autoTable({ html: "#id_tablaFactura" });
        pdf.save("Factura.pdf");
      }
    </script>
  </head>
  <body>
    <?php
    include_once("../Otros/cabecera.php");
    $i = 0;?>
    <div class="factura">
      <?php
    foreach($facturas as $fact) {
    ?>
      <main>
        <h2 id="id_factura">
          Factura con ID:
          <?php echo $fact["NUMFACTURA"]; ?>
        </h2>
        <table id="id_tablaFactura">
          <tr>
            <td class="h">Descripción:</td>
            <td><?php echo $fact["DESCRIPCIÓN"]; ?></td>
          </tr>
          <tr>
            <td>Mano de obra:</td>
            <td><?php echo $fact["MANODEOBRA"]." €";?></td>
          </tr>
          <tr>
            <td>IVA:</td>
            <td><?php echo substr($fact["IVA"],1)." %";?></td>
          </tr>
          <tr>
            <td>Fecha de Emisión:</td>
            <td><?php echo $fact["FECHAEMISIÓN"];?></td>
          </tr>
          <tr>
            <td>Tipo de Pago:</td>
            <td><?php echo $fact["PAGO"];?></td>
          </tr>
          <?php
                $lineas = consulta_linea($conexion, $fact["NUMFACTURA"], $oid);
                $n = 1;
                foreach($lineas as $linea) { ?>
          <tr>
            <th>
              Línea de Factura
              <?php echo $n; ?>
            </th>
            <td></td>
          </tr>
          <tr>
            <td>Pieza:</td>
            <td><?php echo $linea["NOMBRE"];?></td>
          </tr>
          <tr>
            <td>Unidades:</td>
            <td><?php echo $linea["CANTIDAD"];?></td>
          </tr>
          <tr>
            <td>Precio unitario:</td>
            <td><?php echo $linea["PRECIOUNITARIO"]." €";?></td>
          </tr>
          <?php $n++; } ?>

          <tr>
            <td id="id_importe"><h3>Importe total:</h3></td>
            <td id="id_pago">
              <h3><?php echo $fact["MANODEOBRA"] + $fact["IMPORTE"]." €";?></h3>
            </td>
          </tr>
        </table>
      </main>

      <?php 
        $i++;
    } ?>

      <?php
    if($i == 0) { ?>
      <h2>
        La factura correspondiente a la reparación con ID
        <?php echo $oid ?>
        no está disponible aún. Disculpe las molestias. Pulse <a href="consulta.php">aquí</a> para volver.
      </h2>

      <?php
    } ?>       
    </div>
    <?php if($i != 0) { ?>
      <div id="id_divEnviar">
        <button title="Descargar Factura" id="id_enviar" onclick="convertirPDF()">
          Descargar
        </button>
      </div>
      <div id="id_divVolver">
      <button title="Volver atrás" id="id_volver">
          <a href="consulta.php">Volver</a>
        </button>
    </div>
      <?php 
    }
		include_once("../Otros/validacion.html");
    ?>
  </body>
  
</html>

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style_faq.css" />
    <title>F.A.Q</title>
</head>

<body>

    <?php
        include_once("../Otros/cabecera.php");
    ?>

    <main>
    <h1>Preguntas frecuentes</h1>

    <?php if(!isset($_SESSION["admin"])) { ?>
    <div class="div">
        <h3>P1.-¿Es necesario registrarme en la página para utilizar las funcinalidades de la web?</h3>
        <p>Para utilizar al completo nuestra web, es necesario un registro previo, que podrás realizar pulsando 
            <a title="Regístrese" href="../ClienteCL/formulario_usuario.php"> aquí</a> 
        . Una vez registrado, se podrá iniciar sesión mediante el DNI y la contraseña del cliente. Tenga en
        cuenta que no se admiten varias cuentas por persona.       
        </p>
    </div>
    <div class="div">
        <h3>P2.-¿Cómo puedo registrar/visualizar/modificar/eliminar un vehículo?</h3>
        <p>El registro de vehículos se podrá realizar pulsando <a href="../VehiculoCL/formulario_vehiculo.php"> aquí</a>. 
        Es posible registrar tanto coches como motocicletas. Tenga en cuenta los campos marcados como obligatorio. Si desea 
        visualizar o modificar algún vehículo, ya sea por un error o simplemente para modificar algún campo, siempre puede acceder a él 
        a través del apartado <a title="Mis Vehículos" href="../VehiculoCL/mis_vehiculos.php">Mis Vehículos</a> localizado en la parte superior 
        de la web tras iniciar sesión. Tambíen se podrá eliminar un vehículo <b>siempre que no tenga citas asociadas</b>.</p>
    </div>
    <div class="div">
        <h3>P3.-¿Cómo puedo solicitar una cita?</h3>
        <p>Puedes solicitar un cita mediante el apartado solicitar cita que podrá encontrar en el menu superior de la web si ya a iniciado sesión, 
            también te dejo aquí un <a title="Solicitar Cita" href="../CitaCL/home.php">link</a> que te llevará a esa misma página.
            Para solicitar una cita es necesario haber registrado el vehículo que desea reparar.</p>
    </div>
    <div class="div">
        <h3>P4.-¿Cómo puedo ver las citas/reparaciones que ya he realizado?</h3>
        <p>Para visualizar las citas anteriores, donde puede ver información acerca de ella o de la factura en el caso de que esta se encuentre
        disponible, podrá acceder a través del apartado <a title="Consultas" href="../CitaCL/selecciona_vehiculo.php">Consulta</a>. Se le pedirá 
        introducir el vehículo del que desea visualizar la/s cita/s. Una vez dentro, tendrá a su disposición toda la información sobre la cita y
         un botón para ver la factura, donde se da la posibilidad de descargarla en formato PDF. 
        </p>
    </div>
    <div class="div">
        <h3>P5.-¿Cómo puedo ver/editar mis datos personales?</h3>
        <p>Una vez iniciado sesión podrá ver y editar su perfil pulsando el logo de la esquina superior derecha, le dejo por 
            <a title="Mis Datos" href="../ClienteCL/perfil.php">aquí</a> un link que te llevará a dicha página. Una vez dentro podrá editar sus 
            datos fácilmente.
        </p>
    </div>
    <?php } else { ?>
    <div class="div">
        <h3>P1.-¿Cómo visualizar/modificar las reparaciones?</h3>
        <p>Debes pulsar en el menú superior el apartado de <a title="Reparaciones" href="../ReparacionesAD/home.php">Reparaciones</a>,
         ahí ya podrás ver todos los datos relacionados con las reparaciones. Si se desea modificar una factura simplemente se pulsará
          en el botón inferior de la reparación deseada.</p>
    </div>
    <div class="div">
        <h3>P2.-¿Cómo visualizar/modificar/eliminar los proveedores?</h3>
        <p>Debes pulsar en el menú superior el apartado <a title="Proveedores" href="../Proveedor/proveedores.php">Proveedores</a>. 
        Desde aquí tendremos acceso a los datos sobre proveedores (email, teléfono, tipo...).</p>
        <p><b>*SOLO JEFE*</b> Se podrá modificar los datos o eliminar un proveedor siempre que lo desee desde el mismo apartado mencionado anteriormente.</p>
    </div>
    <div class="div">
        <h3>P3.-¿Cómo visualizar/modificar/eliminar los empleados del taller?</h3>
        <p>Podrás ver los empleados del taller en el apartado del menú <a title="Plantilla" href="../AdminAD/mecanicos.php">Mecánicos</a>.</p>
            <p><b>*SOLO JEFE*</b> Se podrá añadir, editar (ya sea nombre, apellido, especialidad o ascender a jefe) o incluso eliminar un empleado.</p>
    </div>
    <div class="div">
        <h3>P4.-¿Cómo crear/modificar las facturas de reparaciones?</h3>
        <p>En el caso de que una reparación no tenga asocidada ya una factura, podrás crearla pulsando sobre su respectivo botón, el cuál 
            prodrás encontrar en el apartado de reparaciones del menú en la parte superior de la web. Si por el contrario, ya tiene una
            factura creada, podrás visualizarla y editarla pulsando sobre su respectivo botón. 
        </p>
    </div>
    <div class="div">
        <h3>P5.-¿Cómo crear/eliminar líneas en una factura?</h3>
        <p>Cuando se encuentre en una factura, tendrá la posibilidad de añadir tantas líneas como sean 
        necesarias. Al añadir una línea deberá seleccionar el elemento y la cantidad utilizadas. En el caso de que desee eliminar, a la derecha
         de cada linea tendrá un botón que le permitirá realizar dicha acción. El cálculo del importe se realizará automáticamente añadiendo/borrando
          lineas.</p>
    </div>
    <div class="div">
        <h3>P6.-¿Cómo modifico mis datos personales?</h3>
        <p>Una vez iniciada sesión como empleado podrás acceder a tu perfil pulsando en el icono de la esquina superior derecha, 
            también podrás acceder pulsando el siguiente <a title="Mis Datos" href="../AdminAD/perfil.php">enlace</a>.
            En dicha página también será posible editar tus datos peronales</p>
    </div>
    <?php } ?>
    </main>
</body>
</html>
<link rel="stylesheet" type="text/css" href="../css/style_cabecera.css" />

<section id="id_superior">
    <header>
        <img id="id_logo" src="../img/logo.png" height="125px" alt="Logo EuroTyre" />


        <div>
            <?php
        if(isset($_SESSION["login"])){
            echo "Sesión: ".$_SESSION["login"]; ?>
            <a href="../Otros/login.php">Cerrar Sesión</a>
        <?php
        }else{?>
            <a href="../Otros/login.php">Iniciar Sesión</a>
        <?php
        }
        ?>

        </div>
        <nav class="menu"></nav>
            <ul>
                <li><a href="../Otros/nosotros.php">Nosotros</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="../Otros/terminos.php">Acerca</a></li>
            </ul>
        </nav>

        <nav class="menu2">
            <ul>
                <li><a href="../CitaCL/home.php">Solicitar cita</a></li>
                <li><a href="../CitaCL/consulta.php">Consulta</a></li>
                <li><a href="../VehiculoCL/mis_vehiculos.php">Mis Vehículos</a></li>
            </ul>
        </nav>
    </header>
</section>

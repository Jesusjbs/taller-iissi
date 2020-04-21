<link rel="stylesheet" type="text/css" href="./css/style_cabecera.css" />

<section id="id_superior">
    <header>
        <img id="id_logo" src="./img/logo.png" height="125px" alt="Logo EuroTyre" />


        <div>
            <?php
        if(isset($_SESSION["login"])){
            echo "Sesión: ".$_SESSION["login"]; ?>
            <a href="login.php">Cerrar Sesión</a>
        <?php
        }else{?>
            <a href="login.php">Iniciar Sesión</a>
        <?php
        }
        ?>

        </div>
        <nav class="menu">
            <ul>
                <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="terminos.php">Acerca</a></li>
            </ul>
        </nav>

        <nav class="menu2">
            <ul>
                <li><a href="home.php">Solicitar cita</a></li>
                <li><a href="consulta.php">Consulta</a></li>
                <li><a href="mis_vehiculos.php">Mis Vehículos</a></li>
            </ul>
        </nav>
    </header>
</section>

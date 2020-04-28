<link rel="stylesheet" type="text/css" href="../css/style_cabecera.css" />

<section id="id_superior">
    <header>
        <img id="id_logo" src="../img/logo.png" height="125px" alt="Logo EuroTyre" />

        <div>
            <?php
        if(isset($_SESSION["admin"])){ ?>
            <a href="../AdminAD/Perfil.php"> <?php echo "Sesión: ".$_SESSION["admin"]; ?></a>
            <a href="../Otros/login.php">Cerrar Sesión</a>
            <a href="../AdminAD/Perfil.php" ><img id="id_logo" src="../img/UserLogo.png"  style="width: 45px; height=50px;" alt="Logo User" /></a>
        <?php
        } else{ ?>
            <a href="../Otros/login.php">Iniciar Sesión</a>
        <?php
        }
        ?>

        </div>
        <nav class="menu"></nav>
            <ul>
                <li><a href="#">Consulta</a></li>
                <li><a href="#">Consulta</a></li>
                <li><a href="#">Consulta</a></li>
            </ul>
        </nav>

        <nav class="menu2">
            <ul>
                <li><a href="#">Reparaciones</a></li>
                <li><a href="../Proveedor/proveedores.php">Proveedores</a></li>
                <li><a href="../AdminAD/mecanicos.php">Mecánicos</a></li>
            </ul>
        </nav>
    </header>
</section>

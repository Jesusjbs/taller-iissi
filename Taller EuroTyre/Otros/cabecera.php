<link rel="stylesheet" type="text/css" href="../css/style_cabecera.css" />

<div id="id_superior">
    <header>

            <?php
        if(isset($_SESSION["login"])){ ?>
            <img id="id_logo" src="../img/logo.png" alt="Logo EuroTyre" />

            <div id="id_divPerfil">
                <div id="id_divSesion">Sesión: <a title="Mi Perfil" href="../ClienteCL/Perfil.php"><?php echo " ".$_SESSION["login"]; ?></a></div>
                <div><a title="Cerrar Sesión" href="../Otros/login.php">Cerrar Sesión</a></div>
                <div id="id_userLogo"><a title="Mi Perfil" href="../ClienteCL/Perfil.php" ><img id="id_logoUser" src="../img/UserLogo.png" alt="Logo User" /></a></div>
            </div>    
        <?php
        } else if(isset($_SESSION["admin"])) { ?>
            <img id="id_logo" src="../img/logo.png" alt="Logo EuroTyre" />

            <div id="id_divPerfil">
                <div id="id_divSesion">Sesión: <a title="Mi Perfil" href="../AdminAD/Perfil.php"> <?php echo " ".$_SESSION["admin"]; ?></a></div>
                <div><a title="Cerrar Sesión" href="../Otros/login.php">Cerrar Sesión</a></div>
                <div id="id_userLogo"><a title="Mi Perfil" href="../AdminAD/Perfil.php" ><img id="id_logoUser" src="../img/UserLogo.png" alt="Logo User" /></a></div>            
            </div>
        <?php } else{ ?>
            <img id="id_logoFix" src="../img/logo.png" alt="Logo EuroTyre" />
            
            <div id="id_divInicia">
                <a title="Iniciar Sesión" href="../Otros/login.php">Iniciar Sesión</a>
            </div>
        <?php
        }
        ?>
    
        <nav class="menu">
            <ul>
                <li><a title="Nosotros" href="../Otros/nosotros.php">Nosotros</a></li>
                <li><a title="F.A.Q" href="../Otros/faq.php">F.A.Q</a></li>
                <li><a title="Acerca" href="../Otros/terminos.php">Acerca</a></li>
            </ul>
        </nav>

        <?php if(isset($_SESSION["login"])) { ?>
        <nav class="menu2">
            <ul>
                <li><a title="Solicitar Cita" href="../CitaCL/home.php">Solicitar cita</a></li>
                <li><a title="Consulta" href="../CitaCL/selecciona_vehiculo.php">Consulta</a></li>
                <li><a title="Mis Vehículos" href="../VehiculoCL/mis_vehiculos.php">Mis Vehículos</a></li>
            </ul>
        </nav>
        <?php } else if(isset($_SESSION["admin"])) { ?>
            <nav class="menu2">
            <ul>
                <li><a title="Reparaciones" href="../ReparacionesAD/home.php">Reparaciones</a></li>
                <li><a title="Proveedores" href="../Proveedor/proveedores.php">Proveedores</a></li>
                <li><a title="Mecánicos" href="../AdminAD/mecanicos.php">Mecánicos</a></li>
            </ul>
        </nav>
        <?php } ?>
    </header>
</div>

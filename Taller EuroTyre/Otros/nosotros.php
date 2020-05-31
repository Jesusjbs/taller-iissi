<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Nosotros</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style_nosotros.css" />

		<link rel="shortcut icon" href="../img/logo.png">
		<link rel="apple-touch-icon" href="../img/logo.png">
	</head>

	<body>
        <?php
            include_once("cabecera.php");
		?>
		
		<div class="id_div">
			<h1>Sobre nosotros</h1>
			<p>Nuestro taller se encuentra en Avenida Parque Norte Nº35, 
				Los Palacios y Villafranca, Sevilla. Fue fundada en el año 1985 y lleva ofreciendo sus servicios en esta 
				última localización durante 20 años.
				Este taller se dedica a la reparación de automóviles (turismos, furgonetas, deportivos…) y 
				motocicletas. Concretamente se especializa en el cambio de 
				neumáticos y reparaciones mecánicas a pequeña escala. Cuando hablamos de Eurotyre, 
				tenemos la certeza, garantía y calidad de los servicios prestados por profesionales reconocidos por su experiencia.🔱</p>
		</div>
        <div class="id_div">
            <iframe id="id_mapa" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12717.284092537944!2d-5.9281702!3d37.1688412!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x86ce872bf6b20ac9!2sEuro%20Tyre!5e0!3m2!1ses!2ses!4v1585501153678!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		</div>

		<div class="center">
            <div class="front-face">
            <img src="../img/logo.png" style="position:absolute;width:250px;height:200px;margin-top: 10%;margin-left: -43%;"/> 
                <div class="contents front">
                    <p>Taller EuroTyre</p>
                    <span>Tu taller de confianza</span>
                </div>
            </div>
            <div class="back-face">
                <div class="contents_back">
                    <h2>Taller Eurotyre</h2>
                    <span>Síguenos</span>
                    <div class="icons">
                        <a target="_blank" href="https://m.facebook.com/Eurotyre-1942028509455716/?ref=bookmarks"><img src="../img/fb.png" style="width:50px;height:50px;"/></a>
                        <a target="_blank" href="https://mobile.twitter.com/EurotyreEs"><img src="../img/twitter.png" style="width:50px;height:50px;"/></a>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="id_inferior">
			<footer id="id_footer">
				<div id="id_divValidaCSS">
					<a href="http://jigsaw.w3.org/css-validator/check/referer">
						<img style="border:0;width:88px;height:31px"
							src="http://jigsaw.w3.org/css-validator/images/vcss"
							alt="¡CSS Válido!" />
					</a>
				</div>
				<div id="id_divValidaHTML">
					<img style="border:0;width:88px;height:31px;cursor:pointer" src="../img/valid_icon.png" alt="¡HTML Válido!" />
				</div>
				<p>Al usar este sitio, reconoces haber leído y entendido nuestra <a href="terminos.php">Política de Privacidad y nuestros Términos y Condiciones</a>.</p>
			</footer>
		</div>
	</body>
</html>
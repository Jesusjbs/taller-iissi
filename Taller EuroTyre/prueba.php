<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
		<title>Prueba</title>
		<link rel="stylesheet" type="text/css" href="./css/prueba.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
		const password = document.querySelector('.password');
		
		function valid(item, v_icon, inv_icon) {
			let text = document.querySelector(`#${item}`);
			text.style.opacity = "1";
			let valid_icon = document.querySelector(`#${item} .${v_icon}`);
			valid_icon.style.opacity = '1';
			let invalid_icon = document.querySelector(`#${item} .${inv_icon}`);
			invalid_icon.style.opacity = '0';
		}
		
		function invalid(item, v_icon, inv_icon) {
			let text = document.querySelector(`#${item}`);
			text.style.opacity = ".5";
			let valid_icon = document.querySelector(`#${item} .${v_icon}`);
			valid_icon.style.opacity = '0';
			let invalid_icon = document.querySelector(`#${item} .${inv_icon}`);
			invalid_icon.style.opacity = '1';		
		}
		
		function textChange() {
			if(password.value.match(/[A-Z]/) != null)
				valid('capital', 'fa-check', 'fa-times');
			else
				invalid('capital', 'fa-check', 'fa-times');
			if(password.value.match(/[0-9]/) != null)
				valid('num', 'fa-check', 'fa-times');
			else
				invalid('num', 'fa-check', 'fa-times');
			if(password.value.match(/[!@#$%^&*]/) != null)
				valid('char', 'fa-check', 'fa-times');
			else
				invalid('char', 'fa-check', 'fa-times');		
			if(password.value.length > 5)
				valid('more8', 'fa-check', 'fa-times');
			else
				invalid('more8', 'fa-check', 'fa-times');			
		}
		
		let show_hide = document.querySelector('#show_hide');
			
		function showHide() {
			if(show_hide.className == "fas fa-eye") {
				show_hide.className = "fas fa-eye-slash";
				password.type = "text";
			}
			else {
				show_hide.className = "fas fa-eye";
				password.type = "password";
			}
		}
		</script>
	</head>

	<body>
		<!--<div class="container">
			<input type="password" class="password"
				placeholder="Introduce tu contraseña" oninput="textChange()" required />
			<i class="fas fa-eye" id="show_hide" onclick="showHide()" >Pulsa</i>
			<i class="fas fa-eye-slash" id="show_hide" onclick="showHide()">Pulsa</i> 
			<p id="capital">
				<i class="fas fa-times"></i>
				<i class="fas fa-check"></i>
				<span>Letras Mayúsculas</span>
			</p>
			<p id="char">
				<i><img class="fas fa-times" stile="width: 10px; height: 10px;" src="./img/tick.png" /></i>
				<i class="fas fa-check"><img class="fas fa-check" stile="width: 10px; height: 10px;" src="./img/false.png"/></i>
				<span>Caracteres especiales</span>
			</p>
			<p id="num">
				<i class="fas fa-times"></i>
				<i class="fas fa-check"></i>
				<span>Números</span>
			</p>	
			<p id="more8">
				<i class="fas fa-times"></i>
				<i class="fas fa-check"></i>
				<span>6+ caracteres</span>
			</p>
		</div> -->

		<input type="checkbox" id="click2">

		<div class="alert warning">
			<i>!</i>
			<span><strong>Warning</strong>Si elimina el vehículo desaparecerán las citas asociadas a él.</span>
			<div id="id_cierre">
				<label for="click2">X</label>
			</div>
		</div>

	</body>
</html>
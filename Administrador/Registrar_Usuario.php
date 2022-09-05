<?php
    session_start();
    if (!isset($_SESSION['active'])) {
        header('location: ../Login/Iniciar_Sesion.php');
    } else {
        if ($_SESSION['Rol'] != 'ADMINISTRADOR DE SISTEMAS') {
            header('location: ../Login/Iniciar_Sesion.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_inicio.css">
    <link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
</head>
<body>
    <?php
      $inicio = "";
      $registrar_usuario = "active";
      $recuperar_contraseña = "";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
    <div class=" row justify-content-center m-0 mt-5 mb-4">
		
		<form class="needs-validation cuadroBienvenida" novalidate>
		<p class="text-center mb-4 registrarUsuario">Registrar Usuario</p>
		<div class="form-row">
	    	<div class="col-md-4 mb-3">
	      	<label for="validationCustom">Nombres</label>
	      	<input type="text" class="form-control" id="validationCustom" placeholder="Nombres" required>
	    	</div>
	    	<div class="col-md-4 mb-3">
	      	<label for="validationCustom">Apellido Paterno</label>
	      	<input type="text" class="form-control" id="validationCustom" placeholder="Apellido Paterno" required>
	    	</div>
	    	<div class="col-md-4 mb-3">
	      	<label for="validationCustom">Apellido Materno</label>
	      	<input type="text" class="form-control" id="validationCustom" placeholder="Apellido Materno" required>
	    	</div>
		</div>
		<div class="form-row">
	    	<div class="col-md-6 mb-3">
	      	<label for="validationCustom">Usuario</label>
	      	<input type="text" class="form-control" id="validationCustom" placeholder="Usuario" required>
	    	</div>
	    	<div class="col-md-6 mb-3">
	      		<label for="validationCustom">Contraseña</label>
				<div class="input-group" id="show_password">
	      			<input type="password" class="form-control" placeholder="Contraseña" required>
					<button type="button" class="verPassword input-group-addon">
						<a href=""><i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i></a>
					</button>
				</div>
	    	</div>
			
	  	</div>

	  	<div class="form-row align-items-center">
			<div class="form-check col-md-4 mb-3 text-center">
		    	<div class="form-check">
		      		<input class="form-check-input" type="checkbox" id="gridCheck">
		      		<label class="form-check-label" for="gridCheck">
		        		Contraseña Temporal
		      		</label>
		    	</div>
			</div>
			<div class="col-md-4 mb-3" >
	      		<label >Rol</label >
				<select class="custom-select my-1 mr-sm-2" required>
					<option value="" selected disabled>Seleciona</option >
    				<option>Docente</option >
				    <option>Alumno</option >
				</select>
			</div>
			<div class="form-check col-md-4 text-center mb-3" >
	      		<label for="validationCustom">Estatus</label>
			  	<div>
					<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" id="inputActivo" name="radio-stacked" required>
						<label class="custom-control-label" for="inputActivo">Activo</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" id="inputInactivo" name="radio-stacked" required>
						<label class="custom-control-label" for="inputInactivo">Inactivo</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="gridCheck">
		      			<label class="form-check-label" for="gridCheck">
		        			Bloqueado
		      			</label>
					</div>
				</div>
		    </div>
	  	</div>
	  	<div class="form-row justify-content-around">
		    <div class="col-md-4 mb-3">
		    	<label for="disabledTextInput">Usuario que registra</label>
		      	<input class="form-control" id="disabledInput" type="text" placeholder="" disabled>
		    </div>
 
		    <div class="col-md-4 mb-3">
		    	<label for="disabledTextInput">Fecha</label>
		      	<input class="form-control" id="disabledInput" type="text" placeholder="" disabled>
		    </div>
	  	</div>
	  	<div class="form-row justify-content-center">
	  	<button class="btn btn-primary" type="submit">Guardar</button>
	  	</div>
		</form>
	</div>
</body>
<script>
	// deshabilitar el envío de formularios si hay campos no válidos
	(function() {
	  'use strict';
	  window.addEventListener('load', function() {
	    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap 
	    var forms = document.getElementsByClassName('needs-validation');
	    // Bucle sobre ellos y evitar la presentación
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
	        }
	        form.classList.add('was-validated');
	      }, false);
	    });
	  }, false);
	})();

	$(document).ready(function() {
    $("#show_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_password input').attr("type") == "text"){
            $('#show_password input').attr('type', 'password');
            $('#show_password i').addClass( "fa-eye-slash" );
            $('#show_password i').removeClass( "fa-eye" );
        }else if($('#show_password input').attr("type") == "password"){
            $('#show_password input').attr('type', 'text');
            $('#show_password i').removeClass( "fa-eye-slash" );
            $('#show_password i').addClass( "fa-eye" );
        }
    });
});
</script>
</html>
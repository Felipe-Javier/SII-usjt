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
	<title>SII</title>
	<?php
        include("../incluir/metas.php");
        include("../incluir/links.php");
    ?>
	<!--<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">-->
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_registrar_usuario.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>-->
	<?php
        include("../incluir/scripts.php");
    ?> 
	<script type="text/javascript" src="js/registrar_usuario.js"></script>
</head>
<body>
    <?php
      $inicio = "";
      $registrar_usuario = "active";
      $recuperar_contraseña = "";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
	<div class=" row justify-content-center m-0 mt-4 mb-2">
		<div class="fondoGeneral">
			<div class="input-group" id="search-autocomplete">
				<input type="search" name="clave" id="clave" placeholder="Ingrese el número de empleado o la matricula segun sea el caso" 
				class="form-control col-md-8"/>
				<select name="tipo_persona" id="tipo_persona" class="form-control col-md-4">
					<option value="">-- Tipo de persona --</option>
					<option value="PERSONAL">Personal de la institución</option>
					<option value="ALUMNOS">Alumnos</option>
				</select>
				<div class="input-group-append">
					<button type="button" class="input-text form-control btn btn-primary" id="buscar">Buscar</button>
				</div>
			</div>
		</div>
	</div>
    <div class=" row justify-content-center m-0 mt-2 mb-4">
		<form class="needs-validation fondoGeneral" novalidate>
			<p class="text-center mb-4 registrarUsuario">Registrar Usuario</p>
			<div class="form-row">
				<div class="col-md-4 mb-3">
				<label for="validationCustomNS">Nombres</label>
				<input type="text" class="form-control" id="validationCustomNS" placeholder="Nombres" required>
				</div>
				<div class="col-md-4 mb-3">
				<label for="validationCustomAP">Apellido Paterno</label>
				<input type="text" class="form-control" id="validationCustomAP" placeholder="Apellido Paterno" required>
				</div>
				<div class="col-md-4 mb-3">
				<label for="validationCustomAM">Apellido Materno</label>
				<input type="text" class="form-control" id="validationCustomAM" placeholder="Apellido Materno" required>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
				<label for="validationCustomU">Usuario</label>
				<input type="text" class="form-control" id="validationCustomU" placeholder="Usuario" required>
				</div>
				<div class="col-md-5 mb-3">
				<label for="validationCustomP">Contraseña</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
				</div>
				<button class="col-sm-1 verPassword" type="button"><i class="fa fa-eye-slash fa-2x"></i></button>
			</div>
			<div class="form-row align-items-center">
				<div class="col-md-4 mb-3 text-center">
					<label for="validationCustom">Contraseña Temporal</label>
					<!--<div class="form-check">
						<input class="form-check-input" type="checkbox" id="gridCheck">
						<label class="form-check-label" for="gridCheck">Si</label>
					</div>-->
					<div class="form-inline justify-content-center">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputCT1" name="inputCT" value="1" required>
							<label class="custom-control-label" for="inputCT1">Sí</label>
						</div>
						<div class="ml-5 custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputCT0" name="inputCT" value="0" required>
							<label class="custom-control-label" for="inputCT0">No</label>
						</div>
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
				<div class="col-md-4 text-center mb-3">
					<label for="validationCustom">Estatus</label>
					<div class="form-inline justify-content-center">
						<label class="text-left" for="inputActivo">Activo</label>
						<div class="ml-3 custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputActivo" name="inputActivo" value="1" required>
							<label class="custom-control-label" for="inputActivo">Sí</label>
						</div>
						<div class="ml-3 custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputInactivo" name="inputActivo" value="0" required>
							<label class="custom-control-label" for="inputInactivo">No</label>
						</div>
					</div>
					<div class="form-inline justify-content-center">
						<label class="" for="inputBloqueado">Bloqueado</label>
						<div class="ml-3 custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputBloqueado" name="inputBloqueado" value="1" required>
							<label class="custom-control-label" for="inputBloqueado">Sí</label>
						</div>
						<div class="ml-3 custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="inputDesbloqueado" name="inputBloqueado" value="0" required>
							<label class="custom-control-label" for="inputDesbloqueado">No</label>
						</div>
					</div>
				</div>
						<!--<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck">
							<label class="form-check-label" for="gridCheck">Bloqueado</label>
						</div>-->
			</div>
			<div class="form-row justify-content-around">
				<div class="col-md-5 mb-3">
					<label for="Usuario">Usuario que registra</label>
					<input class="form-control" id="Usuario" type="text" value="<?php echo $_SESSION['Empleado'] ?>" 
					  IdEmpleado="<?php echo $_SESSION['IdUsuario'] ?>" disabled>
				</div>
				<!--<div class="col-md-4 mb-3">
					<label for="FechaHoraActual">Fecha</label>
					<input class="form-control" id="FechaHoraActual" type="text" value="" disabled>
				</div>-->
			</div>
			<div class="form-row justify-content-center">
				<button class="btn btn-primary" type="submit">Guardar</button>
			</div>
		</form>
	</div>
</body>
</html>
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
      $recuperar_contrase??a = "";
	  $cambiar_contrase??a = "";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
	<div class=" row justify-content-center m-0 mt-4 mb-2">
		<form id="form-searchuser" class="fondoGeneral col-md-8 needs-validation" novalidate>
			<p class="text-center mb-4 registrarUsuario">Busqueda de Empleado/Alumno</p>
			<div class="input-group" id="search">
				<input name="clave" type="search" class="form-control col-md-8" id="clave" placeholder="N??mero de empleado o matricula"
				  required />
				<select name="tipo_persona" id="tipo_persona" class="custom-select col-md-4" required>
					<option value="" selected disabled>-- Tipo de persona --</option>
					<option value="PERSONAL_GENERAL">Personal en general</option>
					<option value="DOCENTES">Docentes</option>
					<option value="ALUMNOS">Alumnos</option>
				</select>
				<div class="input-group-append">
					<button type="submit" class="input-text btn btn-brown" id="buscar">Buscar</button>
				</div>
			</div>
		</form>
	</div>
    <div class=" row justify-content-center m-0 mt-2 mb-4">
		<form id="form-reguser" class="fondoGeneral col-md-8 needs-validation" novalidate>
			<p class="text-center mb-4 registrarUsuario">Registro de Usuario</p>
			<div class="form-row" id="row-nomcompleto">
				<div class="col-md-4 mb-3">
					<label class="label-titles" for="Nombres">Nombres</label>
					<input type="text" class="form-control text-center" id="Nombres" value="" required>
				</div>
				<div class="col-md-4 mb-3">
					<label class="label-titles" for="Apellido_Paterno">Apellido Paterno</label>
					<input type="text" class="form-control text-center" id="Apellido_Paterno" value="" required>
				</div>
				<div class="col-md-4 mb-3">
					<label class="label-titles" for="Apellido_Materno">Apellido Materno</label>
					<input type="text" class="form-control text-center" id="Apellido_Materno" value="" required>
				</div>
			</div>
			<div class="form-row justify-content-center" id="row-claves-persona"></div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="label-titles" for="Usuario">Usuario</label>
					<input type="text" class="form-control text-center" id="Usuario" value="" required>
				</div>
				<div class="col-md-6 mb-3">
					<label class="label-titles" for="Password">Contrase??a</label>
					<!--<div class="form-inline">-->
						<div class="input-group" id="show_password">
							<input type="password" class="form-control text-center" name="Password" id="Password" value="" required>
							<button type="button" class="verPassword input-group-addon" id="btn-showPassword">
								<i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
							</button>
						</div>
					<!--</div>-->
				</div>
			</div>
			<div class="form-row align-items-center">
				<div class="col-md-4 mb-3 text-center">
					<label class="label-titles" for="PassTemp">Contrase??a Temporal</label>
					<div class="form-inline justify-content-center">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input PassTemp" name="PassTemp" id="PassTemp_1" value="1" required>
							<label class="custom-control-label label-text" for="PassTemp_1">S??</label>
						</div>
						<div class="ml-5 custom-control custom-radio">
							<input type="radio" class="custom-control-input PassTemp" name="PassTemp" id="PassTemp_0" value="0" required>
							<label class="custom-control-label label-text" for="PassTemp_0">No</label>
						</div>
					</div>
				</div>
				<div class="col-md-4 mb-3" >
					<label class="label-titles" for="Rol_Usuario">Rol</label >
					<select class="custom-select my-1 mr-sm-2" name="Rol_Usuario" id="Rol_Usuario" required>
						<option value="" selected disabled>Seleciona</option>
					</select>
				</div>
				<div class="col-md-4 text-center mb-3">
					<label class="label-titles" for="status">Status</label>
					<div class="form-inline justify-content-center">
						<label class="label-text" name="status" for="ActInact">Activo</label>
						<div class="ml-3 custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input ActInact" name="ActInact" id="Activo" value="1" required>
							<label class="custom-control-label label-text" for="Activo">S??</label>
						</div>
						<div class="ml-3 custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input ActInact" name="ActInact" id="Inactivo" value="0" required>
							<label class="custom-control-label label-text" for="Inactivo">No</label>
						</div>
					</div>
					<div class="form-inline justify-content-center">
						<label class="label-text" name="status" for="BloqDesbloq">Bloqueado</label>
						<div class="ml-3 custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input BloqDesbloq" name="BloqDesbloq" id="Bloqueado" value="1" required>
							<label class="custom-control-label label-text" for="Bloqueado">S??</label>
						</div>
						<div class="ml-3 custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input BloqDesbloq" name="BloqDesbloq" id="Desbloqueado" value="0" required>
							<label class="custom-control-label label-text" for="Desbloqueado">No</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-row justify-content-around">
				<div class="col-md-5 mb-3">
					<label class="label-titles" for="UsuarioReg">Usuario que registra</label>
					<input class="form-control" id="UsuarioReg" type="text" value="<?php echo $_SESSION['Empleado'] ?>" 
					  IdUsuarioReg="<?php echo $_SESSION['IdUsuario'] ?>" disabled>
				</div>
			</div>
			<div class="form-row justify-content-center">
				<button class="btn btn-brown" type="submit">Guardar</button>
			</div>
		</form>
	</div>
</body>
</html>
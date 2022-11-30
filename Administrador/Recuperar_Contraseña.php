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
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_recuperar_contraseña.css">
    <?php
        include("../incluir/scripts.php");
    ?>
    <script type="text/javascript" src="js/recuperar_contraseña.js"></script>
</head>
<body>
    <?php
      $inicio = "";
      $registrar_usuario = "";
      $recuperar_contraseña = "active";
      $cambiar_contraseña = "";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
    <div class="row justify-content-center m-0 mt-5 mb-4">
        <div class="fondo-general col-sm-4 p-4">
            <p class="text-center mb-4 recuperarPassword">Recuperación de contraseña de usuarios</p>
            <form id="form-recpass" class="needs-validation" novalidate>
                <div class="row" id="result"></div>
                <div class="form-group">
                    <label class="title-input" for="Usuario">Usuario</label>
                    <input type="text" class="form-control text-center" id="Usuario" value="" required>
                </div>
                <div class="form-group">
                    <label class="title-input" for="RolUsuario">Rol de Usuario</label>
                    <select class="custom-select my-1 mr-sm-2" name="RolUsuario" id="RolUsuario" required>
						<option value="" selected disabled>Seleciona</option>
					</select>
                </div>
                <div class="form-group" id="NumEmpleado"></div>
                <div class="form-group">
                    <label class="title-input" for="Pass">Nueva Contraseña</label>
                    <div class="input-group" id="show_password">
                        <input type="password" class="form-control text-center" id="Pass" value="" required>
                        <button type="button" class="verPassword input-group-addon" id="btn-verPass">
                            <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="title-input" for="PassConfirm">Confirmar Contraseña</label>
                    <div class="input-group" id="show_password_confirm">
                        <input type="password" class="form-control text-center" id="PassConfirm" value="" required>
                        <button type="button" class="verPassword input-group-addon" id="btn-verPassConfirm">
                            <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="title-input" for="PassTemp">Contraseña Temporal</label>
					<div class="input-group">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input PassTemp" name="PassTemp" id="PassTemp_1" value="1" required>
							<label class="custom-control-label" for="PassTemp_1">Sí</label>
						</div>
						<div class="ml-5 custom-control custom-radio">
							<input type="radio" class="custom-control-input PassTemp" name="PassTemp" id="PassTemp_0" value="0" required>
							<label class="custom-control-label" for="PassTemp_0">No</label>
						</div>
					</div>
                </div>
                <div class="form-group">
                    <label class="title-input" for="UsuarioActualiza">Usuario que actualiza</label>
                    <input type="text" class="form-control text-center" id="UsuarioActualiza" value="<?php echo $_SESSION['Empleado']; ?>" 
                    IdUsuarioAct="<?php echo $_SESSION['IdUsuario'] ?>" required disabled>
                </div>
                <div class="form-group text-center mt-5">
	  	            <button type="submit" class="btn btn-brown" id="btn-actualizar">Actualizar</button>
                </div>
            </form>
        <div>
    </div>
</body>
</html>
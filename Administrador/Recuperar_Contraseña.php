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
	<!--<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>-->
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

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
    <div class="row justify-content-center m-0 mt-5 mb-4">
        <div class="fondo-general col-sm-4 p-4">
            <p class="text-center mb-4 recuperarPassword">Recuperación de contraseña</p>
            <form id="form-recpass" class="needs-validation" novalidate>
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
                    <label class="title-input" for="UsuarioActualiza">Usuario que actualiza</label>
                    <input type="text" class="form-control text-center" id="UsuarioActualiza" value="<?php echo $_SESSION['Empleado']; ?>" 
                    IdUsuarioAct="<?php echo $_SESSION['IdUsuario'] ?>" required disabled>
                </div>
                <div class="form-group text-center mt-5">
	  	            <button type="submit" class="btn btn-primary" id="btn-actualizar">Actualizar</button>
                </div>
            </form>
        <div>
    </div>
</body>
</html>
<?php
    session_start();
    if (!isset($_SESSION['active'])) {
        header('location: ../Login/Iniciar_Sesion.php');
    } else {
        if ($_SESSION['Rol'] != 'ALUMNO') {
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
        <link rel="stylesheet" type="text/css" href="css/styles_cambio_de_contraseña_general.css">
        <?php
        	include("../incluir/scripts.php");
    	?>
        <script type="text/javascript" src="js/cambiar_contraseña_general.js"></script>
    </head>
    <body>
        <?php
            $inicio = "";
            $boleta_calificaciones = "";
            $cambiar_contraseña = "active";
            
            include("incluir/header.php");
            include("incluir/navbar.php");
        ?>
        <div class="container mt-5">
            <div  class="row justify-content-center">
                <div class="fondo-general col-sm-5 p-4">
                    <p class="msj-general text-center">
                        Cambio de contraseña
                    </p>
                    <form method="post" class="form-cambio-password mt-4 needs-validation" id="cambio-contraseña-primera-vez" novalidate>
                        <div class="row" id="result"></div>
                        <div class="form-group">
                            <label for="user-name">Nombre de usuario</label>
                            <input type="text" class="form-control text-center" id="user-name" value="<?php echo $_SESSION['Usuario'] ?>"
                            idusuario="<?php echo $_SESSION['IdUsuario'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="validationCustom">Contraseña</label>
                            <div class="input-group" id="show_password">
                                <input type="password" class="form-control text-center border-input" id="password" value="" required>
                                <button type="button" class="verPassword input-group-addon" id="btn-show-Pass">
                                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirmar nueva contraseña</label>
                            <div class="input-group" id="show_password_confirm">
                                <input type="password" class="form-control text-center border-input" id="password-confirm" value="" required>
                                <button type="button" class="verPassword input-group-addon" id="btn-show-passConfirm">
                                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-primary" id="btn-continuar">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
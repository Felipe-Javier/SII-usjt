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
        <link rel="stylesheet" type="text/css" href="css/styles_cambio_de_contraseña_primera_vez.css">
        <?php
        	include("../incluir/scripts.php");
    	?>
        <script type="text/javascript" src="js/cambiar_contraseña_primera_vez.js"></script>
    </head>
    <body>
        <?php
        	include("incluir/header.php");
    	?>
        <nav class="navbar navbar-expand-lg navbar-light" >
            <a class="navbar-brand" href="#">En Linea</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarContent"
             aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="dropdown nav-item  ml-auto mr-auto ">
                        <a class="nav-link dropdown-toggler dropdown-toggle" href="#" role="button" data-toggle="collapse" data-target="#navbarDropdown"
                         aria-controls="navbarDropdown" aria-expanded="false"  aria-label="Toggle navigation" IdRol="<?php echo $_SESSION['IdRol']; ?>">
                            <i class="icon-user fas fa-user "></i>Bienvenido!, <?php echo $_SESSION['Rol']; ?>
                        </a>
                        <div class="no-hover dropdown-menu" id="navbarDropdown" role="menu" aria-labelledby="navbarDropdown" aria-expanded="false">
                            <span class="dropdown-item-text" IdUsuario="<?php echo $_SESSION['IdUsuario']; ?>" 
                            Usuario='<?php echo $_SESSION['Alumno']; ?>' RolUsuario='<?php echo $_SESSION['Rol']; ?>'>
                                <?php echo $_SESSION['Alumno']; ?>
                            </span>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item text-center" href="../Login/ajax/ajax_cerrar_sesion.php">Cerrar Sesion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-5">
            <div  class="row justify-content-center">
                <div class="fondo-general col-sm-5 p-4">
                    <p class="msj-general">
                        La contraseña con la que inicio sesion es temporal, es necesario que cambie su contraseña para continuar
                    </p>
                    <form method="post" class="form-cambio-password mt-4 needs-validation" id="cambio-contraseña-primera-vez" novalidate>
                        <div class="row" id="result"></div>
                        <div class="form-group">
                            <label for="user-name">Nombre de usuario</label>
                            <input type="text" class="form-control text-center" id="user-name" value="<?php echo $_SESSION['Usuario'] ?>"
                            IdUsuario="<?php echo $_SESSION['IdUsuario'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="validationCustom">Contraseña</label>
                            <div class="input-group" id="show_password">
                                <input type="password" class="form-control text-center" id="password" value="" required>
                                <button type="button" class="verPassword input-group-addon" id="btn-show-Pass">
                                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirmar nueva contraseña</label>
                            <div class="input-group" id="show_password_confirm">
                                <input type="password" class="form-control text-center" id="password-confirm" value="" required>
                                <button type="button" class="verPassword input-group-addon" id="btn-show-passConfirm">
                                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-brown" id="btn-continuar">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
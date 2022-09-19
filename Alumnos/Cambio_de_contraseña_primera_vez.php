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
        <!--<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>-->
        <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
        <link rel="stylesheet" type="text/css" href="css/styles_cambio_de_contraseña_primera_vez.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>-->
        <?php
            include("../incluir/scripts.php");
        ?>
        <script type="text/javascript" src="js/cambiar_contraseña.js"></script>
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
                            <i class="icon-user fas fa-user "></i>Bienvenido!, <?php echo $_SESSION['Rol'] ?>
                        </a>
                        <div class="no-hover dropdown-menu" id="navbarDropdown" role="menu" aria-labelledby="navbarDropdown" aria-expanded="false">
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
                            idusuario="<?php echo $_SESSION['IdUsuario'] ?>" disabled>
                        </div>
                        <div class="mb-3 form-group">
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
                        <div class="form-group text-center mb-1">
                            <button type="submit" class="btn btn-primary" id="btn-continuar">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
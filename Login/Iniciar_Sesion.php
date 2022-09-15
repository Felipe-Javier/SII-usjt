<?php
    session_start();
    if (!empty($_SESSION['active'])) {
		if ($_SESSION['Rol'] == 'DOCENTE') {
			header('location: ../Docentes/Inicio.php');
		} elseif ($_SESSION['Rol'] == 'ALUMNO') {
			header('location: ../Alumnos/Inicio.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Iniciar Sesion</title>
    <?php
        include("../incluir/metas.php");
        include("../incluir/links.php");
    ?>
    <link rel="stylesheet" href="css/styles_login.css">
    <?php
        include("../incluir/scripts.php");
    ?>
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
    <?php
        include("incluir/header.php");
    ?>

    <section class="container-fluid login">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form action="Iniciar_Sesion.php" method="post" class="form-container needs-validation" 
                id="login-SII" novalidate>
                    <div class="text-center mb-3"><i class="fas fa-user fa-5x"></i></div>
                    <div class="row" id="result"></div>
                    <div class="form-group">
                        <label for="rol_usuario">¿Eres docente o eres alumno?</label>
                        <select class="custom-select status text-center" name="tipo_identificacion" id="tipo_identificacion" required>
                            <option value="" selected disabled>SELECCIONA...</option>
                            <option value="PERSONAL">PERSONAL DE LA INSTITUCIÓN</option>
                            <option value="ALUMNOS">ALUMNOS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control status text-center" id="usuario" placeholder="Usuario" required> 
                    </div>
                    <div class="form-group">

                        <label for="password">Contraseña</label>
                        <div class="input-group" id="show_password">
                            <input type="password" class="form-control status text-center" id="password" placeholder="Contraseña" required>
                            <button type="button" class="verPassword input-group-addon" id="btn_show_password">
                                <i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="button_entrar">Entrar</button>
                    <div class="form-footer">
                        <p><a href="/" class="">¿Olvidó su contraseña?</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>
</body>
</html>
<!-- JAGUIRRE pruebaD3  Docente 
    210210002 Julio2022  alumno --> 

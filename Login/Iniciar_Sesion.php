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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles_login.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
   
</head>
<body>
    <?php
        include("incluir/header.php");
    ?>

    <section class="container-fluid login">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form action="Iniciar_Sesion.php" method="post" class="form-container" >
                    <div class="text-center mb-3"><i class="fas fa-user fa-5x"></i></div>
                    <div class="row" id="result"></div>
                    <div class="form-group">
                        <label for="InputUser">¿Eres docente o eres alumno?</label>
                        <select class="form-control text-center status" name="rol_usuario" id="rol_usuario">
                            <option selected disabled>SELECCIONA...</option>
                            <option value="DOCENTE">DOCENTE</option>
                            <option value="ALUMNO">ALUMNO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="InputUser">Usuario</label>
                        <input type="text" class="form-control" id="usuario" placeholder="Usuario"> 
                    </div>
                    <div class="form-group">
                        <label for="InputPasswordAlumno">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                    <button type="button" class="btn btn-primary btn-block" id="button_entrar">Entrar</button>
                    <div class="form-footer">
                        <p><a href="/" class="">¿Olvidó su contraseña?</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>
</body>
</html>
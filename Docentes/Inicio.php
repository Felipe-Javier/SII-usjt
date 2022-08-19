<?php
    session_start();
    if (!isset($_SESSION['active'])) {
        header('location: ../Login/Iniciar_Sesion.php');
    } else {
        if ($_SESSION['Rol'] != 'DOCENTE') {
            header('location: ../Login/Iniciar_Sesion.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SII</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
        <link rel="stylesheet" type="text/css" href="css/styles_inicio.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
    </head>
    <body>
        <?php
            $inicio = "active";
            $registrar_calificaciones = "";

            include("incluir/header.php");
            include("incluir/navbar.php");
        ?>
        
        <div  class="row justify-content-center mt-4">
            <div class="cuadroBienvenida col-sm-6 text-center p-5">
                <p class="msjBienvenida">Bienvenido</p>
                <p class="nomDocente" id="datos-usuario" 
                        IdUsuario="<?php echo $_SESSION['IdUsuario'] ?>" 
                        IdPersona="<?php echo $_SESSION['IdPersona'] ?>"
                        IdInstructor="<?php echo $_SESSION['IdInstructor'] ?>">
                        <?php echo $_SESSION['Empledo'] ?>
                </p>
            </div>
        </div>

    </body>
</html>
<!--<div class="container mt-4 text-center" id="contenido">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Bienvenido(a)</h4>
                </div>
                       </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Alumno(a): </h4>
                </div> 
                <div class="col-sm-12">
                    <p>Luis Cabrera Benito</p>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Matrícula: </h4>
                </div>
                 <div class="col-sm-12">
                    <p>12345</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Grado:</h4>
                    <p>4</p>
                </div>

                <div class="col-sm-6">
                    <h4>Grupo:</h4>
                    <p>A</p>
                </div>
            </div>
        </div>-->
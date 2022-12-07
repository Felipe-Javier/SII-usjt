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
    <link rel="stylesheet" type="text/css" href="css/styles_inicio.css">
    <?php
        include("../incluir/scripts.php");
    ?>
</head>
<body>
    <?php
        $inicio = "active";
        $boleta_calificaciones = "";
        $cambiar_contraseña = "";
        
        include("incluir/header.php");
        include("incluir/navbar.php");
    ?>
    <div class="row justify-content-center m-0 mt-4 mb-4">   
        <div class="cuadroBienvenida col-sm-6 text-center p-5">
            <p class="msjBienvenida">Bienvenido</p>
            <p class="nomAlumno"> 
                <?php echo $_SESSION['Alumno'] ?>
            </p>
            <div id="datos">
                <div>
                    <p class="msjMatricula">Carrera</p>
                    <p class="numMatricula">Ciencias Policiales</p>
                </div>
                <div>
                    <p class="msjMatricula">Matricula</p>
                    <p class="numMatricula" mat="<?php echo $_SESSION['Usuario'] ?>">
                        <?php echo $_SESSION['Usuario'] ?>
                    </p>
                </div>
                <div>
                    <p class="msjMatricula">Modalidad</p>
                    <p class="numMatricula">Mixta</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>    

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
            $control_calificaciones = "";
            $control_asistencias = "";
            $cambiar_contraseña = "";
            
            include("incluir/header.php");
            include("incluir/navbar.php");
        ?>
        
        <div  class="row justify-content-center m-0 mt-4 mb-4">
            <div class="cuadroBienvenida col-sm-6 text-center p-5">
                <p class="msjBienvenida">Bienvenido</p>
                <p class="nomDocente" id="datos-usuario" 
                        IdUsuario="<?php echo $_SESSION['IdUsuario'] ?>" 
                        IdPersona="<?php echo $_SESSION['IdPersona'] ?>"
                        IdInstructor="<?php echo $_SESSION['IdInstructor'] ?>">
                        <?php echo $_SESSION['Empleado'] ?>
                </p>
            </div>
        </div>

    </body>
</html>

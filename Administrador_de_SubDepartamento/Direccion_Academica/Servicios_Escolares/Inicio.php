<?php
    session_start();
    if (!isset($_SESSION['active'])) {
        header('location: ../../../Login/Iniciar_Sesion.php');
    } else {
        if ($_SESSION['Rol'] != 'ADMINISTRADOR DE SUB-DEPARTAMENTO' && $_SESSION['Departamento'] != 'DIRECCION ACADEMICA'
            && $_SESSION['SubDepartamento'] != 'DEPARTAMENTO DE SERVICIOS ESCOLARES') {
            header('location: ../../../Login/Iniciar_Sesion.php');
        } else if ($_SESSION['Rol'] == 'ADMINISTRADOR DE SUB-DEPARTAMENTO' && $_SESSION['Departamento'] != 'DIRECCION ACADEMICA'
                   && $_SESSION['SubDepartamento'] != 'DEPARTAMENTO DE SERVICIOS ESCOLARES') {
            header('location: ../../../Login/Iniciar_Sesion.php');
        } else if ($_SESSION['Rol'] != 'ADMINISTRADOR DE SUB-DEPARTAMENTO' && $_SESSION['Departamento'] == 'DIRECCION ACADEMICA'
                   && $_SESSION['SubDepartamento'] != 'DEPARTAMENTO DE SERVICIOS ESCOLARES') {
            header('location: ../../../Login/Iniciar_Sesion.php');
        } else if ($_SESSION['Rol'] != 'ADMINISTRADOR DE SUB-DEPARTAMENTO' && $_SESSION['Departamento'] != 'DIRECCION ACADEMICA'
                   && $_SESSION['SubDepartamento'] == 'DEPARTAMENTO DE SERVICIOS ESCOLARES') {
            header('location: ../../../Login/Iniciar_Sesion.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SII</title>
        <?php
			include("../../incluir/metas.php");
			include("../../incluir/links.php");
    	?>
        <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
        <link rel="stylesheet" type="text/css" href="css/styles_inicio.css">
        <?php
        	include("../../incluir/scripts.php");
    	?>
    </head>
    <body>
        <?php
            $inicio = "active";
            $pagina1 = "";
            $pagina2 = "";
            $pagina3 = "";
            
            include("incluir/header.php");
            include("incluir/navbar.php");
        ?>
        
        <div  class="row justify-content-center m-0 mt-4 mb-4">
            <div class="contentDialog col-sm-7 text-center p-5">
                <p class="msjBienvenida">Bienvenido</p>
                <div class="row data-content" id="datos-empleado-c1">
                    <div class="col-sm-12">
                        <p class="data-title">Empleado</p>
                        <p class="data-response"><?php echo $_SESSION['Empleado'] ?></p>
                    </div>
                </div>
                <div class="row data-content" id="datos-empleado-c2">
                    <div class="col-sm-6">
                        <p class="data-title">Dirección</p>
                        <p class="data-response"><?php echo $_SESSION['Departamento'] ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="data-title">Departamento</p>
                        <p class="data-response"><?php echo $_SESSION['SubDepartamento'] ?></p>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

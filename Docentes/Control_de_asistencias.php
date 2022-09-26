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
        <link rel="stylesheet" type="text/css" href="css/styles_registrar_calificaciones.css">
        <?php
        	include("../incluir/scripts.php");
    	?>
    </head>
    <body>
        <?php
            $inicio = "";
            $registrar_calificaciones = "";
            $control_asistencias = "active";
            $cambiar_contraseña = "";
            
            include("incluir/header.php");
            include("incluir/navbar.php");
        ?>
        <div class="container-fluid" id="contenido-barra" >
	  		<div class="row pt-3 pb-3" id="barra">
	    		<div class="col text-left">
	    			<span class="text-bold">Docente: 
	    				<span id="datos-usuario" class="text-nobold" IdUsuario="<?php echo $_SESSION['IdUsuario']; ?>" 
						  IdPersona="<?php echo $_SESSION['IdPersona']; ?>" IdInstructor="<?php echo $_SESSION['IdInstructor']; ?>"
						  NombreEmpleado="<?php echo $_SESSION['Empleado']; ?>">
	    					<?php echo $_SESSION['Empleado']; ?>
	    				</span>
	    			</span>
	    		</div>
	  		</div>
		</div>
    </body>
</html>
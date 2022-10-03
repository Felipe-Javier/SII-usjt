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
        <link rel="stylesheet" type="text/css" href="css/styles_control_de_asistencias.css">
		<?php
        	include("../incluir/scripts.php");
    	?>
		<script src="js/registrar_calificaciones.js"></script>
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
	    <div class="container-fluid mt-3 mb-3" id="contenido-cuerpo">
	    	<div class="row">
				<div class="col-sm-2">
					<div class="modal-content mb-4" id="grupos"></div>
				</div>  
	    		<div class="col-sm-10">
	    			<!--<div class="modal-content" id="result">
	    				<p class="msj text-center">selecciona un grupo</p>
					</div>-->
                    <table class="table table-bordered table-responsive">
                    <tr><th rowspan="3">No.
                        <th rowspan="3">Matricula
                        <th rowspan="3">Nombre del Estudiante
                        <th colspan="31" class="nomenclatura" >Poner: R = Retardo, I = Injustificado, J = Justificado, punto(.) = Presente, AO = Alumno Oyente
                        <th colspan="4" rowspan="2">Totales
                        <tr class="gris"><td>Lu<td>Ma<td>Mi<td>Ju<td>Vi<td>Sa<td>Do<td>Lu<td>Ma<td>Mi<td>Ju<td>Vi<td>Sa<td>Do<td>Lu<td>Ma<td>Mi<td>Ju<td>Vi<td>Sa<td>Do<td>Lu<td>Ma<td>Mi<td>Ju<td>Vi<td>Sa<td>Do<td>Lu<td>Ma<td>Mi
                        <tr class="gris"><th>1<th>2<th>3<th>4<th>5<th>6<th>7<th>8<th>9<th>10<th>11<th>12<th>13<th>14<th>15<th>16<th>17<th>18<th>19<th>20<th>21<th>22<th>23<th>24<th>25<th>26<th>27<th>28<th>29<th>30<th>31
                        <th>R<th>I<th>J<th>P
                        <tr class="td_size"><td class="td_datosAlumno">1<td class="td_datosAlumno">123456<td class="td_datosAlumno">Juan Jose Martinez Lopez
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>
						<td><select name="" id=""><option value="">*</option><option value="">/</option><option value="">J</option><option value="">R</option></select>

                        <td>0<td>3<td>2<td>5
                            
                </table>
					<div class="div_button">
						<button class="button ">Guardar</button>
					</div>
			</div>
		</div>
	</body>
</html>
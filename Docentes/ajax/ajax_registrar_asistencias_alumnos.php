<?php
  include ("../clases/procesar_asistencias.php");

  $procesar_asistencias = new procesar_asistencias();

  $Matricula = '';
  $IdRelGrupoAlumno= '';
  $Calificacion= '';
  $IdTipoCorte= '';
  $IdTipoCalificacion= '';
  $IdPlanMateria= '';
  $IdUsuario='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $FechaAsistencia = $procesar_asistencias->sanitize_str($_POST['FechaAsistencia']);
        $IdDiaAsistencia = $procesar_asistencias->sanitize_int($_POST['IdDiaAsistencia']);
        $IdsRelsGruposAlumnos = $procesar_asistencias->sanitize_array($_POST['IdsRelsGruposAlumnos']);
        $IdsAlumnos = $procesar_asistencias->sanitize_array($_POST['IdsAlumnos']);
        $IdsAlumnosMatriculas = $procesar_asistencias->sanitize_array($_POST['IdsAlumnosMatriculas']);
        $IdsPersonas = $procesar_asistencias->sanitize_array($_POST['IdsPersonas']);
        $IdGrupo = $procesar_asistencias->sanitize_int($_POST['IdGrupo']);
        $IdPlanMateria = $procesar_asistencias->sanitize_int($_POST['IdPlanMateria']);
        $IdInstructor = $procesar_asistencias->sanitize_int($_POST['IdInstructor']);
        $IdCicloEscolar = $procesar_asistencias->sanitize_int($_POST['IdCicloEscolar']);
        $IdsNomenclaturas = $procesar_asistencias->sanitize_array($_POST['IdsNomenclaturas']);
        $IdUsuario = $procesar_asistencias->sanitize_int($_POST['IdUsuario']);
        $RowCount = $procesar_asistencias->sanitize_int($_POST['RowCount']);
        
        for ($i=0; $i<$RowCount; $i++) { 
            $result = $procesar_asistencias->registrar_asistencias($IdsPersonas[$i], $IdsAlumnos[$i], $IdsAlumnosMatriculas[$i], $IdGrupo, 
            $IdsRelsGruposAlumnos[$i], $IdPlanMateria, $IdInstructor, $IdCicloEscolar, $IdDiaAsistencia, $FechaAsistencia, $IdsNomenclaturas[$i], 
            $IdUsuario);
        }

        if ($result == true) {
            $rowRegistradas = $result->rowCount();
            if ($rowRegistradas == 0) {
                $output .= 'Ya existe un registro previo de las asistencias con la fecha ingresada';
            } elseif ($rowRegistradas > 0) {
                $output .= 'Registro de asistencias realizado exitosamente';
            }
        } elseif ($result == false) {
            $output .= 'No se han podido registrar las asistencias de los alumnos';
        }

        echo $output;
        exit;
    } else {
        $output = 'Error al realizar el registro de asistencias de los alumnos';
        echo $output;
        exit;
    }
?>
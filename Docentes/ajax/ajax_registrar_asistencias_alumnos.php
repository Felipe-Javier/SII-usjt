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
        
        $dateTimeZone = new DateTimeZone('America/Monterrey');

        $dateTimeObject1 = date_create_from_format('U.u', microtime(TRUE));
        $dateTimeObject1->setTimeZone($dateTimeZone);
        $timeStart = $dateTimeObject1->format('H:i:s.u');
        for ($i=0; $i<$RowCount; $i++) { 
            $result = $procesar_asistencias->registrar_asistencias($IdsPersonas[$i], $IdsAlumnos[$i], $IdsAlumnosMatriculas[$i], $IdGrupo, 
            $IdsRelsGruposAlumnos[$i], $IdPlanMateria, $IdInstructor, $IdCicloEscolar, $IdDiaAsistencia, $FechaAsistencia, $IdsNomenclaturas[$i], 
            $IdUsuario);
        }
        $dateTimeObject2 = date_create_from_format('U.u', microtime(TRUE));
        $dateTimeObject2->setTimeZone($dateTimeZone);
        $timeEnd = $dateTimeObject2->format('H:i:s.u');

        if ($result == true) {
            //$output .= 'Registro de asistencias realizado exitosamente';
            $difference = date_diff($dateTimeObject2, $dateTimeObject1);
            
            $hours = $difference->h;

            $minutes = $difference->days * 24 * 60;
            $minutes += $difference->h * 60;
            $minutes += $difference->i;

            $seconds = $difference->days * 24 * 60 * 60;
            $seconds += $difference->h * 60 * 60;
            $seconds += $difference->s;

            $output .= 'Hora de inicio: '.$timeStart.'</br>';
            $output .= 'Hora de finalizcion: '.$timeEnd.'</br>';
            $output .= 'Tiempo total de ejecución: '.$hours.' horas, '.$minutes.' minutos y '.$seconds.' segundos';
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
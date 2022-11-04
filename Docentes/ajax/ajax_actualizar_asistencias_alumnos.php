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
        $Matricula = $procesar_asistencias->sanitize_str($_POST['Matricula']);
        $Grupo = $procesar_asistencias->sanitize_str($_POST['Grupo']);
        $IdGrupo = $procesar_asistencias->sanitize_int($_POST['IdGrupo']);
        $Materia = $procesar_asistencias->sanitize_str($_POST['Materia']);
        $IdPlanMateria = $procesar_asistencias->sanitize_int($_POST['IdPlanMateria']);
        $Docente = $procesar_asistencias->sanitize_str($_POST['Docente']);
        $IdInstructor = $procesar_asistencias->sanitize_int($_POST['IdInstructor']);
        $FechaAsistencia = $procesar_asistencias->sanitize_str($_POST['FechaAsistencia']);
        $IdCatDiaAsistencia = $procesar_asistencias->sanitize_int($_POST['IdCatDiaAsistencia']);
        $IdCatNomenclaturaAsistencia = $procesar_asistencias->sanitize_int($_POST['IdCatNomenclaturaAsistencia']);
        $IdUsuario = $procesar_asistencias->sanitize_int($_POST['IdUsuario']);
        
        $result = $procesar_asistencias->actualizar_asistencias($Matricula, $IdGrupo, $IdPlanMateria, $IdInstructor, 
        $FechaAsistencia, $IdCatDiaAsistencia, $IdCatNomenclaturaAsistencia, $IdUsuario);

        if ($result == true) {
            $RowCount = $result->rowCount();
            if ($RowCount > 0) {
                $output .= 'La edición de asistencia del alumno con los datos ingresados se ha realizado exitosamente';

                /*TipoMovimiento = $seguridad_usuario->sanitize_str('ACTUALIZACIÓN');

                $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA ACTUALIZACIÓN DE LA ASISTENCIA CON FECHA'.$FechaAsistencia.
                ' DEL ALUMNO CON MATRICULA: '.$Matricula.' EN LA MATERIA: '.$Materia.' DEL GRUPO: '.$Grupo.' IMPARTIDA POR EL DOCENTE: '.$Docente);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);*/
            } elseif ($RowCount == 0) {
                $output .= 'No hay un registro de asistencia con los datos ingresados';
            }
        } elseif ($result == false) {
            $output .= 'No se ha podido editar la asistencia ingresada';
        }

        echo $output;
        exit;
    } else {
        $output = 'Error al realizar la edición';
        echo $output;
        exit;
    }
?>
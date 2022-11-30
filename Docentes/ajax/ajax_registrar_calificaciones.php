<?php
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();
  $seguridad_usuario = new seguridad_usuario();

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
        $Matriculas = $procesar_calificaciones->sanitize_array($_POST['Matriculas']);
        $NombresAlumnos = $procesar_calificaciones->sanitize_array($_POST['NombresAlumnos']);
        $IdsRelsGruposAlumnos = $procesar_calificaciones->sanitize_array($_POST['IdsRelsGruposAlumnos']);
        $Calificaciones = $procesar_calificaciones->sanitize_array($_POST['Calificaciones']);
        $IdsTiposCortes = $procesar_calificaciones->sanitize_array($_POST['IdsTiposCortes']);
        $IdsTiposCalificaciones = $procesar_calificaciones->sanitize_array($_POST['IdsTiposCalificaciones']);
        $IdPlanMateria = $procesar_calificaciones->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $procesar_calificaciones->sanitize_str($_POST['Materia']);
        $Grupo = $procesar_calificaciones->sanitize_str($_POST['Grupo']);
        $Docente = $procesar_calificaciones->sanitize_str($_POST['Docente']);
        $Cuatrimestre = $procesar_calificaciones->sanitize_str($_POST['Cuatrimestre']);
        $IdUsuario = $procesar_calificaciones->sanitize_int($_POST['IdUsuario']);

        $count = count($Matriculas, COUNT_RECURSIVE);
        for ($i=0; $i<$count; $i++) { 
            $result = $procesar_calificaciones->registrar_calificaciones(strval($Matriculas[$i]), intval($IdsRelsGruposAlumnos[$i]), 
            intval($Calificaciones[$i]), intval($IdsTiposCortes[$i]), intval($IdsTiposCalificaciones[$i]), $IdPlanMateria, $IdUsuario);
            $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ EL REGISTRO DE CALIFICACIONES DEL ALUMNO '.$NombresAlumnos[$i].
            ' CON MATRICULA: '.$Matriculas[$i].', DE LA MATERIA: '.$Materia.', DEL GRUPO: '.$Grupo.', ASIGNADO AL DOCENTE: '.$Docente.
            ' EN EL CUATRIMESTRE: '.$Cuatrimestre);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
        }

        if ($result == true) {
            $output .= 'Las calificaciones de los alumnos han sido registradas exitosamente';
        } elseif ($result == false) {
            $output .= 'No se han podido registrar las calificaciones de los alumnos';
        }

        echo $output;
        exit;
    } else {
        $output = 'Es necesario ingresar los datos requeridos para continuar';
        echo $output;
        exit;
    }
?>
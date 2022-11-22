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
        $IdsRelsGruposAlumnos = $procesar_calificaciones->sanitize_array($_POST['IdsRelsGruposAlumnos']);
        $Calificaciones = $procesar_calificaciones->sanitize_array($_POST['Calificaciones']);
        $IdsTiposCortes = $procesar_calificaciones->sanitize_array($_POST['IdsTiposCortes']);
        $IdsTiposCalificaciones = $procesar_calificaciones->sanitize_array($_POST['IdsTiposCalificaciones']);
        $IdPlanMateria = $procesar_calificaciones->sanitize_int($_POST['IdPlanMateria']);
        $IdUsuario = $procesar_calificaciones->sanitize_int($_POST['IdUsuario']);

        $count = count($Matriculas, COUNT_RECURSIVE);
        for ($i=0; $i<$count; $i++) { 
            $result = $procesar_calificaciones->registrar_calificaciones(strval($Matriculas[$i]), intval($IdsRelsGruposAlumnos[$i]), 
            intval($Calificaciones[$i]), intval($IdsTiposCortes[$i]), intval($IdsTiposCalificaciones[$i]), $IdPlanMateria, $IdUsuario);
            $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ EL REGISTRO DE CALIFICACIONES DE LOS ALUMNO CON MATRICULA: '.$Matriculas[$i]
                                                      ', DE LA MATERIA: '.$Materia.', DEL GRUPO: '.$Grupo.', ASIGNADOS AL DOCENTE: '.$Docente);
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
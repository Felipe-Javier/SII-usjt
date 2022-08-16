<?php
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();

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
        $Matriculas = $_POST['Matriculas'];
        $IdsRelsGruposAlumnos = $_POST['IdsRelsGruposAlumnos'];
        $Calificaciones = $_POST['Calificaciones'];
        $IdsTiposCortes = $_POST['IdsTiposCortes'];
        $IdsTiposCalificaciones = $_POST['IdsTiposCalificaciones'];
        $IdPlanMateria = intval($_POST['IdPlanMateria']);
        $IdUsuario = intval($_POST['IdUsuario']);

        $count = count($Matriculas, COUNT_RECURSIVE);
        for ($i=0; $i<$count; $i++) { 
            $result = $procesar_calificaciones->registrar_calificaciones(strval($Matriculas[$i]), intval($IdsRelsGruposAlumnos[$i]), 
            intval($Calificaciones[$i]), intval($IdsTiposCortes[$i]), intval($IdsTiposCalificaciones[$i]), $IdPlanMateria, $IdUsuario);
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
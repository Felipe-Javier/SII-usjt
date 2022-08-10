<?php
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();

  $Matricula= '';
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
        $Matricula = strval($_POST['Matricula']);
        $IdRelGrupoAlumno = $_POST['IdRelGrupoAlumno'];
        $Calificacion = intval($_POST['Calificacion']);
        $IdTipoCorte = intval($_POST['IdTipoCorte']);
        $IdTipoCalificacion = intval($_POST['IdTipoCalificacion']);
        $IdPlanMateria = intval($_POST['IdPlanMateria']);
        $IdUsuario = intval($_POST['IdUsuario']);

        $result = $procesar_calificaciones->resgistrar_calificaciones($Matricula, $IdRelGrupoAlumno, $Calificacion, $IdTipoCorte, $IdTipoCalificacion,
        $IdPlanMateria, $IdUsuario);
        
        if ($result != false) {
            $count = $result->rowCount();
            if ($count > 0) {
                $arr = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $arr[] = ($row);
                }
                $output .= json_encode($arr, JSON_UNESCAPED_UNICODE);
                echo $output;
            } else {
                $output .= 'No se encontraron grupos asignados';
                echo $output;
            }
        } else {
            $output .= 'No se han podido registrar las calificaciones de los alumnos';
            echo $output;
        }
    } else {
        $output = 'Ingrese los datos de usuario para ver los grupos asignados';
        echo $output;
        exit;
    }
?>
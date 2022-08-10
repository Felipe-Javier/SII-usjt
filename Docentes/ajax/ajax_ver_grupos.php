<?php
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();

  $IdInstructor= '';
  $IdPersona='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdInstructor = intval($_POST['IdInstructor']);
        $IdPersona = intval($_POST['IdPersona']);

        $result = $procesar_calificaciones->consultar_grupos($IdInstructor, $IdPersona);
        
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
            $output .= 'No se ha podido consultar los grupos asignados';
            echo $output;
        }
    } else {
        $output = 'Ingrese los datos de usuario para ver los grupos asignados';
        echo $output;
        exit;
    }
?>
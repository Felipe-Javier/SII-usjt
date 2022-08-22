<?php  
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();

  $Action = '';
  $result = false;
  $Count = 0;
  $Array = array();
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $_POST['Action'];

        if ($Action == 'VerCatTipoCorte') {
            $result = $procesar_calificaciones->consultar_CatTipoCorte();
            if ($result != false) {
                $Count = $result->rowCount();
                if ($Count > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $Array[] = $row;
                    }
                    $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
                } else {
                    $output .= 'No hay tipos de corte para mostrar';
                }
            } else {
                $output .= 'No se ha podido realizar la consulta';
            }
            echo $output;  
        } elseif ($Action == 'VerCatTipoCalificacion') {
            //$count = count($Matriculas, COUNT_RECURSIVE);
            $result = $procesar_calificaciones->consultar_CatTipoCalificacion();
            if ($result != false) {
                $Count = $result->rowCount();
                if ($Count > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $Array[] = $row;
                    }
                    $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
                } else {
                    $output .= 'No hay tipos de calificacion para mostrar';
                }
            } else {
                $output .= 'No se ha podido realizar la consulta';
            }
            echo $output;                
        }

        $Action = '';
        $result = false;
        $Count = 0;
        $Array = array();
        $output = '';
        exit;
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
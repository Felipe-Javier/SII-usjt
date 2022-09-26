<?php  
  include("../clases/procesar_calificaciones.php");
  include ("../clases/seguridad_usuario.php");

  $procesar_calificaciones = new procesar_calificaciones();
  $seguridad_usuario = new seguridad_usuario();

  $Action = '';
  $result = false;
  $Count = 0;
  $Array = array();
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $procesar_calificaciones->sanitize_str($_POST['Action']);
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);

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

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS TIPOS DE CORTE (PARCIAL) PARA EVALUACION DE LOS'.
                                                      ' DE LOS ALUMNOS DE LA MATERIA '.$Materia.' DEL GRUPO '.$Grupo.' ASIGNADO AL DOCENTE: '.
                                                      $Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);  
        } elseif ($Action == 'VerCatTipoCalificacion') {
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
            
            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS TIPOS DE CALIFICACION PARA EVALUACION DE LOS'.
                                                      ' DE LOS ALUMNOS DE LA MATERIA '.$Materia.' DEL GRUPO '.$Grupo.' ASIGNADO AL DOCENTE: '.
                                                      $Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
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
<?php  
  include("../clases/procesar_asistencias.php");
  include ("../clases/seguridad_usuario.php");

  $procesar_asistencias = new procesar_asistencias();
  $seguridad_usuario = new seguridad_usuario();

  $Action = '';
  $result = false;
  $Count = 0;
  $Array = array();
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $procesar_asistencias->sanitize_str($_POST['Action']);
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);

        if ($Action == 'VerCatDia') {
            $result = $procesar_asistencias->consultar_CatDia();
            if ($result != false) {
                $Count = $result->rowCount();
                if ($Count > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $Array[] = $row;
                    }
                    $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
                } else {
                    $output .= 'No hay elementos en el catalogo para mostrar';
                }
            } else {
                $output .= 'No se ha podido realizar la consulta';
            }
            echo $output;

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DEL CATALOGO DE NOMENCLATURA PARA EL REGISTRO DE ASISTENCIA'.
                                                      ' DE LOS ALUMNOS DE LA MATERIA: '.$Materia.', DEL GRUPO: '.$Grupo.', ASIGNADO AL DOCENTE: '.
                                                      $Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
        } elseif ($Action == 'VerCatNomenclaturaAsistencia') {
            $result = $procesar_asistencias->consultar_CatNomenclaturaAsistencia();
            if ($result != false) {
                $Count = $result->rowCount();
                if ($Count > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $Array[] = $row;
                    }
                    $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
                } else {
                    $output .= 'No hay elementos en el catalogo para mostrar';
                }
            } else {
                $output .= 'No se ha podido realizar la consulta';
            }
            echo $output;
            
            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DEL CATALOGO DE DIAS PARA EL REGISTRO DE ASISTENCIA'.
                                                      ' DE LOS ALUMNOS DE LA MATERIA; '.$Materia.', DEL GRUPO: '.$Grupo.', ASIGNADO AL DOCENTE: '.
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
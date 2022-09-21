<?php
    include ("../clases/boleta_calificaciones.php");
    include ("../clases/seguridad_usuario.php");

    $boleta_calificaciones = new boleta_calificaciones();
    $seguridad_usuario = new seguridad_usuario();

    $Matricula = '';
    $result = false;
    $count = 0;
    $output = '';
    $numPeriodo = 1;

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Matricula = $boleta_calificaciones->sanitize_str($_POST['Matricula']);

        $result = $boleta_calificaciones->consultar_periodos($Matricula);

        $count = $result->rowCount();
        if ($count > 0) {
            $output .=  '<table class="table table-bordered table-periodo">
                            <thead class="thead-periodo">
                              <tr>
                                <th colspan="2">
                                  Periodos disponibles
                                </th>
                              </tr>
                            </thead>
                            <tbody class="tbody-periodo">';
                  while ($row = $result->fetchObject()) {
                    $output .= '<tr>
                                  <th>'.$numPeriodo.'</th>
                                  <td><a type="button" href="" class="periodo" id="'.$row->IDCICLO.'">'.$row->PERIODO.'</a></td>
                                </tr>';
                    $numPeriodo = $numPeriodo + 1;
                  }
                $output .=  '</tbody>
                          </table>';

            $seguridad_usuario->registro_bitacora($IdUsuario, strval('BUSQUEDA'), 
                                                  strval('SE REALIZÓ LA BUSQUEDA DE LOS PERIODOS CURSADOS DEL ALUMNO: '.$Matricula), 
                                                  strval('SISTEMA WEB'));

            echo $output;
        } else {
            $output .= 'No se encontraron periodos disponibles';
            echo $output;
        }
    } else {
        $output = 'Ingrese la matricula para ver los periodos disponibles';
        echo $output;
        exit;
    }
?>
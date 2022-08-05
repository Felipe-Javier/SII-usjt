<?php
  include ("../clases/boleta_calificaciones.php");

  $boleta_calificaciones = new boleta_calificaciones();

  $Matricula = '';
  $result = false;
  $count = 0;
  $output = '';
  $numPeriodo = 1;

  if(isset($_POST) && !empty($_POST)) {
    $Matricula = strval($_POST['Matricula']);

    $result = $boleta_calificaciones->consultar_periodos($Matricula);

    $count = $result->columnCount();
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
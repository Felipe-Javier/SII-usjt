<?php
  include ("../clases/boleta_calificaciones.php");

  $boleta_calificaciones = new boleta_calificaciones();

  $Matricula = '';
  $result = false;
  $count = 0;
  $output = '';
  $num_filas = 0;
  $suma = 0;
  $promedio = 0;

  if(isset($_POST) && !empty($_POST)) {
    $Matricula = strval($_POST['Matricula']);
    $IdCiclo = intval($_POST['IdCiclo']);

    $result = $boleta_calificaciones->consultar_calificaciones($Matricula, $IdCiclo);

    $count = $result->columnCount();
    if ($count > 0) {
      $result_2 = $boleta_calificaciones->consultar_calificaciones($Matricula, $IdCiclo);
      $rowh=$result_2->fetchObject();
      $output .=  '<table class="table table-bordered table-boleta" IdCiclo="">
                      <thead class="thead-boleta">
                        <tr id="titulo-table-boleta">
                          <th scope="row" colspan="3">
                            <div class="row">
                              <h6 class="col-sm-6 mt-auto mb-auto titulo-2">Boleta de calificaciones</h6>
                              <h6 class="col-sm-6 mt-auto mb-auto titulo-2">'.$rowh->CICLOESCOLAR.'</h6>
                            </div>
                          </th>
                        </tr>
                        <tr>
                          <th scope="col" style="width: 25%;">Matricula</th>
                          <th scope="col" style="width: 25%;">Alumno</th>
                          <th scope="col" style="width: 55%;">Carrera</th>
                        </tr>
                      </thead>
                      <thead class="tbody-boleta">
                        <tr>
                          <td scope="col">'.$rowh->MATRICULA.'</td>
                          <td scope="col">'.$rowh->ALUMNO.'</td>
                          <td scope="col">'.$rowh->CARRERA.'</td>
                        </tr>
                      </thead>
                      <thead class="thead-boleta">
                        <tr>
                          <th scope="col" colspan="2" style="width: 70px;">Materia</th>
                          <th scope="col" style="width: 20px;">Calificación</th>
                        </tr>
                      </thead>
                      <tbody class="tbody-boleta">';
            while ($rowb = $result->fetchObject()) {
              $output .= '<tr>
                            <td scope="col" colspan="2" style="width: 70px;">'.$rowb->MATERIA.'</td>
                            <td scope="col" style="width: 20px;">'.$rowb->FINAL.'</td>
                          </tr>';
              $num_filas++;
              $suma = $suma+intval($rowb->FINAL);
            }
          $promedio = doubleval($suma / $num_filas);
          $output .=  '<tr>
                          <th scope="col" colspan="2">PROMEDIO</th>
                          <td scope="col">'.round($promedio,2).'</th>
                        </tr>
                      </tbody>
                    </table>
                    <div class="row">
                      <div class="col-sm-12 justify-content-center">
                        <button id="btn-imprimir" class="btn btn-primary" type="submit">Imprimir Boleta</button>
                      </div>
                    </div>';
          echo $output;
        } else {
            $output .= 'No se encontraron calificaciones registradas';
            echo $output;
        }
  } else {
    $output = 'Ingrese la matricula para ver los periodos disponibles';
    echo $output;
    exit;
  }
?>
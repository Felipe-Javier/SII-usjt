<?php
  include ("../clases/procesar_calificaciones.php");

  $procesar_calificaciones = new procesar_calificaciones();

  $IdInstructor= '';
  $IdGrupo='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdGrupo = intval($_POST['IdGrupo']);
        $IdInstructor = intval($_POST['IdInstructor']);

        $result = $procesar_calificaciones->consultar_alumnos($IdGrupo, $IdInstructor);

        if ($result != false) {
            $count = $result->rowCount();
            
            if ($count > 0) {
                
                $output .= '<div class="row">
                    <div class="col text-left">
                        <span class="text-bold">Lista de calificaciones</span>
                    </div>
                    <div class="col text-right">
                        <span class="text-bold">Materia: <span class="text-nobold" id="Nombre_Materia"></span></span>
                    </div>
                </div>
                <table class="table table-bordered text-center table-responsive" id="table-subir-cal">
                    <thead class="thead-subir-cal text-light">
                        <tr>
                            <th class="th-td-mat">Matricula</th>
                            <th class="th-td-nom">Nombre</th>
                            <th class="th-td-p1" IdTipoCorte="2842">Parcial 1</th>
                            <th class="th-td-p2" IdTipoCorte="2843">Parcial 2</th>
                            <th class="th-td-p3" IdTipoCorte="2844">Final</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-subir-cal">';

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $output .= 
                '<tr>
                        <td class="th-td-mat">'.$row['MATRICULA'].'</td>
                        <td class="th-td-nom">'.$row['NOMBREALUMNO'].'</td>
                        <td class="th-td-p1" IdTipoCorte="2842">
                            <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal-p1" 
                              name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['PARCIAL1'].'">
                            <div id="filters" style="margin-top: 5px;">
                            <select name="" id="" class="custom-select custom-select-sm">
                                <option value="4988">Ordinario</option>
                                <option value="4987">ExtraOrdinario</option>
                                <option value="4990">Repetición</option>
                                <option value="4991">Equivalencia</option>
                                <option value="4989">No Aprobo</option>
                            </select>
                        </div>
                        </td>
                        <td class="th-td-p2" IdTipoCorte="2843">
                        <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal-p2"
                         name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['PARCIAL2'].'">
                            <div id="filters" style="margin-top: 5px;">
                            <select name="" id="" class="custom-select custom-select-sm">
                                <option value="ordinario" >Ordinario</option>
                                <option value="ex_ord">Ex. Ordinario</option>
                                <option value="repeticion">Repetición</option>
                                <option value="equivalencia">Equivalencia</option>
                            </select>
                        </div>
                        </td>
                        <td class="th-td-p3" IdTipoCorte="2844">
                            <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal-pf "
                             name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['FINAL'].'">
                            <div id="filters" style="margin-top: 5px;">
                            <select name="" id="" class="custom-select custom-select-sm">
                                <option value="ordinario">Ordinario</option>
                                <option value="ex_ord">Ex. Ordinario</option>
                                <option value="repeticion">Repetición</option>
                                <option value="equivalencia">Equivalencia</option>
                            </select>
                        </div>
                        </td>
                    </tr>';
                }
                
                $output .= '</tbody>
                            </table>
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <input type="submit" class="btn btn-primary btn-block" value="Guardar" id="btn-reg-cal"/>
                                </div>
                            </div>';

                echo $output;
            } else {
                $output .= 
                '<div class="row">
                    <div class="col text-left">
                        <span class="text-bold">Lista de calificaciones</span>
                    </div>
                    <div class="col text-right">
                        <span class="text-bold">Materia: <span class="text-nobold" id="Nombre_Materia"></span></span>
                    </div>
                </div>
                <table class="table table-bordered text-center table-responsive text-light" id="table-subir-cal">
                    <thead class="thead-subir-cal">
                        <tr>
                            <th class="th-td-mat">No se encontraron alumnos activos en este grupo</th>
                        </tr>
                    </thead>
                </table>';
                echo $output;
            }
        } else {
            $output .= 'No se ha podido consutar los alumnos registrados';
            echo $output;
        }
    } else {
        $output = 'Ingrese los datos de usuario para ver los alumnos registrados';
        echo $output;
        exit;
    }
?>
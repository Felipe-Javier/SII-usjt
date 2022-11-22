<?php
  include("../clases/alumnos_general.php");
  include("../clases/procesar_asistencias.php");
  include ("../clases/seguridad_usuario.php");

  $alumnos_general = new alumnos_general();
  $procesar_asistencias = new procesar_asistencias();
  $seguridad_usuario = new seguridad_usuario();

  $IdInstructor= '';
  $IdGrupo='';
  $IdPlanMateria='';
  $result = false;
  $count = 0;
  $output = '';
  $NumList = 0;

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $IdInstructor = $alumnos_general->sanitize_int($_POST['IdInstructor']);
        $Docente = $procesar_asistencias->sanitize_str($_POST['Docente']);
        $IdGrupo = $alumnos_general->sanitize_int($_POST['IdGrupo']);
        $Grupo = $procesar_asistencias->sanitize_str($_POST['Grupo']);
        $IdPlanMateria = $alumnos_general->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $procesar_asistencias->sanitize_str($_POST['Materia']);
        $CicloEscolar = $procesar_asistencias->sanitize_str($_POST['CicloEscolar']);
        $NumDiaFechas = $procesar_asistencias->sanitize_array($_POST['NumDiaFechas']);
        $NomDiaFechas = $procesar_asistencias->sanitize_array($_POST['NomDiaFechas']);

        $result = $alumnos_general->consultar_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria);

        if ($result != false) {
            $count = $result->rowCount();
                
            if ($count > 0) {
                $countArray = count($NumDiaFechas, COUNT_RECURSIVE);
                $output .= '<div class="row mt-3">'.
                        '<div class="col-sm-12">'.
                            '<div class="table-responsive">'.
                                '<table class="table table-bordered" id="table-formato-asistencias">'.
                                    '<thead class="">'.
                                        '<tr>'.
                                            '<th rowspan="3">NO</th>'.
                                            '<th rowspan="3">MATRICULA</th>'.
                                            '<th rowspan="3" class="thNombre">ESTUDIANTE</th>'.
                                            '<th rowspan="1" colspan="'.$countArray.'" class="thDescNomenclatura">'.
                                                'Nomenclatura:  R==Retardo, I==Injustificado, J==Justificado, P==Presente, F==Falta'.
                                            '</th>'.
                                            '<th colspan="5" rowspan="2">TOTALES</th>'.
                                            '<tr>';
                
                for ($i=0; $i<$countArray; $i++) {
                    $output .= '<th rowspan="1" class="thDia">'.$NomDiaFechas[$i].'</th>';
                }

                $output .= '</tr>
                            <tr>';

                for ($i=0; $i<$countArray; $i++) {
                    $output .= '<th rowspan="1" class="thDia">'.$NumDiaFechas[$i].'</th>';
                }

                    $output .= '<th class="thNomTotal">R</th>
                                <th class="thNomTotal">I</th>
                                <th class="thNomTotal">J</th>
                                <th class="thNomTotal">F</th>
                                <th class="thNomTotal">P</th>
                            </tr>
                        </tr>'.
                    '</thead>'.
                    '<tbody class="">';

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $NumList++; 
                    $output .= '<tr>
                                    <td class="td-num">'.$NumList.'</td>
                                    <td class="td-mat">
                                        <label class="DatosAlumno_C1" id="M-'.$row['MATRICULA'].'" IdRelGruAlu="'.$row['IDRELGRUPOALUMNO'].'"
                                            IdAlumno="'.$row['IDALUMNO'].'" IdAlumnoMatricula="'.$row['IDALUMNOMATRICULA'].'"
                                            IdPersona="'.$row['IDPERSONA'].'">'.
                                                $row['MATRICULA']
                                        .'</label>
                                    </td>
                                    <td class="td-nombre">
                                        <label class="DatosAlumno_C2" id="N-'.$row['MATRICULA'].'" IdGrupo="'.$row['IDGRUPO'].'"
                                            IdPlanMat="'.$row['IDPLANMATERIA'].'" IdInstructor="'.$row['IDINSTRUCTOR'].'"
                                            IdCicloEscolar="'.$row['IDCICLOESCOLAR'].'">'.
                                                $row['NOMBREALUMNO']
                                        .'</label>
                                    </td>';
                                    for ($i=0; $i<$countArray+5; $i++) {
                                        $output .= '<td></td>';
                                    }

                                $output .= '</tr>';
                }
                        
                    $output .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';
                echo $output;
            } else {
                $output .= 'No se encontraron alumnos registrados en la materia '.$Materia.' del grupo '.$Grupo;
                echo $output;
            }
        } else {
            $output .= 'No se han podido consultar los alumnos registrados en la materia '.$Materia.' del grupo '.$Grupo;
            echo $output;
        }
    } else {
        $output = 'Error al generar el formato de lista asistencias';
        echo $output;
        exit;
    }
?>
<?php
  include("../clases/procesar_asistencias.php");
  include ("../clases/seguridad_usuario.php");

  $procesar_asistencias = new procesar_asistencias();
  $seguridad_usuario = new seguridad_usuario();

  $IdInstructor= '';
  $IdGrupo='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $IdInstructor = $procesar_asistencias->sanitize_int($_POST['IdInstructor']);
        $IdGrupo = $procesar_asistencias->sanitize_int($_POST['IdGrupo']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $IdPlanMateria = $procesar_asistencias->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);
        $AnioAsistencia = $procesar_asistencias->sanitize_int($_POST['AnioAsistencia']);
        $MesAsistencia = $procesar_asistencias->sanitize_str($_POST['MesAsistencia']);
        $NumList = 0;
        $numColDias = 0;

        $result = $procesar_asistencias->consultar_asistencias_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria, $MesAsistencia, 
                                                                           $AnioAsistencia);

        if ($result != false) {
            $it = new IteratorIterator($result);
            $count = iterator_count($it);
                
            if ($count > 0) {
                $result->execute();
                $output .= '
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="row justify-content-end">
                                <div class="col-sm-3 mb-3">
                                    <button class="button-custom button-blue" id="btnRegistrarAsistencia" data-toggle="modal" 
                                     data-target="#modalRegAsistencias">
                                        <i class="fas fa-plus-square h6 mr-2"></i>Registrar asistencia
                                    </button>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <button class="button-custom button-blue" id="btnEditarAsistencia" data-toggle="modal" 
                                     data-target="#modalEditarAsistencias">
                                        <i class="fas fa-edit h6 mr-2"></i>Editar asistencia
                                    </button>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <button class="button-custom button-blue" id="btnImprimirReporteListaAsistencias">
                                    <i class="fas fa-print h6 mr-2"></i>Imprimir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="reporte-asistencias">
                        <div class="col-sm-12">
                            <div class="tableAsistencias-responsive">
                                <table class="table table-bordered text-center" id="table-asistencias">
                                    <thead class="thead-asistencias text-light">
                                        <tr>
                                            <th rowspan="2" class="thNum">NO</th>';

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        if ($NumList == 0) {
                            foreach($row as $key => $value) {
                                if ($key == 'MATRICULA' || $key == 'NOMBREALUMNO') {
                                    if ($key == 'NOMBREALUMNO') {
                                        $output .='<th rowspan="2" class="thNombre">ESTUDIANTE</th>';
                                    } else if ($key == 'MATRICULA') {            
                                            $output .='<th rowspan="2" class="thMatricula">' . $key . '</th>';
                                    }
                                }
                            }
                            foreach($row as $key => $value) {
                                if ($key != 'MATRICULA' && $key != 'NOMBREALUMNO' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                    $key != 'F' && $key != 'P') {
                                    $numColDias++;
                                }
                            }
                            $output .= '<th colspan="'.$numColDias.'"class="thDescNomenclatura" >
                                            Nomenclatura:  R==Retardo, I==Injustificado, J==Justificado, P==Presente, F==Falta
                                        </th>
                                        <th colspan="5" rowspan="1">TOTALES</th>
                                    <tr>';
                            foreach($row as $key => $value) {
                                if ($key != 'MATRICULA' && $key != 'NOMBREALUMNO' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                    $key != 'F' && $key != 'P') {
                                    $output .='<th class="thDia">' . $key . '</th>';
                                }
                            }
                            foreach($row as $key => $value) {
                                if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P') {
                                    $output .='<th class="thNomTotal">' . $key . '</th>';
                                }
                            }
                            $output .= '</tr>
                                    </tr>
                                </thead>
                                <tbody class="tbody-asistencias">';
                        }
                        $NumList++; 
                        $output .= '<tr>
                                        <td class="tdNum">'.$NumList.'</td>';
                        foreach($row as $key => $value) {
                            if ($key == 'MATRICULA' || $key == 'NOMBREALUMNO') {
                                if ($key == 'MATRICULA') {
                                    $output .= '<td class="tdMat">'.$value.'</td>';
                                } else if ($key == 'NOMBREALUMNO') {
                                    $output .= '<td class="tdNombre">'.$value.'</td>';
                                }
                            }
                        }

                        foreach($row as $key => $value) {
                            if ($key != 'MATRICULA' && $key != 'NOMBREALUMNO' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                $key != 'F' && $key != 'P') {
                                $output .='<td class="tdNomenclatura">'.$value.'</td>';
                            }
                        }

                        foreach($row as $key => $value) {
                            if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P') {
                                $output .='<td class="tdNomTotal">'.$value.'</td>';
                            }
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
                $output .= 
                    '<div class="row mt-2">
                        <div class="col-sm-12">
                            <div class="row justify-content-end">
                                <div class="col-sm-3">
                                    <button class="button-custom button-blue" id="btnRegistrarAsistencia" data-toggle="modal" 
                                     data-target="#modalRegAsistencias">
                                        <i class="fas fa-plus-square h6 mr-2"></i>Registrar asistencia
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="reporte-asistencias">
                        <div class="col-sm-12">
                            <div class="tableAsistencias-responsive">
                                <table class="table table-bordered text-center text-light" id="table-asistencias">
                                    <thead class="thead-asistencias">
                                        <tr>
                                            <th class="thSinResultados">No se encontraron asistencias registradas en el mes de '.$MesAsistencia.'
                                             del a??o '.$AnioAsistencia.'</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>';
                echo $output;
            }

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZ?? LA BUSQUEDA DE LAS ASISTENCIAS DE LOS ALUMNOS ACTIVOS EN LA MATERIA: '.$Materia.
                                                      ', DEL GRUPO: '.$Grupo.', ASIGNADOS AL DOCENTE: '.$Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
        } else {
            $output .= 'No se han podido consutar las asistencias registradas';
            echo $output;
        }
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
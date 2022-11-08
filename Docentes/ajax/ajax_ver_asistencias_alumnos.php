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
        $Action = $procesar_asistencias->sanitize_str($_POST['Action']);

        if ($Action == 'VerAsistencias') {
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
                    <div class="row mt-2">
                        <div class="col-sm-12">

                            <div class="row justify-content-end">
                                <div class="col-sm-3">
                                    <button class="button-custom button-blue" id="btnRegistrarAsistencia" data-toggle="modal" data-target="#modalRegAsistencias">
                                        <i class="fas fa-plus-square h6 mr-2"></i>Registrar asistencia
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="button-custom button-blue" id="btnEditarAsistencia" data-toggle="modal" data-target="#modalEditarAsistencias">
                                        <i class="fas fa-edit h6 mr-2"></i>Editar asistencia
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                        <div class="tableAsistencias-responsive">
                            <table class="table table-bordered text-center" id="table-asistencias">
                                <thead class="thead-asistencias text-light">
                                    <tr>
                                        <th rowspan="2" class="thNum">No.</th>';

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
                                                    Nomenclatura: R = Retardo, I = Injustificado, J = Justificado, punto(.) = Presente
                                                </th>
                                                <th colspan="5" rowspan="1">Totales</th>
                                            <tr>';
                                    foreach($row as $key => $value) {
                                        if ($key != 'MATRICULA' && $key != 'NOMBREALUMNO' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                            $key != 'F' && $key != 'P') {
                                            $output .='<th class="thDia">' . $key . '</th>';
                                        }
                                    }
                                    $output .= '';
                                    foreach($row as $key => $value) {
                                        if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P') {
                                            $output .='<th class="thNomTotal">' . $key . '</th>';
                                        }
                                    }
                                    $output .= '</tr>
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
                                        if ($value == '.') {
                                            $output .='<td class="tdNomenclatura"><i class="fas fa-circle icon-circle"></i></td>';
                                        } else if ($value == '/') {
                                            $output .='<td class="tdNomenclatura"><i class="fas fa-slash icon-slash"></i></td>';
                                        } else {
                                            $output .='<td class="tdNomenclatura">' . $value . '</td>';
                                        }
                                    }
                                }

                                foreach($row as $key => $value) {
                                    if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P') {
                                        $output .='<td class="tdNomTotal">' . $value . '</td>';
                                    }
                                }
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
                                    <button class="button-custom button-blue" id="btnRegistrarAsistencia" data-toggle="modal" data-target="#modalRegAsistencias">
                                        <i class="fas fa-plus-square h6 mr-2"></i>Registrar asistencia
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="tableAsistencias-responsive">
                                <table class="table table-bordered text-center text-light" id="table-asistencias">
                                    <thead class="thead-asistencias">
                                        <tr>
                                            <th class="thSinResultados">No se encontraron asistencias registradas en el mes de '.$MesAsistencia.'
                                            del año '.$AnioAsistencia.'</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>';
                    echo $output;
                }

                /*TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ALUMNOS ACTIVOS EN LA MATERIA '.$Materia.' DEL GRUPO '.
                                                        $Grupo.' ASIGNADO AL DOCENTE: '.$Docente);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);*/
            } else {
                $output .= 'No se han podido consutar las asistencias registradas';
                echo $output;
            }
        } else if ($Action == 'VerAlumnos') {
            $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
            $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
            $IdInstructor = $procesar_asistencias->sanitize_int($_POST['IdInstructor']);
            $IdGrupo = $procesar_asistencias->sanitize_int($_POST['IdGrupo']);
            $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
            $IdPlanMateria = $procesar_asistencias->sanitize_int($_POST['IdPlanMateria']);
            $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);
            $MesAsistencia = NULL;
            $AnioAsistencia = NULL;
            $NumList = 0;

            $result = $procesar_asistencias->consultar_asistencias_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria, 
                                                                           $MesAsistencia, $AnioAsistencia);

            if ($result != false) {
                $it = new IteratorIterator($result);
                $count = iterator_count($it);
                
                if ($count > 0) {
                    $result->execute();
                    $output .= 
                    '<div class="col-sm-12">
                        <table class="table table-bordered table-responsive text-center" id="table-registrar-asistencias">
                            <thead class="thead-reg-asistencias text-light">
                                <tr>
                                    <th class="th-num">No.</th>
                                    <th class="th-mat">Matricula</th>
                                    <th class="th-nombre">Nombre del Estudiante</th>
                                    <th class="th-nomen">Nomenclatura</th>
                                <tr>
                            <thead>
                            <tbody class="tbody-reg-asistencias">';

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
                                        </td>
                                        <td class="td-nomen">
                                            <select class="NomenAlumno form-control custom-select text-size" name="Nomen" id="Nomen-'.$row['MATRICULA'].'" required>
                                                <option value="" selected disabled>-- seleccione --</option>
                                            </select>
                                        </td>
                                    </tr>';
                    }
                    
                    $output .= '</tbody>
                                </table>
                                </div>';

                    echo $output;
                } else {
                    $output .= 
                    '<div class="table-responsive">
                        <table class="table table-bordered text-center text-light" id="table-registrar-asistencias">
                            <thead class="thead-reg-asistencias">
                                <tr>
                                    <th>No se encontraron alumnos activos en este grupo</th>
                                </tr>
                            </thead>
                        </table>
                    <div>';
                    echo $output;
                }

                /*TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ALUMNOS ACTIVOS EN LA MATERIA '.$Materia.' DEL GRUPO '.
                                                        $Grupo.' ASIGNADO AL DOCENTE: '.$Docente);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);*/
            } else {
                $output .= 'No se han podido consutar los alumnos activos';
                echo $output;
            }
        }
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
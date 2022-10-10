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

            $result = $procesar_asistencias->consultar_asistencias_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria, $MesAsistencia, $AnioAsistencia);

            if ($result != false) {
                $it = new IteratorIterator($result);
                $count = iterator_count($it);
                
                if ($count > 0) {
                    $result->execute();
                    $output .= '
                    <div class="div_button">
                        <button class="button" id="btnRegistrarAsistencia">Registrar asistencia</button>
                    </div>
                    <table class="table table-bordered table-responsive text-center" id="table-subir-cal">
                        <thead class="thead-subir-cal text-light">
                            <tr>
                                <th rowspan="2">No.</th>
                                <!--<th rowspan="3">Matricula</th>
                                <th rowspan="3">Nombre del Estudiante</th>
                                <th colspan="31" class="nomenclatura" >
                                    Nomenclatura: R = Retardo, I = Injustificado, J = Justificado, punto(.) = Presente, AO = Alumno Oyente
                                </th>
                                <th colspan="4" rowspan="2">Totales</th>
                                <tr class="gris"><td>LUNES 12</td><td>MARTES 13</td><td>MIERCOLES 14</td></tr>-->';

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        if ($NumList == 0) {
                            foreach($row as $key => $value) {
                                if ($key == 'MATRICULA' || $key == 'NOMBRE_DEL_ESTUDIANTE') {                
                                    $output .='<th rowspan="2">' . $key . '</th>';
                                }
                            }
                            $output .= '<th class="nomenclatura" >
                                            Nomenclatura: R = Retardo, I = Injustificado, J = Justificado, punto(.) = Presente, AO = Alumno Oyente
                                        </th>
                                        <th colspan="6" rowspan="1">Totales</th>
                                    <tr class="gris">';
                            foreach($row as $key => $value) {
                                if ($key != 'MATRICULA' && $key != 'NOMBRE_DEL_ESTUDIANTE' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                    $key != 'F' && $key != 'P' && $key != 'AO') {
                                    $output .='<th>' . $key . '</th>';
                                }
                            }
                            $output .= '</tr>';
                            foreach($row as $key => $value) {
                                if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P' || $key == 'AO') {
                                    $output .='<th>' . $key . '</th>';
                                }
                            }
                            $output .= '</tr>
                                    </thead>
                                    <tbody class="tbody-subir-cal">';
                        }
                        $NumList++; 
                        $output .= '<tr>
                                        <td class="">'.$NumList.'</td>';
                        foreach($row as $key => $value) {
                            if ($key == 'MATRICULA' || $key == 'NOMBRE_DEL_ESTUDIANTE') {
                                $output .= '<td>'.$value.'</td>';
                            }
                        }

                        foreach($row as $key => $value) {
                            if ($key != 'MATRICULA' && $key != 'NOMBRE_DEL_ESTUDIANTE' && $key != 'R' && $key != 'I' && $key != 'J' && 
                                $key != 'F' && $key != 'P' && $key != 'AO') {
                                $output .='<td>' . $value . '</td>';
                            }
                        }

                        foreach($row as $key => $value) {
                            if ($key == 'R' || $key == 'I' || $key == 'J' || $key == 'F' || $key == 'P' || $key == 'AO') {
                                $output .='<td>' . $value . '</td>';
                            }
                        }
                        $output .= '</tr>';
                    }
                    
                    $output .= '</tbody>
                                </table>';

                    echo $output;
                } else {
                    $output .= 
                    '<div class="div_button">
                        <button class="button" id="btnRegistrarAsistencia">Registrar asistencia</button>
                    </div>
                    <table class="table table-bordered text-center table-responsive text-light" id="table-subir-cal">
                        <thead class="thead-subir-cal">
                            <tr>
                                <th class="th-td-mat">No se encontraron asistencias registradas en el mes de '.$MesAsistencia.'
                                del año '.$AnioAsistencia.'</th>
                            </tr>
                        </thead>
                    </table>';
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

            $result = $procesar_asistencias->consultar_asistencias_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria, $MesAsistencia, $AnioAsistencia);

            if ($result != false) {
                $it = new IteratorIterator($result);
                $count = iterator_count($it);
                
                if ($count > 0) {
                    $result->execute();
                    $output .= '<div class="col-sm-12">
                    <table class="table table-bordered table-responsive text-center" id="table-registrar-asistencia">
                        <thead class="thead-subir-cal text-light">
                            <tr>
                                <th>No.</th>
                                <th>Matricula</th>
                                <th>Nombre del Estudiante</th>
                                <th>Nomenclatura</th>
                            <tr>
                        <thead>
                        <tbody>';

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $NumList++; 
                        $output .= '<tr>
                                        <td>'.$NumList.'</td>
                                        <td>
                                            <label class="DatosAlumno_C1" id="M-'.$row['MATRICULA'].'" IdRelGruAlu="'.$row['IDRELGRUPOALUMNO'].'"
                                            IdAlumno="'.$row['IDALUMNO'].'" IdAlumnoMatricula="'.$row['IDALUMNOMATRICULA'].'"
                                            IdPersona="'.$row['IDPERSONA'].'">'.
                                                $row['MATRICULA']
                                            .'</label>
                                        </td>
                                        <td>
                                            <label class="DatosAlumno_C2" id="N-'.$row['MATRICULA'].'" IdGrupo="'.$row['IDGRUPO'].'"
                                            IdPlanMat="'.$row['IDPLANMATERIA'].'" IdInstructor="'.$row['IDINSTRUCTOR'].'"
                                            IdCicloEscolar="'.$row['IDCICLOESCOLAR'].'">'.
                                                $row['NOMBREALUMNO']
                                            .'</label>
                                        </td>
                                        <td>
                                            <select class="NomenAlumno form-control custom-select" name="Nomen" id="Nomen-'.$row['MATRICULA'].'" required>
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
                    '<div class="row">
                        <div class="col-sm-6 mb-2 text-center">
                            <span class="text-bold">Lista de asistencias</span>
                        </div>
                        <div class="col-sm-6 mb-2 text-center">
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
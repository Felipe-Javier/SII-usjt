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
        $ClaveBusqueda = $procesar_asistencias->sanitize_str($_POST['ClaveBusqueda']);
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $IdInstructor = $procesar_asistencias->sanitize_int($_POST['IdInstructor']);
        $IdGrupo = $procesar_asistencias->sanitize_int($_POST['IdGrupo']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $IdPlanMateria = $procesar_asistencias->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);
        $FechaAsistencia = $seguridad_usuario->sanitize_str($_POST['FechaAsistencia']);
        $IdCatDiaAsistencia = $seguridad_usuario->sanitize_str($_POST['IdCatDiaAsistencia']);

        $result = $procesar_asistencias->consultar_asistencia_alumno_por_NombreMatricula($ClaveBusqueda, $IdInstructor, $IdGrupo, $IdPlanMateria, 
        $FechaAsistencia, $IdCatDiaAsistencia);

        if ($result != false) {
            $it = new IteratorIterator($result);
            $count = iterator_count($it);
                
            if ($count > 0) {
                $result->execute();
                $output .= 
                    '<div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="table-editar-asistencias">
                                <thead class="thead-reg-asistencias text-light">
                                    <tr>
                                        <th class="th-mat">Matricula</th>
                                        <th class="th-nombre">Nombre del Estudiante</th>
                                        <th class="th-fecha">Fecha</th>
                                        <th class="th-nomen">Nomenclatura</th>
                                    <tr>
                                <thead>
                                <tbody class="tbody-reg-asistencias">';

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $output .= '<tr>
                                    <td class="td-mat">
                                        <label class="DatosAlumno_C1" id="M-'.$row['MATRICULA'].'" Matricula="'.$row['MATRICULA'].'">'.
                                            $row['MATRICULA']
                                        .'</label>
                                    </td>
                                    <td class="td-nombre">
                                        <label class="DatosAlumno_C2" id="N-'.$row['MATRICULA'].'" IdGrupo="'.$row['IDGRUPO'].'"
                                        IdPlanMat="'.$row['IDPLANMATERIA'].'" IdInstructor="'.$row['IDINSTRUCTOR'].'">'.
                                            $row['NOMBREALUMNO']
                                        .'</label>
                                    </td>
                                    <td class="td-fecha">
                                        '.$row['FECHA'].'
                                    </td>
                                    <td class="td-nomen">
                                        <select class="NomenAlumno form-control custom-select text-size" name="Nomen" id="Nomen-'.$row['MATRICULA'].'" 
                                         IdNomenclaturaActual='.$row['IDNOMENCLATURA'].' required>
                                            <option value="" selected disabled>-- seleccione --</option>
                                        </select>
                                    </td>
                                </tr>';
                }
                    
                $output .= '</tbody>
                        </table>
                    </div>
                </div>';

                echo $output;
            } else {
                $output .= 
                    '<div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-light" id="table-editar-asistencias">
                                <thead class="thead-reg-asistencias">
                                    <tr>
                                        <th>No se encontró un registro de asistencia del alumno con los datos ingresados</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>';
                echo $output;
            }

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DEL ALUMNO: '.$ClaveBusqueda.', DE LA MATERIA: '.
                                                      $Materia.' DEL GRUPO: '.$Grupo.', ASIGNADO AL DOCENTE: '.$Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
        } else {
            $output .= 'No se han podido consutar la información del alumno';
            echo $output;
        }
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
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

        if ($Action == 'VerAlumnos') {
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
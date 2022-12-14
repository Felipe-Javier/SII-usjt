<?php
  include("../clases/alumnos_general.php");
  include ("../clases/seguridad_usuario.php");

  $alumnos_general = new alumnos_general();
  $seguridad_usuario = new seguridad_usuario();

  $IdInstructor= '';
  $IdGrupo='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $IdInstructor = $alumnos_general->sanitize_int($_POST['IdInstructor']);
        $IdGrupo = $alumnos_general->sanitize_int($_POST['IdGrupo']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $IdPlanMateria = $alumnos_general->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);
        $NumList = 0;

        $result = $alumnos_general->consultar_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria);

        if ($result != false) {
            $count = $result->rowCount();
                
            if ($count > 0) {
                $result->execute();
                $output .= 
                    '<div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="table-registrar-asistencias">
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
                                        Matricula="'.$row['MATRICULA'].'" IdPersona="'.$row['IDPERSONA'].'">'.
                                            $row['MATRICULA']
                                        .'</label>
                                    </td>
                                    <td class="td-nombre">
                                        <label class="DatosAlumno_C2" id="N-'.$row['MATRICULA'].'" Nombre="'.$row['NOMBREALUMNO'].'"
                                         IdGrupo="'.$row['IDGRUPO'].'" IdPlanMat="'.$row['IDPLANMATERIA'].'"
                                         dInstructor="'.$row['IDINSTRUCTOR'].'" IdCicloEscolar="'.$row['IDCICLOESCOLAR'].'">'.
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
                    </div>
                </div>';

                echo $output;
            } else {
                $output .= 
                    '<div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="table-registrar-asistencias">
                                <thead class="thead-reg-asistencias text-light">
                                    <tr>
                                        <th>
                                            No se encontraron alumnos activos en la materia: '.$Materia.',
                                            del grupo: '.$Grupo.' 
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        <div>
                    </div>';
                echo $output;
            }

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZ?? LA BUSQUEDA DE LOS ALUMNOS ACTIVOS EN LA MATERIA '.$Materia.' DEL GRUPO '.
                                                        $Grupo.' ASIGNADO AL DOCENTE: '.$Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                            
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
        } else {
            $output .= 'No se han podido consutar los alumnos activos';
            echo $output;
        }
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
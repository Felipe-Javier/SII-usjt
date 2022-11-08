<?php
  include("../clases/procesar_calificaciones.php");
  include ("../clases/seguridad_usuario.php");

  $procesar_calificaciones = new procesar_calificaciones();
  $seguridad_usuario = new seguridad_usuario();

  $IdInstructor= '';
  $IdGrupo='';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
        $IdInstructor = $procesar_calificaciones->sanitize_int($_POST['IdInstructor']);
        $IdGrupo = $procesar_calificaciones->sanitize_int($_POST['IdGrupo']);
        $Grupo = $seguridad_usuario->sanitize_str($_POST['Grupo']);
        $IdPlanMateria = $procesar_calificaciones->sanitize_int($_POST['IdPlanMateria']);
        $Materia = $seguridad_usuario->sanitize_str($_POST['Materia']);

        $result = $procesar_calificaciones->consultar_calificaciones_alumnos($IdInstructor, $IdGrupo, $IdPlanMateria);

        if ($result != false) {
            $count = $result->rowCount();
            
            if ($count > 0) {
                
                $output .= '<div class="row ">
                    <div class="col-sm-6 mb-2 text-center">
                        <span class="text-bold">Lista de calificaciones</span>
                    </div>
                    <div class="col-sm-6 mb-2 text-center">
                        <span class="text-bold">Materia: <span class="text-nobold" id="Nombre_Materia" IdPlanMateria=""></span>
                    </div>
                </div>
                <div class=" table-responsive">
                <table class=" table text-center" id="table-subir-cal">
                    <thead class="thead-subir-cal text-light">
                        <tr>
                            <th class="th-td-mat">Matricula</th>
                            <th class="th-td-nom">Nombre</th>
                            <th class="th-td-p1">Parcial 1</th>
                            <th class="th-td-p2">Parcial 2</th>
                            <th class="th-td-p3">Final</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-subir-cal">';

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $output .= 
                    '<tr>
                        <td class="th-td-mat">
                            <label class="mat" matricula="'.$row['MATRICULA'].'">'.$row['MATRICULA'].'</label>
                        </td>
                        <td class="th-td-nom">'.$row['NOMBREALUMNO'].'</td>
                        <td class="th-td-p1 td-data" IdTipoCorte="">
                            <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal" 
                              name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['PARCIAL1'].'" IdRelGrupoAlumno="'.$row['IDRELGRUPOALUMNO'].'" 
                              IdTipoCorte="">
                            <div id="filters" style="margin-top: 5px;">
                                <select name="" id="" class="custom-select custom-select-sm tipo-cal" IdTipoCorte="" TipoCal="'.$row['TIPOCALIFICACION1'].'">
                                    <option value="">-- Tipo de evaluacion --</option>
                                </select>
                            </div>
                        </td>
                        <td class="th-td-p2 td-data" IdTipoCorte="">
                            <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal"
                            name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['PARCIAL2'].'" IdRelGrupoAlumno="'.$row['IDRELGRUPOALUMNO'].'"
                            IdTipoCorte="">
                            <div id="filters" style="margin-top: 5px;">
                                <select name="" id="" class="custom-select custom-select-sm tipo-cal" IdTipoCorte="" TipoCal="'.$row['TIPOCALIFICACION2'].'">
                                    <option value="">-- Tipo de evaluacion --</option>
                                </select>
                            </div>
                        </td>
                        <td class="th-td-p3 td-data" IdTipoCorte="">
                            <input type="number" min="0" max="100" class="form-control form-control-sm text-center input-cal"
                             name="Cal_Par1_A1" id="Cal_Par1_A1" value="'.$row['FINAL'].'" IdRelGrupoAlumno="'.$row['IDRELGRUPOALUMNO'].'"
                             IdTipoCorte="">
                            <div id="filters" style="margin-top: 5px;">
                                <select name="" id="" class="custom-select custom-select-sm tipo-cal" IdTipoCorte="" TipoCal="'.$row['TIPOCALIFICACION3'].'">
                                    <option value="">-- Tipo de evaluacion --</option>
                                </select>
                            </div>
                        </td>
                    </tr>';
                }
                
                $output .= '</tbody>
                            </table>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <button class="btn btn-primary btn-block" id="btn-reg-cal">Guardar</button>
                                </div>
                            </div>';

                echo $output;
            } else {
                $output .= 
                '<div class="row">
                    <div class="col-sm-6 mb-2 text-center">
                        <span class="text-bold">Lista de calificaciones</span>
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

            $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
            $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ALUMNOS ACTIVOS EN LA MATERIA '.$Materia.' DEL GRUPO '.
                                                      $Grupo.' ASIGNADO AL DOCENTE: '.$Docente);
            $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
            $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
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
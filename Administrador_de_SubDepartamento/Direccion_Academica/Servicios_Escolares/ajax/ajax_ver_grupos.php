<?php
    include("../clases/alumnos.php");
    include ("../clases/seguridad_usuario.php");

    $alumnos = new alumnos();
    $seguridad_usuario = new seguridad_usuario();

    $Opcion = '';
    $IdInstructor = '';
    $IdPersona = '';
    $IdUsuario = '';
    $result = false;
    $row = '';
    $count = '';
    $output = '';

    if (isset($_POST) && !empty($_POST)) {
        $Opcion = $alumnos->sanitize_str($_POST['Opcion']);

        if ($Opcion == 'Traer_anios_escolares') {
            $AnioEscolar = NULL; $IdCicloEscolar = NULL; $IdInstructor = NULL; $IdGrupo = NULL;

            $result = $alumnos->consultar_grupos_general($Opcion, $AnioEscolar, $IdCicloEscolar, $IdInstructor, $IdGrupo);

            if ($result != false) {
                $it = new IteratorIterator($result);
                $count = iterator_count($it);
                
                if ($count > 0) {
                    $result->execute();
                    $output .= '<div class="text-center grupos-ciclos">GRUPOS</div>
                                    <nav class="sidebar card pt-2 pb-4">
                                        <ul class="nav flex-column">';

                    while ($row = $it->fetch(PDO::FETCH_ASSOC)) {
                        $output .= '<li class="nav-item has-submenu" id="AnioEscolar-'.$row['ANIOESCOLAR'].'">
                                        <a class="ciclos nav-link href="#" class="navbar-toggler" type="button" data-toggle="collapse"
                                         data-target="#CuatrimestresAnioEscolar-'.$row['ANIOESCOLAR'].'"
                                         aria-controls="CuatrimestresAnioEscolar-'.$row['ANIOESCOLAR'].'"
                                         aria-expanded="false" aria-label="Toggle navigation" AnioEscolar="'.$row['ANIOESCOLAR'].'">'.
                                            $row['ANIOESCOLAR'].
                                        '</a>
                                    </li>';
                    }
                    $output .= '</ul>
                            </nav>';
                    echo $output;
                } else {
                    $output .= '<div class="text-center grupos-ciclos">GRUPOS</div>
                                    <nav class="sidebar card pt-2 pb-4">
                                        <ul class="nav flex-column">
                                            <li class="nav-item has-submenu">
                                                <a class="ciclos nav-link">No tiene grupos asignados</a>
                                            </li>
                                        </ul>
                                    </nav>';
                    echo $output;
                }
            } else {
                $output .= 'No se han podido consultar los grupos activos';
                echo $output;
            }
        } else {
            if ($Opcion == 'Traer_cuatrimestres_por_anio') {
                $AnioEscolar = $alumnos->sanitize_str($_POST['AnioEscolar']);
                $IdCicloEscolar = NULL; $IdInstructor = NULL; $IdGrupo = NULL;
                $result = $alumnos->consultar_grupos_general($Opcion, $AnioEscolar, $IdCicloEscolar, $IdInstructor, $IdGrupo);

                if($result != false) {
                    $it = new IteratorIterator($result);
                    $count = iterator_count($it);

                    if ($count > 0) {
                        $result->execute();
                        $output .= '<ul class="submenu collapse" id="CuatrimestresAnioEscolar-'.$AnioEscolar.'">';
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $output .= '<li class="nav-item has-submenu" id="Cuatrimestre-'.$row['IDCUATRIMESTRE'].'">
                                            <a class="cuatrimestres nav-link" href="#" class="navbar-toggler" type="button"
                                             data-target="#GruposCuatrimestre-'.$row['IDCUATRIMESTRE'].'"
                                             aria-controls="GruposCuatrimestre-'.$row['IDCUATRIMESTRE'].'" aria-expanded="false"
                                             aria-label="Toggle navigation" IdCuatrimestre="'.$row['IDCUATRIMESTRE'].'"
                                             Cuatrimestre="'.$row['CUATRIMESTRE'].'">'.
                                                $row['CUATRIMESTRE'].
                                            '</a>
                                        </li>';
                        }
                        $output .= '</ul>';
                        echo $output;
                    } else {
                        $output .= '<ul class="submenu collapse" id="CuatrimestresAnioEscolar-'.$AnioEscolar.'">
                                            <li class="nav-item has-submenu">
                                                <a class="nav-item has-submenu">No hay cuatrimestres activos en este año</a>
                                            <li>
                                        <ul>';
                        echo $output;
                    }
                } else {
                    $output .= 'No se han podido consultar los cuatrimestres activos';
                    echo $output;
                }
            } else {
                if ($Opcion == 'Traer_docentes_por_cuatrimestre'){
                    $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
                    $Empleado = $seguridad_usuario->sanitize_str($_POST['Empleado']);
                    $Departamento = $seguridad_usuario->sanitize_str($_POST['Departamento']);
                    $SubDepartamento = $seguridad_usuario->sanitize_str($_POST['SubDepartamento']);
                    $IdCicloEscolar = $alumnos->sanitize_int($_POST['IdCicloEscolar']);
                    $CicloEscolar = $alumnos->sanitize_str($_POST['CicloEscolar']);
                    $IdInstructor = NULL; $AnioEscolar = NULL;
                    $result = $alumnos->consultar_grupos_general($Opcion, $AnioEscolar, $IdCicloEscolar, 
                                                                                 $IdInstructor, $IdGrupo);

                    if ($result != false) {
                        $it = new IteratorIterator($result);
                        $count = iterator_count($it);

                        if ($count > 0) {
                            $result->execute();
                            $output .= '<ul class="submenu collapse" id="DocentesCuatrimestre-'.$IdCicloEscolar.'">';
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $output .= '<li class="nav-item has-submenu" id="Docente'.$row['IDINSTRUCTOR'].'">
                                                <a class="docentes nav-link" href="#" class="navbar-toggler" type="button" 
                                                 data-toggle="collapse" data-target="#GruposDocente-'.$row['IDINSTRUCTOR'].'"
                                                 aria-controls="GruposDocente-'.$row['IDINSTRUCTOR'].'" aria-expanded="false"
                                                 aria-label="Toggle navigation" IdInstructor="'.$row['IDINSTRUCTOR'].'" 
                                                 NombreInstructor="'.$row['NOMBREINSTRUCTOR'].'" 
                                                 IdCuatrimestre="'.$row['IDCUATRIMESTRE'].'">'.
                                                    $row['NOMBREINSTRUCTOR'].
                                                '</a>
                                            </li>';
                            }
                            $output .= '</ul>';
                            echo $output;
                        } else {
                            $output .= '<ul class="submenu collapse" id="DocentesCuatrimestres-'.$IdCicloEscolar.'">
                                            <li class="nav-item has-submenu">
                                                <a class="nav-item has-submenu">No hay docentes activos en este cuatrimestre</a>
                                            </li>
                                        </ul>';
                            echo $output;
                        }

                        /*$TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                        $Valor = $seguridad_usuario->sanitize_str('SE REALIZO LA BUSQUEDA DE LOS GRUPOS ACTIVOS DEL CICLO ESCOLAR '.
                                                                  $CicloEscolar.', EMPLEADO: '.$Empleado.', '.
                                                                  'DEPARTAMENTO: '.$SubDepartamento.', DIRECCION: '.$Departamento);
                        $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');

                        $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);*/
                    } else {
                            $output .= 'No se han podido consultar los docentes activos';
                            echo $output;
                    }

                } else {
                    if ($Opcion == 'Traer_grupos_por_docente') {
                        $IdCicloEscolar = $alumnos->sanitize_int($_POST['IdCicloEscolar']);
                        $IdInstructor = $alumnos->sanitize_int($_POST['IdInstructor']);
                        $AnioEscolar = NULL; $IdGrupo = NULL;
                        $result = $alumnos->consultar_grupos_general($Opcion, $AnioEscolar, $IdCicloEscolar, 
                                                                                     $IdInstructor, $IdGrupo);
    
                        if ($result != false) {
                            $it = new IteratorIterator($result);
                            $count = iterator_count($it);
    
                            if ($count > 0){
                                $result->execute();
                                $output .= '<ul class="submenu collapse" id="GruposDocente-'.$IdInstructor.'">';
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $output .= '<li class="nav-item has-submenu" id="Grupo-'.$row['IDGRUPO'].'">
                                                    <a class="grupos nav-link" href="#" class="navbar-toggler" type="button" 
                                                     data-toggle="collapse" data-target="#MateriasGrupo-'.$row['IDGRUPO'].'"
                                                     aria-controls="MateriasGrupo-'.$row['IDGRUPO'].'" aria-expanded="false"
                                                     aria-label="Toggle navigation" IdGrupo="'.$row['IDGRUPO'].'" 
                                                     Grupo="'.$row['GRUPO'].'" IdCuatrimestre="'.$row['IDCUATRIMESTRE'].'">'.
                                                        $row['GRUPO'].
                                                    '</a>
                                                </li>';
                                }
                                $output .= '</ul>';
                                echo $output;
                            } else {
                                $output .= '<ul class="submenu collapse" id="GruposDocente-'.$IdInstructor.'">
                                                <li class="nav-item has-submenu">
                                                    <a class="nav-item has-submenu">Este docente no tiene grupos activos</a>
                                                <li>
                                            <ul>';
                                echo $output;
                            }
                        } else {
                            $output .= 'No se han podido consultar los grupos activos de este docente';
                            echo $output;
                        }

                    } elseif ($Opcion == 'Traer_materias_por_grupo') {
                        $IdCicloEscolar = $alumnos->sanitize_int($_POST['IdCicloEscolar']);
                        $IdInstructor = $alumnos->sanitize_int($_POST['IdInstructor']);
                        $IdGrupo = $alumnos->sanitize_int($_POST['IdGrupo']);
                        $AnioEscolar = NULL;

                        $result = $alumnos->consultar_grupos_general($Opcion, $AnioEscolar, $IdCicloEscolar, 
                                                                                     $IdInstructor, $IdGrupo);

                        if ($result != false) {
                            $it = new IteratorIterator($result);
                            $count = iterator_count($it);

                            if ($count > 0) {
                                $result->execute();
                                $output .= '<ul class="submenu collapse" id="MateriasGrupo-'.$IdGrupo.'">';
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $output .= '<li class="nav-item has-submenu" id="IdMateria-'.$row['IDPLANMATERIA'].'">
                                                    <a class="materias nav-link" href="#" class="navbar-toggler" type="button" 
                                                     data-toggle="collapse" data-target="#MG-'.$row['IDPLANMATERIA'].'"
                                                     aria-controls="MG-'.$row['IDPLANMATERIA'].'" aria-expanded="false"
                                                     aria-label="Toggle navigation" IdGrupo="'.$row['IDGRUPO'].'" 
                                                     Grupo="'.$row['GRUPO'].'" IdPlanMateria="'.$row['IDPLANMATERIA'].'" 
                                                     Materia="'.$row['MATERIA'].'" IdCuatrimestre="'.$row['IDCUATRIMESTRE'].'"
                                                     Cuatrimestre="'.$row['CUATRIMESTRE'].'" Carrera="'.$row['CARRERA'].'" 
                                                     Modalidad="'.$row['MODALIDAD'].'" Turno="'.$row['TURNO'].'">'.
                                                        $row['MATERIA'].
                                                    '</a>
                                                </li>';
                                    }
                                $output .= '</ul>';
                                echo $output;
                            } else {
                                $output .= '<ul class="submenu collapse" id="MateriasGrupo-'.$IdGrupo.'">
                                                <li class="nav-item has-submenu">
                                                    <a class="nav-item has-submenu">No hay materias activas en este grupo</a>
                                                <li>
                                            <ul>';
                                echo $output;
                            }
                        } else {
                            $output .= 'No se han podido consultar las materias activas de este grupo';
                            echo $output;
                        }
                    }
                }
            }
        }
    } else {
        $output .= 'Error al consultar los grupos activos';
        echo $output;
        exit;
    }
?>
<?php
    include("../clases/control_calificaciones.php");
    include ("../clases/seguridad_usuario.php");

    $procesar_calificaciones = new procesar_calificaciones();
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
        $Opcion = $procesar_calificaciones->sanitize_str($_POST['Opcion']);
        $IdInstructor = $procesar_calificaciones->sanitize_int($_POST['IdInstructor']);
        $IdPersona = $procesar_calificaciones->sanitize_int($_POST['IdPersona']);

        if ($Opcion == 'Traer_anios_por_grupos') {
            $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
            $Docente = $seguridad_usuario->sanitize_str($_POST['Docente']);
            $Anio = NULL; $IdCiclo = NULL; $IdGrupo = NULL;

            $result = $procesar_calificaciones->consultar_grupos_por_docente($Opcion, $IdInstructor, $IdPersona, $Anio, $IdCiclo, $IdGrupo);

            if ($result != false) {
                $it = new IteratorIterator($result);
                $count = iterator_count($it);

                if ($count > 0) {
                    $result->execute();
                    $output .= '<li class="text-center grupos-ciclos">GRUPOS</div>
                                    <nav class="sidebar card pt-2 pb-4">
                                        <ul class="nav flex-column">';

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $output .= '<li class="nav-item has-submenu" id="Año-'.$row['ANIOESCOLAR'].'">
                                        <a class="ciclos nav-link href="#" class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#CuatrimestresAnio-'.$row['ANIOESCOLAR'].'"
                                        aria-controls="CuatrimestresAnio-'.$row['ANIOESCOLAR'].'"
                                        aria-expanded="false" aria-label="Toggle navigation" Anio="'.$row['ANIOESCOLAR'].'">'
                                        .$row['ANIOESCOLAR'].'</a>
                                    </li>';
                    }
                    $output .= '</ul>
                            </nav>'
                    echo $output;

                    $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                    $Valor = $seguridad_usuario->sanitize_str('SE REALIZO LA BUSQUEDA DE LOS GRUPOS ASIGNADOS Y LAS MATERIAS ASIGNADAS AL DOCENTE: '.$Docente);
                    $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');

                    $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
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
                $output .= 'No se ha podido consultar los grupos asignados';
                echo $output;
            }
        } else {
            if ($Opcion == 'Traer_cuatrimestres_por_anio') {
                $Anio = $procesar_calificaciones->sanitize_str($_POST['Anio']);
                $IdCiclo = NULL; $IdGrupo = NULL;
                $result = $procesar_calificaciones->consultar_grupos_por_docente($Opcion, $IdInstructor, $IdPersona, $Anio, $IdCiclo, $IdGrupo);

                if($result != false) {
                    $it = new IteratorIterator($result);
                    $count = iterator_count($it);

                    if ($count > 0) {
                        $result->execute();
                        $output .= '<ul class="submenu collapse" id="CuatrimestresAnio-'.$Anio.'">';
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $output .= '<li class="nav-item has-submenu" id="Cuatrimestre-'.$row['IDCUATRIMESTRE'].'">
                                            <a class="cuatrimestres nav-link" href="#" class="navbar-toggler" type="button"
                                            data-target="#GruposCuatrimestre-'.$row['IDCUATRIMESTRE'].'"
                                            aria-controls="GruposCuatrimestre-'$row['IDCUATRIMESTRE'].'" aria-expanded="false"
                                            aria-label="Toggle navigation" IdCuatrimestre="'.$row['IDCUATRIMESTRE'].'">'.$row['CUATRIMESTRE'].'</a>
                                        </li>';
                        }
                        $output .= '</ul>';
                        echo $output;
                    } else {
                        $output .= '<ul class="submenu collapse" id="CuatrimestresAño-'.$Año.'">
                                            <li class="nav-item has-submenu">
                                                <a class="nav-item has-submenu">No tiene periodos cargados</a>
                                            <li>
                                        <ul>';
                        echo $output;
                    }
                } else {
                    $output .= 'No se ha podido consultar los periodos cargados';
                    echo $output;
                }
            } else {
                if ($Opcion == 'Traer_docentes_por_cuatrimestre'){
                    $IdCiclo = $procesar_calificaciones->sanitize_int($_POST['IdCiclo']);
                    $IdInstructor = NULL; $Anio = NULL; $IdPersona = NULL;
                    $result = $procesar_calificaciones->consultar_grupos_por_docente($Opcion, $IdInstructor, $IdPersona, $Anio, $IdCiclo, $IdGrupo);

                    if ($result != false) {
                        $it = new IteratorIterator($result);
                        $count = iterator_count($it);

                        if ($count > 0) {
                            $result->execute();
                            $output .= '<ul class="submenu collapse" id="DocentesCuatrimestres-'.$IdCiclo.'">';
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $output .= '<li class="nav-item has-submenu" id="Docente'.$row['IDINSTRUCTOR'].'">
                                                <a class="grupos nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse"
                                                data-target="#MateriasGrupo-'.$row['IDINSTRUCTOR'].'"
                                                aria-controls="MateriasGrupo-'.$row['IDINSTRUCTOR'].'" aria-expanded="false"
                                                aria-label="Toggle navigation" IdGrupo="'.$row['IDINSTRUCTOR'].'">'
                                                .$row['IDINSTRUCTOR'].'</a>
                                            </li>';
                            }
                            $output .= '</ul>';
                            echo $output;
                        } else {
                            $output .= '<ul class="submenu collapse" id="DocentesCuatrimestres-'.$IdCiclo.'">
                                            <li class="nav-item has-submenu">
                                                <a class="nav-item has-submenu">No tiene docentes asignados</a>
                                            </li>
                                        </ul>';
                            echo $output;
                        }
                    } else {
                            $output .= 'No se ha podido consultar los docentes asignados';
                            echo $output;
                    }

                } else {
                    if ($Opcion == 'Traer_grupos_por_docente') {
                        $IdInstructor = $procesar_calificaciones->sanitize_int($_POST['IdInstructor']);
                        $IdPersona = $procesar_calificaciones->sanitize_int($_POST['IdPersona']);
                        $Anio = NULL; $IdGrupo = NULL;
                        $result = $procesar_calificaciones->consultar_grupos_por_docente($Opcion, $IdInstructor, $IdPersona, $Anio, $IdCiclo, $IdGrupo);
    
                        if ($result != false) {
                            $it = new IteratorIterator($result);
                            $count = iterator_count($it);
    
                            if ($count > 0){
                                $result->execute();
                                $output .= '<ul class="submenu collapse" id="GruposDocente-'.$IdInstructor'">';
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $output .= '<li class="nav-item has-submenu" id="Grupo-'.$row['IDGRUPO'].'">
                                                    <a class="grupos nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse"
                                                    data-target="#MateriasGrupo-'.$row['IDGRUPO'].'"
                                                    aria-controls="MateriasGrupo-'.$row['IDGRUPO'].'" aria-expanded="false"
                                                    aria-label="Toggle navigation" IdGrupo="'.$row['IDGRUPO'].'">'.$row['GRUPO'].'</a>
                                                </li>';
                                }
                                $output .= '</ul>';
                                echo $output;
                            } else {
                                $output .= '<ul class="submenu collapse" id="GruposDocente-'.$IdInstructor.'">
                                                <li class="nav-item has-submenu">
                                                    <a class="nav-item has-submenu">No tiene grupos asignados</a>
                                                <li>
                                            <ul>'
                                echo $output;
                            }
                        } else {
                            $output .= 'No se ha podido consultar los grupos asignados';
                            echo $output;
                        }

                    } elseif ($Opcion == 'Traer_materias_por_grupo') {
                        $IdGrupo = $procesar_calificaciones->sanitize_int($_POST['IdGrupo']);
                        $IdPersona = $procesar_calificaciones->sanitize_int($_POST['IdPersona']);
                        $IdInstructor = $procesar_calificaciones->sanitize_int($_POST['IdInstructor']);
                        $Anio = NULL; $IdCiclo = NULL;

                        $result = $procesar_calificaciones->consultar_grupos_por_docente($Opcion, $IdInstructor, $Anio, $IdCiclo, $IdGrupo);

                        if ($result != false) {
                            $it = new IteratorIterator($result);
                            $count = iterator_count($it);

                            if ($count > 0) {
                                $result->execute();
                                $output .= '<ul class="submenu collapse" id="MateriasGrupo-'.$IdGrupo.'">';
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $output .= '<li class="nav-item has-submenu" id="IdMateria-'.$row['IDPLANMATERIA'].'">
                                                    <a class="materias nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse"
                                                    data-target="#MG-'.$row['IDPLANMATERIA'].'"
                                                    aria-controls="MG-'.$row['IDPLANMATERIA'].'" aria-expanded="false"
                                                    aria-label="Toggle navigation" IdPlanMateria="'.$row['IDPLANMATERIA'].'"
                                                    IdGrupo="'.$row['IDGRUPO'].'" Grupo="'.$row['GRUPO'].'"
                                                    FIE_P1="'.$row['FECHAINICIOEVALUACION_PARCIAL1'].'"
                                                    FIE_P1="'.$row['FECHATERMINOEVALUACION_PARCIAL1'].'"
                                                    FIE_P2="'.$row['FECHAINICIOEVALUACION_PARCIAL2'].'"
                                                    FIE_P2="'.$row['FECHATERMINOEVALUACION_PARCIAL2'].'"
                                                    FIE_F="'.$row['FECHAINICIOEVALUACION_FINAL'].'"
                                                    FIE_F="'.$row['FECHATERMINOEVALUACION_FINAL'].'">'
                                                    .$row['MATERIA'].'</a>
                                                </li>';
                                    }
                                $output .= '</ul>';
                                echo $output;
                            } else {
                                $output .= '<ul class="submenu collapse" id="MateriasGrupo-'.$IdGrupo.'">
                                                <li class="nav-item has-submenu">
                                                    <a class="nav-item has-submenu">No tiene materias asignadas</a>
                                                <li>
                                            <ul>';
                                echo $output;
                            }
                        } else {
                            $output .= 'No se ha podido consultar las materias asignadas';
                            echo $output;
                        }
                    }
                }
            }
        }
    } else {
        $output .= 'Error al consultar los grupos asignados';
        echo $output;
        exit;
    }
?>
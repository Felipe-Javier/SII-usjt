<?php
    include("../clases/procesar_calificaciones.php");

    $procesar_calificaciones = new procesar_calificaciones();

    $IdInstructor = '';
    $IdPersona = '';
    $result = false;
    $count = 0;
    $output = '';

    if (isset($_POST) && !empty($_POST)) {
        $Action = strval($_POST['Action']);
        $IdInstructor = intval($_POST['IdInstructor']);
        $IdPersona = intval($_POST['IdPersona']);

        if ($Action == 'Consultar_Años_Por_Grupos') {
            $result_años_grupos = $procesar_calificaciones->consultar_años_por_grupos($IdInstructor, $IdPersona);

            if ($result_años_grupos != false) {
                $count = $result_años_grupos->rowCount();

                if ($count > 0) {
                    $output .= '<div class="text-center grupos-ciclos">GRUPOS</div>
                                    <nav class="sidebar card py-2 mb-4">
                                        <ul class="nav flex-column">';
                    
                    while ($row_años_grupos = $result_años_grupos->fetch(PDO::FETCH_ASSOC)) {
                        $output .= '<li class="nav-item has-submenu" id="Año-'.$row_años_grupos['AÑODEINICIO'].'">
                                        <a class="ciclos nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse" 
                                        data-target="#CuatrimestresAño-'.$row_años_grupos['AÑODEINICIO'].'" 
                                        aria-controls="CuatrimestresAño-'.$row_años_grupos['AÑODEINICIO'].'" 
                                        aria-expanded="false" aria-label="Toggle navigation" IdAño="'.$row_años_grupos['AÑODEINICIO'].'">'
                                        .$row_años_grupos['AÑODEINICIO'].'</a>
                                    </li>';
                    }
                    $output .= '</ul>
                            </nav>';
                    echo $output;
                } else {
                    $output .= '<div class="text-center grupos-ciclos">GRUPOS</div> 
                                    <nav class="sidebar card py-2 mb-4" >
                                        <ul class="nav flex-column" >
                                            <li class="nav-item has-submenu" >
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
            if ($Action == 'Consultar_Cuatrimestres_Por_Años') {
                $Año = strval($_POST['Año']);

                $result_cuatrimestres_años = $procesar_calificaciones->consultar_cuatrimestres_por_años($IdInstructor, $IdPersona, $Año);

                if ($result_cuatrimestres_años != false) {
                    $count = $result_cuatrimestres_años->rowCount();

                    if ($count > 0) {
                        $output .= '<ul class="submenu collapse" id="CuatrimestresAño-'.$Año.'">';                    
                        while ($row_cuatrimestres_años = $result_cuatrimestres_años->fetch(PDO::FETCH_ASSOC)) {
                            $output .= '<li class="nav-item has-submenu" id="Cuatrimestre-'.$row_cuatrimestres_años['IDCUATRIMESTRE'].'">
                                            <a class="cuatrimestres nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse" 
                                            data-target="#GruposCuatrimestre-'.$row_cuatrimestres_años['IDCUATRIMESTRE'].'" 
                                            aria-controls="GruposCuatrimestre-'.$row_cuatrimestres_años['IDCUATRIMESTRE'].'" aria-expanded="false"
                                            aria-label="Toggle navigation" IdCuatrimestre="'.$row_cuatrimestres_años['IDCUATRIMESTRE'].'">'
                                            .$row_cuatrimestres_años['CUATRIMESTRE'].'</a>
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
                if ($Action == 'Consultar_Grupos_Por_Cuatrimestre') {
                    $IdCuatrimestre = intval($_POST['IdCuatrimestre']);

                    $result_grupos_cuatrimestre = $procesar_calificaciones->consultar_grupos_por_cuatrimestre($IdInstructor, $IdPersona, $IdCuatrimestre);

                    if ($result_grupos_cuatrimestre != false) {
                        $count = $result_grupos_cuatrimestre->rowCount();

                        if ($count > 0) {
                            $output .= '<ul class="submenu collapse" id="GruposCuatrimestre-'.$IdCuatrimestre.'">';                    
                            while ($row_grupos_cuatrimestre = $result_grupos_cuatrimestre->fetch(PDO::FETCH_ASSOC)) {
                                $output .= '<li class="nav-item has-submenu" id="Grupo-'.$row_grupos_cuatrimestre['IDGRUPO'].'">
                                                <a class="grupos nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse" 
                                                data-target="#MateriasGrupo-'.$row_grupos_cuatrimestre['IDGRUPO'].'" 
                                                aria-controls="MateriasGrupo-'.$row_grupos_cuatrimestre['IDGRUPO'].'" aria-expanded="false"
                                                aria-label="Toggle navigation" IdGrupo="'.$row_grupos_cuatrimestre['IDGRUPO'].'">'
                                                .$row_grupos_cuatrimestre['GRUPO'].'</a>
                                            </li>';
                            }
                            $output .= '</ul>';
                            echo $output;
                        } else {
                            $output .= '<ul class="submenu collapse" id="GruposCuatrimestre-'.$IdCuatrimestre.'">
                                            <li class="nav-item has-submenu">
                                                <a class="nav-item has-submenu">No tiene grupos asignados</a>
                                            <li>
                                        <ul>';
                            echo $output;
                        }
                    } else {
                        $output .= 'No se ha podido consultar los grupos asignados';
                        echo $output;
                    }
                } elseif ($Action == 'Consultar_Materias_Por_Grupo') {
                    $IdGrupo = intval($_POST['IdGrupo']);

                    $result_materias_grupo = $procesar_calificaciones->consultar_materias_por_grupo($IdInstructor, $IdPersona, $IdGrupo);

                    if ($result_materias_grupo != false) {
                        $count = $result_materias_grupo->rowCount();

                        if ($count > 0) {
                            $output .= '<ul class="submenu collapse" id="MateriasGrupo-'.$IdGrupo.'">';                    
                            while ($row_materias_grupo = $result_materias_grupo->fetch(PDO::FETCH_ASSOC)) {
                                $output .= '<li class="nav-item has-submenu" id="IdMateria-'.$row_materias_grupo['IDPLANMATERIA'].'">
                                                <a class="materias nav-link" href="#" class="navbar-toggler" type="button" data-toggle="collapse" 
                                                data-target="#MG-'.$row_materias_grupo['IDPLANMATERIA'].'" 
                                                aria-controls="MG-'.$row_materias_grupo['IDPLANMATERIA'].'" aria-expanded="false"
                                                aria-label="Toggle navigation" IdPlanMateria="'.$row_materias_grupo['IDPLANMATERIA'].'"
                                                IdGrupo="'.$row_materias_grupo['IDGRUPO'].'"
                                                FIE_P1="'.$row_materias_grupo['FECHAINICIOEVALUACION_PARCIAL1'].'"
                                                FTE_P1="'.$row_materias_grupo['FECHATERMINOEVALUACION_PARCIAL1'].'"
                                                FIE_P2="'.$row_materias_grupo['FECHAINICIOEVALUACION_PARCIAL2'].'"
                                                FTE_P2="'.$row_materias_grupo['FECHATERMINOEVALUACION_PARCIAL2'].'"
                                                FIE_F="'.$row_materias_grupo['FECHAINICIOEVALUACION_FINAL'].'"
                                                FTE_F="'.$row_materias_grupo['FECHATERMINOEVALUACION_FINAL'].'">'
                                                .$row_materias_grupo['MATERIA'].'</a>
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
    } else {
        $output .= 'Error al consultar los grupos asignados';
        echo $output;
        exit;
    } 
?>
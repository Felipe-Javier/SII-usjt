<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $TipoPersona = '';
    $Clave = false;
    $count = 0;
    $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);    
        $Clave = $seguridad_usuario->sanitize_str($_POST['Clave']);
        $TipoPersona = $seguridad_usuario->sanitize_str($_POST['TipoPersona']);
        
        $result = $seguridad_usuario->buscar_empleado_alumno($Clave, $TipoPersona);

        if ($result == true) {
            $Array = $result->fetchAll(PDO::FETCH_ASSOC);
            $count = count($Array, COUNT_NORMAL);

            if ($count > 0) {
                $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);

                $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$Usuario.' REALIZO LA BUSQUEDA DEL EMPLEADO/ALUMNO CON '.
                'NUMERO DE EMPLEADO/MATRICULA: '.$Clave);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
            } else {
                if ($TipoPersona == 'PERSONAL_GENERAL') {
                    $output .= 'No se encontraron EMPLEADOS EN GENERAL registrados con los datos ingresados';
                } else if ($TipoPersona == 'DOCENTES') {
                    $output .= 'No se encontraron DOCENTES registrados con los datos ingresados';
                } else if ($TipoPersona == 'ALUMNOS') {
                    $output .= 'No se encontraron ALUMNOS registrados con los datos ingresados';
                }
            }
            echo $output;
            exit;
        } else {
            $output .= 'No se ha podido buscar el empleado/alumno con los datos ingresados';
            echo $output;
            exit;
        }
    } else {
        $output .= 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
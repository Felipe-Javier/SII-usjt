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

        $result = $seguridad_usuario->consultar_roles_usuario();
            
        if ($result == true) {
            $count = $result->rowCount();
            if ($count > 0) {
                $output .= json_encode($result->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);

                $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$Usuario.' REALIZO LA BUSQUEDA DE LOS ROLES DE USUARIO EXISTENTES');
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
            } else {
                $output .= 'No se encontraron roles de usuario';
            }
            echo $output;
        } else {
            $output .= 'No se han podido consultar los roles de usuario';
            echo $output;
        }
    } else {
        $output .= 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
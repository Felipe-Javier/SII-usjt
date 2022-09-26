<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $count = 0;
    $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $seguridad_usuario->sanitize_str($_POST['Action']);

        if ($Action == 'Consultar_Roles_Usuario') {    
            $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);

            $result = $seguridad_usuario->consultar_roles_usuario();

            if ($result == true) {
                $count = $result->rowCount();
                if ($count > 0) {
                    $output .= json_encode($result->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
                    echo $output;

                    $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                    $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ROLES DE USUARIO EXISTENTES');
                    $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                    $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

                    exit;
                } else {
                    $output .= 'No se encontraron roles de usuario';
                    echo $output;

                    $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
                    $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ROLES DE USUARIO EXISTENTES');
                    $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                    $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

                    exit;
                }
            } else {
                $output .= 'No se han podido consultar los roles de usuario';
                echo $output;
                exit;
            }
        } elseif ($Action == 'Recuperar_Contrasenia') {
            $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
            $Password = md5($seguridad_usuario->sanitize_str($_POST['Password']));
            $IdRolUsuario = $seguridad_usuario->sanitize_str($_POST['IdRolUsuario']);
            $NomRolUsuario = $seguridad_usuario->sanitize_str($_POST['NomRolUsuario']);
            $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
            $IdUsuarioAct = $seguridad_usuario->sanitize_int($_POST['IdUsuarioAct']);
            $IdUsuarioNuevo = NULL;
            $PassTemp = NULL;

            $result = $seguridad_usuario->actrec_contraseña_usuario($Action, $IdUsuarioNuevo, $Usuario, $Password, $PassTemp, $IdRolUsuario, 
                                                                    $NumEmpleado, $IdUsuarioAct);

            if ($result == true) {
                $output .= 'La contraseña ha sido cambiada exitosamente';
                echo $output;

                $TipoMovimiento = $seguridad_usuario->sanitize_str('ACTUALIZACIÓN');
                $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA RECUPERACIÓN DE LA CONTRASEÑA DEL USUARIO: '.$NomRolUsuario.' - '.
                                                          $Usuario);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                $seguridad_usuario->registro_bitacora($IdUsuarioAct, $TipoMovimiento, $Valor, $TipoSistema);

                exit;
            } elseif ($result == false) {
                $output .= 'No se ha podido cambiar la contraseña';
                echo $output;
                exit;
            }
        }
    } else {
        $output .= 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
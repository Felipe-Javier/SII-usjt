<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $count = 0;
    $output = '';
    $NumEmpleado = 0;

    if(isset($_POST) && !empty($_POST)) {
        sleep(5);

        $IdUsuarioActualiza = $seguridad_usuario->sanitize_int($_POST['IdUsuarioActualiza']);
        $UsuarioActualiza = $seguridad_usuario->sanitize_str($_POST['UsuarioActualiza']);
        $RolUsuarioActualiza = $seguridad_usuario->sanitize_str($_POST['RolUsuarioActualiza']);
        $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
        $Password = md5($seguridad_usuario->sanitize_str($_POST['Password']));
        $PasswordTemp = $seguridad_usuario->sanitize_int($_POST['PasswordTemp']);
        $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
        $RolUsuario = $seguridad_usuario->sanitize_str($_POST['RolUsuario']);
        if ($IdRolUsuario != 9) {
            $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
        } else {
            $NumEmpleado = NULL;
        }

        $result = $seguridad_usuario->recuperar_contraseña_usuario($IdUsuarioActualiza, $Usuario, $Password, $PasswordTemp, $IdRolUsuario, 
                                                                       $NumEmpleado);

        if ($result != false) {
            $count = $result->rowCount();
            if ($count > 0) {
                $output .= 'La contraseña ha sido recuperada exitosamente';

                $TipoMovimiento = $seguridad_usuario->sanitize_str('ACTUALIZACIÓN');
                    $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA RECUPERACIÓN DE LA CONTRASEÑA DEL USUARIO: '.$RolUsuario.
                                                            ' - '.$Usuario.'. USUARIO ACTUALIZA: '.$RolUsuarioActualiza.' - '.$UsuarioActualiza);
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                            
                $seguridad_usuario->registro_bitacora($IdUsuarioActualiza, $TipoMovimiento, $Valor, $TipoSistema);
            } else {
                $output .= 'El usuario al que intenta recuperar la contraseña no existe o los datos son incorrectos';
            }
            echo $output;
            exit;
        } else {
            $output .= 'No se ha podido recuperar la contraseña';
            echo $output;
            exit;
            }
    } else {
        $output .= 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
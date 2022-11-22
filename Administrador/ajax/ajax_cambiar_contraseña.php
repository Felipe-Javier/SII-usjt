<?php
  include ("../clases/seguridad_usuario.php");

  $seguridad_usuario = new seguridad_usuario();

  $Action = '';
  $IdUsuario=0;
  $Usuario= '';
  $Password= '';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
        $Password = md5($seguridad_usuario->sanitize_str($_POST['Contrasenia']));
        $PasswordTemp = $seguridad_usuario->sanitize_int($_POST['ContraseniaTemp']);
        $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
        $RolUsuario = $seguridad_usuario->sanitize_str($_POST['RolUsuario']);

        $result = $seguridad_usuario->actualizar_contraseña_usuario($IdUsuario, $Usuario, $Password, $PasswordTemp, $IdRolUsuario);

        if ($result != false) {
            $count = $result->rowCount();
            if ($count > 0) {
                $output .= 'Su contraseña ha sido cambiada exitosamente';
                $TipoMovimiento = $seguridad_usuario->sanitize_str('ACTUALIZACIÓN');
                $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$RolUsuario.' - '.$Usuario.' CAMBIÓ SU CONTRASEÑA');
                $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                            
                $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);
            } else {
                $output .= 'No hay un registro de su cuenta de usuario o los datos son incorrectos';
            }
        } elseif ($result == false) {
            $output .= 'No se ha podido cambiar su contraseña';
        }
        echo $output;
        exit;
    } else {
        $output = 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
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
        $Action = $seguridad_usuario->sanitize_str('Actualizar_Contrasenia');
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
        $Password = md5($seguridad_usuario->sanitize_str($_POST['Contrasenia']));
        $PasswordTemp = $seguridad_usuario->sanitize_int(0);
        $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
        $NumEmpleado = NULL;
        $IdUsuarioActualiza = $seguridad_usuario->sanitize_int(-1);

        $result = $seguridad_usuario->actualizar_contraseña_usuario($Action, $IdUsuario, $Usuario, $Password, $PasswordTemp, $IdRolUsuario,
                                                                    $NumEmpleado, $IdUsuarioActualiza);

        $TipoMovimiento = $seguridad_usuario->sanitize_str('ACTUALIZACIÓN');
        $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ CAMBIO DE CONTRASEÑA DEL USUARIO '.$Usuario);
        $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                    
        $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

        if ($result == true) {
            $output .= 'Su contraseña ha sido cambiada exitosamente';
        } elseif ($result == false) {
            $output .= 'No se ha podido cambiar su contraseña';
        }
        echo $output;
        exit;
    } else {
        $output = 'Error al cambiar su contraseña';
        echo $output;
        exit;
    }
?>
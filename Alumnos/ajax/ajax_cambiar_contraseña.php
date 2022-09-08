<?php
  include ("../clases/seguridad_usuario.php");

  $seguridad_usuario = new seguridad_usuario();

  $Action = '';
  $IdUsuario=0;
  $UserName= '';
  $Password= '';
  $result = false;
  $count = 0;
  $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);
        $UserName = $seguridad_usuario->sanitize_str($_POST['Usuario']);
        $Password = $seguridad_usuario->sanitize_str($_POST['Contraseña']);
        $PasswordTemp = $seguridad_usuario->sanitize_int(0);
        $RolUsuario = $seguridad_usuario->sanitize_str('ALUMNOS');

        $PassEncrypted = md5($Password);
        $result = $seguridad_usuario->actualizar_contraseña_usuario($IdUsuario, $UserName, $PassEncrypted, $PasswordTemp, $RolUsuario);

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
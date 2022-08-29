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
        $IdUsuario = $_POST['IdUsuario'];
        $UserName = $_POST['Usuario'];
        $Password = $_POST['Contraseña'];
        $PasswordTemp = 0;
        $RolUsuario = 'PERSONAL';

        $PassEncrypted = $seguridad_usuario->encriptar($Password);
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
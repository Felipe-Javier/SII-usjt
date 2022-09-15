<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $count = 0;
    $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $seguridad_usuario->sanitize_str($_POST['Action']);

        if ($Action == 'Consultar_Roles_Usuario') {    
            $result = $seguridad_usuario->consultar_roles_usuario();

            if ($result == true) {
                $count = $result->rowCount();
                if ($count > 0) {
                    $output .= json_encode($result->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
                } else {
                    $output .= 'No se encontraron roles de usuario';
                }
            } else {
                $output .= 'No se han podido consultar los roles de usuario';
            }
            echo $output;
            exit;
        } else if ($Action == 'Actualizar_Contraseña') {
            $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
            $Password = md5($seguridad_usuario->sanitize_str($_POST['Password']));
            $IdRolUsuario = $seguridad_usuario->sanitize_str($_POST['IdRolUsuario']);
            $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
            $IdUsuarioAct = $seguridad_usuario->sanitize_int($_POST['IdUsuarioAct']);
            $IdUsuario = NULL;
            $PassTemp = NULL;

            $result = $seguridad_usuario->actrec_contraseña_usuario($IdUsuario, $Usuario, $Password, $PassTemp, $IdRolUsuario, 
                                                                    $NumEmpleado, $IdUsuarioAct);

            if ($result == true) {
                $output .= 'La contraseña ha sido cambiada exitosamente';
            } elseif ($result == false) {
                $output .= 'No se ha podido cambiar la contraseña';
            }
            echo $output;
            exit;
        }
    } else {
        $output .= 'Error al realizar la consulta';
        echo $output;
        exit;
    }
?>
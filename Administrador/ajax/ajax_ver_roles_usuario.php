<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $count = 0;
    //$array = array();
    $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $Action = $seguridad_usuario->sanitize_str($_POST['Action']);

        if ($Action = 'Consultar_Roles_Usuario') {    
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
        }
    } else {
        $output .= 'Error al consultar los roles de usuario';
        echo $output;
        exit;
    }
?>
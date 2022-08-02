<?php
    include("../class/login.php");
    $iniciar_sesion = new iniciar_sesion();
    
    session_start();

    $rol_usuario = "";
    $usuario = "";
    $contraseña = "";
    $output = "";

    if (isset($_POST) && !empty($_POST)) {
            $rol_usuario = strval($_POST['rol_usuario']);
            $usuario = $_POST['usuario'];
            $contraseña = strval($_POST['contraseña']);

            $result = $iniciar_sesion->sing_in($rol_usuario, $usuario, $contraseña);
            $count = $result->columnCount();
            if ($count >= 1) {
                $data = $result->fetchObject();

                $_SESSION['active'] = true;
                $_SESSION['IdUsuario'] = $data->IdUsuario;
                $_SESSION['Usuario'] = $data->Usuario;
                $_SESSION['Rol'] = $data->Rol;

                $output .= json_encode($data);
                echo $output;
            } elseif ($result->errorInfo()) {
                $msg = $result->errorInfo();
                if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Usuario bloqueado.') {
                    $output .= '¡Atención: Usuario inactivo!';
                } else {
                    if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Usuario inactivo.') {
                        $output .= '¡Atención: Usuario bloqueado!';
                    } else {
                        if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Datos de incio de sesion incorrectos.') {
                                $output .= '¡Atención: Datos de incio de sesion incorrectos!';
                        }
                    }
                }
                echo $output;
                session_destroy();
            }
        } else {
            echo 'error';
        }
?>
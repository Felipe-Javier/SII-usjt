<?php
    include("../clases/login.php");
    $iniciar_sesion = new iniciar_sesion();
    
    session_start();

    sleep(3);

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
                if ($data->Rol == 'ALUMNO') {
                    $_SESSION['Alumno'] = $data->Alumno;
                    $_SESSION['Usuario'] = $data->Usuario;
                    $_SESSION['Rol'] = $data->Rol;
                } else {
                    if ($data->Rol == 'DOCENTE') {
                        $_SESSION['IdPersona'] = $data->IdPersona;
                        $_SESSION['IdInstructor'] = $data->IdInstructor;
                        $_SESSION['Empledo'] = $data->EMPLEDO;
                        $_SESSION['Usuario'] = $data->Usuario;
                        $_SESSION['Rol'] = $data->Rol;
                    } else {
                        if ($data->Rol == 'ADMINISTRADOR DE SISTEMAS') {
                            $_SESSION['IdPersona'] = $data->IdPersona;
                            $_SESSION['Empledo'] = $data->EMPLEDO;
                            $_SESSION['Usuario'] = $data->Usuario;
                            $_SESSION['Rol'] = $data->Rol;
                        }
                    }
                }

                $output .= json_encode($data);
                echo $output;
            } elseif ($result->errorInfo()) {
                $msg = $result->errorInfo();
                if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Usuario inactivo.') {
                    $output .= 'Usuario inactivo';
                } else {
                    if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Usuario bloqueado.') {
                        $output .= 'Usuario bloqueado';
                    } else {
                        if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Datos de incio de sesion incorrectos.') {
                                $output .= 'Datos de incio de sesion incorrectos';
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
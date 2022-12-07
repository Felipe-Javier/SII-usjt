<?php
    include("../clases/seguridad_usuario.php");
    $seguridad_usuario = new seguridad_usuario();
    
    session_start();

    sleep(3);

    $rol_usuario = "";
    $usuario = "";
    $contraseña = "";
    $output = "";

    if (isset($_POST) && !empty($_POST)) {
        $tipo_identificacion = $seguridad_usuario->sanitize_str($_POST['tipo_identificacion']);
        $usuario = $seguridad_usuario->sanitize_str($_POST['usuario']);
        $contraseña = $seguridad_usuario->sanitize_str($_POST['contraseña']);

        $result = $seguridad_usuario->sing_in($tipo_identificacion, $usuario, md5($contraseña));

        if ($result == true) {
            $count = $result->columnCount();
            if ($count > 0) {
                $data = $result->fetchObject();

                $_SESSION['active'] = true;
                $_SESSION['IdUsuario'] = $data->IdUsuario;
                if ($data->Rol == 'ALUMNO') {
                    $_SESSION['Alumno'] = $data->Alumno;
                    $_SESSION['Usuario'] = $data->Usuario;
                    $_SESSION['IdRol'] = $data->IdRol;
                    $_SESSION['Rol'] = $data->Rol;
                } else {
                    if ($data->Rol == 'DOCENTE') {
                        $_SESSION['IdPersona'] = $data->IdPersona;
                        $_SESSION['IdInstructor'] = $data->IdInstructor;
                        $_SESSION['Empleado'] = $data->EMPLEDO;
                        $_SESSION['Usuario'] = $data->Usuario;
                        $_SESSION['IdRol'] = $data->IdRol;
                        $_SESSION['Rol'] = $data->Rol;
                    } else {
                        $_SESSION['IdPersona'] = $data->IdPersona;
                        $_SESSION['Empleado'] = $data->EMPLEDO;
                        $_SESSION['Usuario'] = $data->Usuario;
                        $_SESSION['IdRol'] = $data->IdRol;
                        $_SESSION['Rol'] = $data->Rol;
                        $_SESSION['IdDepartamento'] = $data->IdDepartamento;
                        $_SESSION['Departamento'] = $data->Departamento;
                        $_SESSION['IdSubDepartamento'] = $data->IdSubDepartamento;
                        $_SESSION['SubDepartamento'] = $data->SubDepartamento;
                    }
                }

                $seguridad_usuario->registro_bitacora(intval($_SESSION['IdUsuario']), strval('INICIO DE SESION DEL USUARIO '.$_SESSION['Usuario']),
                                                      strval($_SESSION['Rol'].': '.$_SESSION['Usuario']), strval('SISTEMA WEB'));

                $output .= json_encode($data, JSON_UNESCAPED_UNICODE);
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
            $output .= 'Hubo un error al iniciar sesion';
            echo $output;
        }
    } else {
        echo 'error';
    }
?>
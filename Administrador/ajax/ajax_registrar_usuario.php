<?php
    include ("../clases/seguridad_usuario.php");

    $seguridad_usuario = new seguridad_usuario();

    $TipoPersona = '';
    $Clave = false;
    $count = 0;
    $output = '';

    if(isset($_POST) && !empty($_POST)) {
        $TipoIdentificacion = $seguridad_usuario->sanitize_str($_POST['TipoIdentificacion']);
        $IdPersona = $seguridad_usuario->sanitize_int($_POST['IdPersona']);
        $Nombres = $seguridad_usuario->sanitize_str($_POST['Nombres']);
        $ApellidoPaterno = $seguridad_usuario->sanitize_str($_POST['ApellidoPaterno']);
        $ApellidoMaterno = $seguridad_usuario->sanitize_str($_POST['ApellidoMaterno']);
        $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
        $Contrasenia = md5($seguridad_usuario->sanitize_str($_POST['Contrasenia']));
        $ContraseniaTemp = $seguridad_usuario->sanitize_int($_POST['ContraseniaTemp']);
        $Activo = $seguridad_usuario->sanitize_int($_POST['Activo']);
        $Bloqueado = $seguridad_usuario->sanitize_int($_POST['Bloqueado']);
        $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
        $NomRolUsuario = $seguridad_usuario->sanitize_str($_POST['NomRolUsuario']);
        $IdUsuarioRegistra = $seguridad_usuario->sanitize_int($_POST['IdUsuarioRegistra']);
        $NombreUsuarioRegistra = $seguridad_usuario->sanitize_str($_POST['NombreUsuarioRegistra']);

        if ($IdRolUsuario == 9 && $TipoIdentificacion == 'ALUMNOS') {
            $NumEmpleado = NULL;
            $IdAlumno = $seguridad_usuario->sanitize_int($_POST['IdAlumno']);
            $IdAlumnoMatricula = $seguridad_usuario->sanitize_int($_POST['IdAlumnoMatricula']);
            $IdInstructor = NULL;

            $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $IdAlumnoMatricula,
            $Nombres, $ApellidoPaterno, $ApellidoMaterno, $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, 
            $IdUsuarioRegistra);

            if ($result == true) {
                $count = $result->rowCount();
                if ($count > 0) {
                  $output .= 'El usuario ha sido registrado exitosamente';
                  
                  $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
                  $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$NombreUsuarioRegistra.' REALIZO EL REGISTRO DEL NUEVO USUARIO: '.
                                                            $NomRolUsuario.' - '.$Usuario);
                  $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                      
                  $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);
                } else if ($result->errorInfo()) {
                  $msg = $result->errorInfo();
                  if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Ya existe una cuenta con el mismo nombre de usuario') {
                      $output .= 'Ya existe una cuenta con el mismo nombre de usuario';
                  }
                }
                echo $output;
                exit;
            } else {
                $output .= 'No se ha podido registrar el usuario';
                echo $output;
                exit;
            }
        } else if ($IdRolUsuario == 9 && $TipoIdentificacion != 'ALUMNOS') {
            $output .= 'La persona a la que se le esta creando una cuenta de usuario no es ALUMNO';
            echo $output;
            exit;
        }
        
        if ($IdRolUsuario == 8 && $TipoIdentificacion == 'DOCENTES') {
            $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
            $IdAlumno = NULL;
            $IdAlumnoMatricula = NULL;
            $IdInstructor = $seguridad_usuario->sanitize_int($_POST['IdInstructor']);

            $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $IdAlumnoMatricula,
            $Nombres, $ApellidoPaterno, $ApellidoMaterno, $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, 
            $IdUsuarioRegistra);

            if ($result == true) {
                $count = $result->rowCount();
                if ($count > 0) {
                    $output .= 'El usuario ha sido registrado exitosamente';
                    
                    $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
                    $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$NombreUsuarioRegistra.' REALIZO EL REGISTRO DEL NUEVO USUARIO: '.
                                                              $NomRolUsuario.' - '.$Usuario);
                    $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                    $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);
                } else if ($result->errorInfo()) {
                    $msg = $result->errorInfo();
                    if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Ya existe una cuenta con el mismo nombre de usuario') {
                        $output .= 'Ya existe una cuenta con el mismo nombre de usuario';
                    }
                }
                echo $output;
                exit;
            } else {
                $output .= 'No se ha podido registrar el usuario';
                echo $output;
                exit;
            }
        } else if ($IdRolUsuario == 8 && $TipoIdentificacion != 'DOCENTES') {
            $output .= 'La persona a la que se le esta creando una cuenta de usuario no es DOCENTE';
            echo $output;
            exit;
        } /*else if ($IdRolUsuario != 8 && $TipoIdentificacion == 'DOCENTES') {
            $output .= 'La persona a la que se le esta creando una cuenta de usuario no es DOCENTE';
            echo $output;
            exit;
        } */
        
        if ($IdRolUsuario != 8 && $IdRolUsuario != 9 && $TipoIdentificacion == 'PERSONAL_GENERAL') {
            $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
            $IdAlumno = NULL;
            $IdAlumnoMatricula = NULL;
            $IdInstructor = NULL;

            $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $IdAlumnoMatricula, $Nombres, 
            $ApellidoPaterno, $ApellidoMaterno, $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra);

            if ($result == true) {
                $count = $result->rowCount();
                if ($count > 0) {
                    $output .= 'El usuario ha sido registrado exitosamente';
                  
                    $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
                    $Valor = $seguridad_usuario->sanitize_str('EL USUARIO: '.$NombreUsuarioRegistra.' REALIZO EL REGISTRO DEL NUEVO USUARIO: '.
                                                              $NomRolUsuario.' - '.$Usuario);
                    $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                                        
                    $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);
                } else if ($result->errorInfo()) {
                    $msg = $result->errorInfo();
                    if ($msg[2]=='[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Ya existe una cuenta con el mismo nombre de usuario') {
                        $output .= 'Ya existe una cuenta con el mismo nombre de usuario';
                    }
                }
                echo $output;
                exit;
            } else {
              $output .= 'No se ha podido registrar el usuario';
              echo $output;
              exit;
            }
        } else if ($IdRolUsuario != 8 && $IdRolUsuario != 9 && $TipoIdentificacion != 'PERSONAL_GENERAL') {
            $output .= 'La persona a la que se le esta creando una cuenta de usuario no es EMPLEADO EN GENERAL';
            echo $output;
            exit;
        }
    } else {
        $output .= 'Error al realizar el registro';
        echo $output;
        exit;
    }
?>
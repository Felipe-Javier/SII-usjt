<?php
  include ("../clases/seguridad_usuario.php");

  $seguridad_usuario = new seguridad_usuario();

  $TipoPersona = '';
  $Clave = false;
  $count = 0;
  //$array = array();
  $output = '';

  if(isset($_POST) && !empty($_POST)) {
    $Action = $seguridad_usuario->sanitize_str($_POST['Action']);

    if ($Action == 'Consultar_Roles_Usuario') {
      $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);

      $result = $seguridad_usuario->consultar_roles_usuario();
      
      if ($result == true) {
        $count = $result->rowCount();
        if ($count > 0) {
          $output .= json_encode($result->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
          echo $output;

          $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ROLES DE USUARIO EXISTENTES');
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                              
          $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        } else {
          $output .= 'No se encontraron roles de usuario';
          echo $output;

          $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DE LOS ROLES DE USUARIO EXISTENTES');
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                              
          $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        }
      } else {
        $output .= 'No se han podido consultar los roles de usuario';
        echo $output;
        exit;
      }
    } elseif ($Action == 'Buscar empleado o alumno') {
      $IdUsuario = $seguridad_usuario->sanitize_int($_POST['IdUsuario']);    
      $Clave = $seguridad_usuario->sanitize_str($_POST['Clave']);
      $TipoPersona = $seguridad_usuario->sanitize_str($_POST['TipoPersona']);
      
      $result = $seguridad_usuario->buscar_empleado_alumno($Clave, $TipoPersona);

      if ($result == true) {
        $Array = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = count($Array, COUNT_NORMAL);
        if ($count > 0) {
          $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
          echo $output;

          $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DEL EMPLEADO/ALUMNO CON NUMERO DE EMPLEADO/MATRICULA: '.$Clave);
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
          $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        } else {
          $output .= 'No se encontraron empleados/alumnos registrados con los datos ingresados';
          echo $output;

          $TipoMovimiento = $seguridad_usuario->sanitize_str('BUSQUEDA');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ LA BUSQUEDA DEL EMPLEADO/ALUMNO CON NUMERO DE EMPLEADO/MATRICULA: '.$Clave);
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                        
          $seguridad_usuario->registro_bitacora($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        }
      } else {
        $output .= 'No se ha podido buscar el empleado/alumno con los datos ingresados';
        echo $output;
        exit;
      }
    } elseif ($Action == 'Registrar usuario') {
      $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
      $NomRolUsuario = $seguridad_usuario->sanitize_str($_POST['NomRolUsuario']);
      $Nombres = $seguridad_usuario->sanitize_str($_POST['Nombres']);
      $ApellidoPaterno = $seguridad_usuario->sanitize_str($_POST['ApellidoPaterno']);
      $ApellidoMaterno = $seguridad_usuario->sanitize_str($_POST['ApellidoMaterno']);
      $Usuario = $seguridad_usuario->sanitize_str($_POST['Usuario']);
      $Contrasenia = md5($seguridad_usuario->sanitize_str($_POST['Contrasenia']));
      $ContraseniaTemp = $seguridad_usuario->sanitize_int($_POST['ContraseniaTemp']);
      $Activo = $seguridad_usuario->sanitize_int($_POST['Activo']);
      $Bloqueado = $seguridad_usuario->sanitize_int($_POST['Bloqueado']);
      $IdUsuarioRegistra = $seguridad_usuario->sanitize_int($_POST['IdUsuarioRegistra']);
      
      if ($IdRolUsuario == 9) {
        $NumEmpleado = NULL;
        $IdPersona = $seguridad_usuario->sanitize_int($_POST['IdPersona']);
        $IdAlumno = $seguridad_usuario->sanitize_int($_POST['IdAlumno']);
        $IdInstructor = NULL;

        $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $Nombres, $ApellidoPaterno, $ApellidoMaterno, 
                                                        $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra);
        if ($result == true) {
          $output .= 'El usuario ha sido registrado exitosamente';
          echo $output;
          
          $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ EL REGISTRO DEL NUEVO USUARIO: '.$NomRolUsuario.' - '.$Usuario);
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                              
          $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        } else {
          $output .= 'No se ha podido registrar el usuario';
          echo $output;
          exit;
        }
      } else if ($IdRolUsuario == 8) {
        $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
        $IdPersona = $seguridad_usuario->sanitize_int($_POST['IdPersona']);
        $IdAlumno = NULL;
        $IdInstructor = $seguridad_usuario->sanitize_int($_POST['IdInstructor']);

        $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $Nombres, $ApellidoPaterno, $ApellidoMaterno, 
                                                        $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra);
        if ($result == true) {
          $output .= 'El usuario ha sido registrado exitosamente';
          echo $output;
          
          $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ EL REGISTRO DEL NUEVO USUARIO: '.$NomRolUsuario.' - '.$Usuario);
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                              
          $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        } else {
          $output .= 'No se ha podido registrar el usuario';
          echo $output;
          exit;
        }
      } else if ($IdRolUsuario != 8 && $IdRolUsuario != 9) {
        $NumEmpleado = $seguridad_usuario->sanitize_int($_POST['NumEmpleado']);
        $IdPersona = $seguridad_usuario->sanitize_int($_POST['IdPersona']);
        $IdAlumno = NULL;
        $IdInstructor = NULL;

        $result = $seguridad_usuario->registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $Nombres, $ApellidoPaterno, $ApellidoMaterno, 
                                                        $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra);
        if ($result == true) {
          $output .= 'El usuario ha sido registrado exitosamente';
          echo $output;
          
          $TipoMovimiento = $seguridad_usuario->sanitize_str('REGISTRO');
          $Valor = $seguridad_usuario->sanitize_str('SE REALIZÓ EL REGISTRO DEL NUEVO USUARIO: '.$NomRolUsuario.' - '.$Usuario);
          $TipoSistema = $seguridad_usuario->sanitize_str('SISTEMA WEB');
                                                                                              
          $seguridad_usuario->registro_bitacora($IdUsuarioRegistra, $TipoMovimiento, $Valor, $TipoSistema);

          exit;
        } else {
          $output .= 'No se ha podido registrar el usuario';
          echo $output;
          exit;
        }
      }
    }
  } else {
    $output .= 'Error al registrar el usuario';
    echo $output;
    exit;
  }
?>
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
    if ($Action == 'Buscar empleado o alumno') {
      $Clave = $seguridad_usuario->sanitize_str($_POST['Clave']);
      $TipoPersona = $seguridad_usuario->sanitize_str($_POST['TipoPersona']);
      
      $result = $seguridad_usuario->buscar_empleado_alumno($Clave, $TipoPersona);

      if ($result == true) {
        $Array = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = count($Array, COUNT_NORMAL);
        if ($count > 0) {
          $output .= json_encode($Array, JSON_UNESCAPED_UNICODE);
        } else {
          $output .= 'No se encontraron empleados/alumnos registrados con los datos ingresados';
        }
      } else {
        $output .= 'No se ha podido buscar el empleado/alumno con los datos ingresados';
      }
      echo $output;
      exit;
    } elseif ($Action == 'Registrar usuario') {
      $IdRolUsuario = $seguridad_usuario->sanitize_int($_POST['IdRolUsuario']);
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
        } else {
          $output .= 'No se ha podido registrar el usuario';
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
        } else {
          $output .= 'No se ha podido registrar el usuario';
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
        } else {
          $output .= 'No se ha podido registrar el usuario';
        }
      }

      echo $output;
      exit;
    }
  } else {
    $output .= 'Error al registrar el usuario';
    echo $output;
    exit;
  }
?>
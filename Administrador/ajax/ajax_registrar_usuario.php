<?php
  include ("../clases/seguridad_usuario.php");

  $seguridad_usuario = new seguridad_usuario();

  $TipoPersona = '';
  $Clave = false;
  $count = 0;
  $Array = array();
  $output = '';

  if(isset($_POST) && !empty($_POST)) {
    $Action = $seguridad_usuario->sanitize_str($_POST['Action']);
    if ($Action == 'Buscar empleado o alumno') {
      $Clave = $seguridad_usuario->sanitize_str($_POST['Clave']);
      $TipoPersona = $seguridad_usuario->sanitize_str($_POST['TipoPersona']);
      
      $result = $seguridad_usuario->buscar_empleado_alumno($Clave, $TipoPersona);

      if ($result == true) {
        $Array[] = $result->fetch(PDO::FETCH_ASSOC);
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

    }
  } else {
    $output .= 'Error al buscar el empleado/alumno';
    echo $output;
    exit;
  }
?>
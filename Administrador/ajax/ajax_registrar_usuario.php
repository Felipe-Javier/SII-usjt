<?php
  include ("../clases/seguridad_usuario.php");

  $seguridad_usuario = new seguridad_usuario();

  $TipoPersona = '';
  $Clave = false;
  $count = 0;
  //$Array = array();
  $output = '';

  if(isset($_POST) && !empty($_POST)) {
    $Action = strval($_POST['Action']);
    if ($Action == 'Buscar empleado o alumno') {
      $Clave = strval($_POST['Clave']);
      $TipoPersona = strval($_POST['TipoPersona']);

      $result = $seguridad_usuario->buscar_empleado_alumno($Clave, $TipoPersona);

      if ($result != true) {
        $count = $result->rowCount();
        if ($count > 0) {
          $row = $result->fetch(PDO::FETCH_ASSOC);
          //$Array[] = $row;
          $output .= json_encode($row, JSON_UNESCAPED_UNICODE);
        } else {
          $output .= 'No hay empleados/alumnos registrados con esa clave';
        }
      } else {
        $output .= 'Error al buscar el empleado/alumno';
      }
      echo $output;
      exit;
    } elseif ($Action == 'Registrar usuario') {

    }
  } else {
    $output .= 'Ingrese los datos de busqueda';
    echo $output;
    exit;
  }
?>
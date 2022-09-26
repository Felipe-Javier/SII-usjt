<?php
  session_start();
  if (!isset($_SESSION['active'])) {
      header('location: ../Login/Iniciar_Sesion.php');
  } else {
      if ($_SESSION['Rol'] != 'ALUMNO') {
          header('location: ../Login/Iniciar_Sesion.php');
      }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SII</title>
    <?php
      include("../incluir/metas.php");
      include("../incluir/links.php");
    ?>
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_boleta.css">
    <?php
      include("../incluir/scripts.php");
    ?>
    <script type="text/javascript" src="js/boleta_calificaciones.js"></script>
  </head>
  <body>
    <?php
      $inicio = "";
      $boleta_calificaciones = "active";
      $cambiar_contraseña = "";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>

    <div class="container-fluid mt-4 text-center" id="cont-pag">
      <div class="row">
        <div class="col-sm-3 mt-2">
          <div class="form-group">
            <label for="Matricula">Matricula</label>
            <input type="text" name="Matricula" id="Matricula" class="form-control text-center" 
              value="<?php echo $_SESSION['Usuario'] ?>" mat="<?php echo $_SESSION['Usuario'] ?>" disabled/>
          </div>
          <div id="periodos"></div>
        </div>
        <div class="col-sm-9" id="boleta"></div>
      </div> 
    </div>
  </body>
</html>
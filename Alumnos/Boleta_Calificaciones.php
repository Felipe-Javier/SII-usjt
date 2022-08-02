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
    <meta charset="utf-8" />
    <title>PRUEBA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_boleta.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
</head>
<body>
  <?php
    $inicio = "";
    $subir_calificaciones = "active";

    include("incluir/header.php");
    include("incluir/navbar.php");
  ?>

  <div class="container-fluid mt-4 text-center" id="cont-pag">
    <div class="row">
      <div class="col-sm-3">
        <h6 class="titulo-1">Boleta de calificaciones</h6>
          <table class="table table-bordered table-hover table-periodo">
            <thead class="thead-periodo">
              <tr>
                <th colspan="2">
                  Periodos disponibles
                </th>
              </tr>
            </thead>
            <tbody class="tbody-periodo">
              <tr>
                <th scope="row">
                  1
                </th>
                <td>
                  Mayo - Agosto 2022
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="col-sm-9">
        <div class="row mt-2">
          <div class=col-sm-12>
            <table class="table table-bordered table-hover table-boleta">
              <thead class="thead-boleta">
                <tr id="titulo-table-boleta">
                  <th scope="row" colspan="3">
                    <div class="row">
                      <h6 class="col-sm-2 text-left mt-auto mb-auto titulo-2">Calificaciones</h6>
                      <h6 class="col-sm-10 text-right mt-auto mb-auto titulo-2">Mayo - Agosto 2022</h6>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th scope="col" style="width: 20px;">
                    Matrícula
                  </th>
                  <th scope="col" style="width: 60px;">
                    Alumno
                  </th>
                  <th scope="col" style="width: 20px;">
                    Clave
                  </th>
                </tr>
              </thead>
              <tbody class="tbody-boleta">
                <tr>
                  <td scope="col">
                    12345
                  </td>
                  <td scope="col">
                    Luis Cabrera Benito
                  </td>
                  <td scope="col">
                    Lcp-Mixto 301
                  </td>
                </tr>
              </tbody>
              <thead class="thead-boleta">
                <tr>
                  <th scope="col" colspan="2" style="width: 80px;">
                    Materia
                  </th>
                  <th scope="col" style="width: 20px;">
                    Puntaje
                  </th>
                </tr>
              </thead>
              <tbody class="tbody-boleta">
                <tr>
                  <td scope="col" colspan="2">
                    Matemáticas discretas
                  </td>
                  <td scope="col">
                    100.00
                  </td>
                </tr>
                <tr>
                  <td scope="col" colspan="2">
                    Programación en ambiente cliente-servidor
                  </td>
                  <td scope="col">
                    98.00
                  </td>
                </tr>
                <tr>
                  <td scope="col" colspan="2">
                    Comunicación efectiva en inglés
                  </td>
                  <td scope="col">
                    99.00
                  </td>
                </tr>
                <tr>
                  <th scope="col" colspan="2">
                    Promedio
                  </th>
                  <td scope="col">
                    99
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
          <div class="row">
            <div class="col-sm-12 justify-content-center">
              <button class="btn btn-primary" type="submit">Imprimir Boleta</button>
            </div>
          </div>
      </div>
    </div> 
  </div>
</body>

</html>  <!--<form>
                <section class="row mt-3">
                  <div class="col-sm-12">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text form-control">Periodo</span>
                      </div>
                      <select name="Periodo" id="Periodo" class="custom-select rounded-right" required>
                        <option value=""></option>
                      </select>
                      <div class="invalid-tooltip">Campo requerido</div>
                    </div>
                  </div>
                </section>
                <section class="row mt-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-center">
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary form-control">Ver</button>
                      </div>
                    </div>
                  </div>
                </section>
              </form>-->
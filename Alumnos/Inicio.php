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
        $inicio = "active";
        $subir_calificaciones = "";
        
        include("incluir/header.php");
        include("incluir/navbar.php");
    ?>
    <div class="container mt-4 text-center" id="contenido">
        <?php
            include_once("../Conexión/connection.php");

            $connection = new connection();
        ?>
        <!--
            $connection->connect_db();

            //Este archivo lista todos los datos de la tabla, obteniendo a los mismos como un arreglo
            /*$query = $connection->query("select * from DISTRIBUIDORA");
            $result = $query->fetchAll(PDO::FETCH_OBJ);*/


            //$query = "select * from Doctor";

            //Preparar sentencia e indicar que vamos a usar un cursor
            //$result = $connection->CONN->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,]);

            //Ejecutar sin parámetros
            /*$count = $result->execute();
            $output = '';
            if ($count > 0) {
                $output .= 
                    '<div class="row">
                        <div class="col-sm-12">
                        <table class="table table-hover table-info" id="tabla-oficinas" style="font-size: 12px;">
                            <thead class="text-center">             
                            <tr>
                                <th style="width: 12.5%;">ID de Doctor</th>
                                <th style="width: 12.5%;">Nombre</th>
                                <th style="width: 12.5%;">Apellido paterno</th>
                                <th style="width: 12.5%;">Apellido materno</th>
                                <th style="width: 12.5%;">Sexo</th>
                                <th style="width: 12.5%;">Teléfono</th>
                                <th style="width: 12.5%;">ID de Usuario</th>
                                <th style="width: 12.5%;">ID de Estatus</th>
                            </tr>
                            </thead>
                            <tbody>';
                //Forma de iterar
                while ($row = $result->fetchObject()) {
                //Aquí hacer algo con $row
                    $output .=
                                '<tr class="text-center">
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->IdDoctor.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->Nombre.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->Paterno.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px 7px;">
                                        '.$row->Materno.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->Sexo.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->Telefono.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->IdUsuario.'
                                    </td>
                                    <td class="" style="width: 12.5%; padding: 15px 0px;">
                                        '.$row->IdEstatus.'
                                    </td>
                                </tr>';
                }
                $output .= 
                            '</tbody>
                        </table>
                    </div>
                </div>';
                echo $output;
            } else {
                $output .= 
                    '<div class="row">
                        <div class="col-sm-12">
                            <table class="table table-info text-center">
                                <thead>             
                                    <tr>
                                        <td style="color: red;"><b>Sin resultados...</b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>';
                echo $output;
            }
        -->
        
        <div class="row">
            <div class="col-sm-12">
                <h4>Bienvenido(a)</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Alumno(a): </h4>
            </div> 
            <div class="col-sm-12">
                <p>Luis Cabrera Benito</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Matrícula: </h4>
            </div>
            <div class="col-sm-12">
                <p>12345</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4>Grado:</h4>
                <p>4</p>
            </div>

            <div class="col-sm-6">
                <h4>Grupo:</h4>
                <p>A</p>
            </div>
        </div>
    </div>
</body>
</html>
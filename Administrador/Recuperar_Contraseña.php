<!DOCTYPE html>
<html>
<head>
    <title>SII</title>
    <?php
        include("../incluir/metas.php");
        include("../incluir/links.php");
    ?>
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_recuperar_contraseña.css">
	<!--<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>-->
    <?php
        include("../incluir/scripts.php");
    ?> 
</head>
<body>
    <?php
      $inicio = "";
      $registrar_usuario = "";
      $recuperar_contraseña = "active";

      include("incluir/header.php");
      include("incluir/navbar.php");
    ?>
    <div class="row justify-content-center m-0 mt-5 mb-4">   
        <div class="cuadroBienvenida col-sm-6 text-center p-5">
            <p class="msjBienvenida mb-5">¿Que acción desea realizar?</p>
            <div class="row justify-content-around">
                <button  class="btns_contraseñas mb-5" onclick="cambiar()">Cambiar Contraseña</button>
                <button class="btns_contraseñas mb-5" onclick="buscar()">Buscar Contraseña</button>
            </div>

            <div id="cambiar" class="col-sm-8 border p-3 mx-auto" >
                <form >
                    <p class="mb-4 registrarUsuario">Cambiar Contraseña</p>
                    <div class="form">
                        <div class=" mb-3">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class=" mb-3">
                            <label for="">Nueva Contraseña</label>
                            <div class="input-group" id="show_password">
                                <input type="password" class="form-control" placeholder="Contraseña" required>
                                <button type="button" class="verPassword input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i></a>
                                </button>
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="">Confirmar Contraseña</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-row justify-content-center">
	  	                    <button class="btn btn-primary" type="submit">Guardar</button>
	  	                </div>
                    </div>
                </form>
            </div>

            <div id="buscar" class="col-sm-8 border p-3 mx-auto">
                <form >
                    <p class="mb-4 registrarUsuario">Buscar Contraseña</p>
                    <div class="form">
                        <div class=" mb-3">
                            <label for="">Tipo De Usuario</label>
                            <select class="custom-select" >
                                <option value="" selected disabled>Seleciona</option >
                                <option>Personal</option >
                                <option>Alumno</option >
                            </select>
                        </div>
                        <div class=" mb-3">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class=" mb-3">
                            <label for="" >Contraseña Actual</label>
                            <input type="password" class="form-control" disabled>
                        </div>
                        <div class="form-row justify-content-center">
	  	                    <button class="btn btn-primary" type="submit">Buscar</button>
	  	                </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
<script>
    //cambiar de contraseña
    	function cambiar(){
            let mostrarCambiar = document.getElementById('cambiar');
            let mostrarBuscar = document.getElementById('buscar');
            if (window.getComputedStyle(mostrarCambiar).display === 'none') {
                mostrarCambiar.style.display = 'block';
                mostrarBuscar.style.display = "none";
            } else {
                mostrarCambiar.style.display = 'none';
            }
	    }

    // buscar la contraseña
        function buscar(){
            let mostrarCambiar = document.getElementById('cambiar');
            let mostrarBuscar = document.getElementById('buscar');
            if (window.getComputedStyle(mostrarBuscar).display === 'none'){
                mostrarBuscar.style.display = "block";
                mostrarCambiar.style.display = 'none';
            } else {
                mostrarBuscar.style.display = "none";
            }
        }

    // ver la contraseña
        $(document).ready(function() {
            $("#show_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_password input').attr("type") == "text"){
                    $('#show_password input').attr('type', 'password');
                    $('#show_password i').addClass( "fa-eye-slash" );
                    $('#show_password i').removeClass( "fa-eye" );
                }else if($('#show_password input').attr("type") == "password"){
                    $('#show_password input').attr('type', 'text');
                    $('#show_password i').removeClass( "fa-eye-slash" );
                    $('#show_password i').addClass( "fa-eye" );
                }
            });
        });

</script>
</html>
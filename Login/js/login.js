$(document).ready(function() {

    "use strict";

    $("#show_password #btn_show_password").on('click', function() {
        if ($('#show_password #password').attr("type") == "text"){
            $('#show_password #password').attr('type', 'password');
            $('#show_password #btn_show_password i').addClass( "fa-eye-slash" );
            $('#show_password #btn_show_password i').removeClass( "fa-eye" );
        } else if ($('#show_password #password').attr("type") == "password"){
            $('#show_password #password').attr('type', 'text');
            $('#show_password #btn_show_password i').removeClass( "fa-eye-slash" );
            $('#show_password #btn_show_password i').addClass( "fa-eye" );
        }
    });

    var formLogin = $('#login-SII.needs-validation');

    var validation_Login = Array.prototype.filter.call(formLogin, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                /*$("#show_password #btn_show_password").removeClass("verPassword");
                $("#show_password #btn_show_password").addClass("validate-btn-danger");*/
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-danger fade show text-center" role="alert">'+
                                '<strong>¡Atención: Ingrese los datos de inicio de sesion para continuar!</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            } else {
                if (form.checkValidity() == true) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    /*$("#show_password #btn_show_password").removeClass("verPassword");
                    $("#show_password #btn_show_password").addClass("validate-btn-success");*/
                    Iniciar_Sesion();
                }
            }
        }, false);
    });

    function Iniciar_Sesion () {
        var tipo_identificacion = $("form .form-group #tipo_identificacion").val();
        var usuario = $("form .form-group #usuario").val();
        var contraseña = $("form .form-group #password").val();
        
        $.ajax({
            url: "ajax/ajax_iniciar_sesion.php",
            method: "POST",
            data: {tipo_identificacion: tipo_identificacion, usuario: usuario, contraseña: contraseña},
            async: true,

            beforeSend: function() {
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-primary fade show text-center" role="alert">'+
                                '<strong class="text-center">Iniciando Sesion</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            },

            success: function(response) {
                var output = "";
                if (response=='Usuario inactivo' || response=='Usuario bloqueado' || response=='Datos de incio de sesion incorrectos') {
                    output = '<div class="col-12">'+
                                    '<div class="alert alert-danger fade show text-center" role="alert">'+
                                        '<strong>¡Atención: '+response+'!</strong>'+
                                    '</div>'+
                                '</div>';
                    $("#result").html(output);
                    $("#result .alert").fadeTo(2000, 500);
                    $("#result .alert").slideUp(500);
                } else {
                    var info = JSON.parse(response);
                    if (info.Rol == 'DOCENTE') {
                        if (info.ContraseniaTemp == 0) {
                            location.href = '../Docentes/Inicio.php';
                        } else if (info.ContraseniaTemp == 1) {
                            location.href = '../Docentes/Cambio_de_contraseña_primera_vez.php';
                        }
                    } else {
                        if (info.Rol == 'ALUMNO') {
                            if (info.ContraseniaTemp == 0) {
                                location.href = '../Alumnos/Inicio.php';
                            } else if (info.ContraseniaTemp == 1) {
                                location.href = '../Alumnos/Cambio_de_contraseña_primera_vez.php';
                            }
                        } else if (info.Rol == 'ADMINISTRADOR DE SISTEMAS') {
                            if (info.ContraseniaTemp == 0) {
                                location.href = '../Administrador/Inicio.php';
                            } else if (info.ContraseniaTemp == 1) {
                                location.href = '../Administrador/Cambio_de_contraseña_primera_vez.php';
                            }
                        }
                    }
                }
            },
    
            error: function(error) {
                output = '<div class="col-12">'+
                                    '<div class="alert alert-danger fade show text-center" role="alert">'+
                                        '<strong>¡Error. '+error+'!</strong>'+
                                    '</div>'+
                                '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            }
        });
    }

})
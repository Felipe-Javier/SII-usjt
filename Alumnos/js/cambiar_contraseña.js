$(document).ready(function () {

    "use strict";

    $("#show_password #btn-show-Pass").on('click', function() {
        if ($('#show_password #password').attr("type") == "text"){
            $('#show_password #password').attr('type', 'password');
            $('#show_password #btn-show-Pass i').addClass( "fa-eye-slash" );
            $('#show_password #btn-show-Pass i').removeClass( "fa-eye" );
        } else if ($('#show_password #password').attr("type") == "password"){
            $('#show_password #password').attr('type', 'text');
            $('#show_password #btn-show-Pass i').removeClass( "fa-eye-slash" );
            $('#show_password #btn-show-Pass i').addClass( "fa-eye" );
        }
    });

    $("#show_password_confirm #btn-show-passConfirm").on('click', function() {  
        if ($('#show_password_confirm #password-confirm').attr("type") == "text"){
            $('#show_password_confirm #password-confirm').attr('type', 'password');
            $('#show_password_confirm #btn-show-passConfirm i').addClass( "fa-eye-slash" );
            $('#show_password_confirm #btn-show-passConfirm i').removeClass( "fa-eye" );
        } else if ($('#show_password_confirm #password-confirm').attr("type") == "password"){
                $('#show_password_confirm #password-confirm').attr('type', 'text');
                $('#show_password_confirm #btn-show-passConfirm i').removeClass( "fa-eye-slash" );
                $('#show_password_confirm #btn-show-passConfirm i').addClass( "fa-eye" );
        }
    });

    var formCambioContraseñaPrimeraVez = $('#cambio-contraseña-primera-vez.needs-validation');
    
    var validation_CambioContraseñaPrimeraVez = Array.prototype.filter.call(formCambioContraseñaPrimeraVez, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-danger fade show text-center" role="alert">'+
                                '<strong>¡Atención: Ingrese su nueva contraseña para continuar!</strong>'+
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
                    var pass = form.querySelector('#password').value;
                    var pass_confirm = form.querySelector("#password-confirm").value;
                    if (pass != pass_confirm) {
                        form.classList.remove('was-validated');
                        form.querySelector('#password').classList.add('is-invalid');
                        form.querySelector('#password-confirm').classList.add('is-invalid');
                        var output = '<div class="col-12">'+
                            '<div class="alert alert-danger fade show text-center" role="alert">'+
                                '<strong>¡Las contraseñas no coinciden, verifiquelas y vuelva a intentarlo!</strong>'+
                            '</div>'+
                         '</div>';
                        $("#result").html(output);
                        $("#result .alert").fadeTo(2000, 500);
                        $("#result .alert").slideUp(500);
                    } else {
                        var idusuario = form.querySelector('#user-name').getAttribute('idusuario');
                        var username = form.querySelector('#user-name').value;
                        //console.log(idusuario, username, pass_confirm);
                        cambiar_contraseña_primera_vez(idusuario, username, pass_confirm);

                    }
                }
            }
        }, false);
    });

    function cambiar_contraseña_primera_vez(idusuario, username, pass_confirm) {
        $.ajax({
            url: "ajax/ajax_cambiar_contraseña.php",
            method: "POST",
            data: {IdUsuario: idusuario, Usuario: username, Contraseña: pass_confirm},
            async: true,

            beforeSend: function() {
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-primary fade show text-center" role="alert">'+
                                '<strong class="text-center">Actualizando contraseña</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            },

            success: function(response) {
                console.log(response);
                var output = "";
                if (response=='Error al cambiar su contraseña' || response=='No se ha podido cambiar su contraseña') {
                    $.confirm({
                        title: 'Actualizando contraseña',
                        content: response,
                        type: 'red',
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: false,
                        buttons: {
                            aceptar: {
                                text: 'Aceptar',
                                btnClass: 'btn btn-danger',
                                action: function () {
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else {
                    if (response == 'Su contraseña ha sido cambiada exitosamente') {
                        $.confirm({
                            title: 'Actualizando contraseña',
                            content: response,
                            type: 'green',
                            typeAnimated: true,
                            draggable: true,
                            dragWindowBorder: false,
                            buttons: {
                                aceptar: {
                                    text: 'Aceptar',
                                    btnClass: 'btn btn-success',
                                    action: function () {
                                        $(this).fadeOut();
                                        location.href = 'Inicio.php';
                                    }
                                }
                            }
                        });
                    }
                }
            },
    
            error: function(error) {
                $.confirm({
                    title: 'Actualizando contraseña',
                    content: 'Error al cambiar su contraseña. '+error,
                    type: 'red',
                    typeAnimated: true,
                    draggable: true,
                    dragWindowBorder: false,
                    buttons: {
                        aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn btn-danger',
                            action: function () {
                                $(this).fadeOut();
                            }
                        }
                    }
                });
            }
        });
    }

});
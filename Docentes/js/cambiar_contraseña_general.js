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
                    var Pass = form.querySelector('#password').value;
                    var Pass_Confirm = form.querySelector("#password-confirm").value;
                    if (Pass != Pass_Confirm) {
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
                        if (form.querySelector('#password').classList.contains('is-invalid') || 
                            form.querySelector('#password-confirm').classList.contains('is-invalid')) {
                            form.querySelector('#password').classList.remove('is-invalid');
                            form.querySelector('#password-confirm').classList.remove('is-invalid');
                        }

                        var IdUsuario = form.querySelector('#user-name').getAttribute('idusuario');
                        var Usuario = form.querySelector('#user-name').value;
                        var IdRolUsuario = $(".navbar #navbarContent .dropdown .nav-link").attr("IdRol");
                        var RolUsuario = $('.navbar #navbarContent .dropdown .dropdown-item-text').attr('RolUsuario');
                        
                        cambiar_contraseña(IdUsuario, Usuario, Pass_Confirm, IdRolUsuario, RolUsuario);
                    }
                }
            }
        }, false);
    });

    function cambiar_contraseña(IdUsuario, Usuario, Contrasenia, IdRolUsuario, RolUsuario) {
        var ContraseniaTemp = 0;
        
        $.ajax({
            url: "ajax/ajax_cambiar_contraseña.php",
            method: "POST",
            data: {IdUsuario: IdUsuario, Usuario: Usuario, Contrasenia: Contrasenia, ContraseniaTemp: ContraseniaTemp,
                   IdRolUsuario: IdRolUsuario, RolUsuario: RolUsuario},
            async: true,

            beforeSend: function() {
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-secondary fade show text-center" role="alert">'+
                                '<strong class="text-center">Cambiando contraseña</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            },

            success: function(response) {
                if (response=='Error al realizar la consulta' || response=='No se ha podido cambiar su contraseña') {
                    $.confirm({
                        title: 'Cambiando contraseña',
                        content: '<strong>'+response+'</strong>',
                        type: 'red',
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: false,
                        buttons: {
                            aceptar: {
                                text: 'Aceptar',
                                btnClass: 'btn btn-danger',
                                action: function () {
                                    $('#cambio-contraseña-primera-vez.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response=='No hay un registro de su cuenta de usuario o los datos son incorrectos') {
                    $.confirm({
                        title: 'Cambiando contraseña',
                        content: '<strong>'+response+'</strong>',
                        type: 'orange',
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: false,
                        buttons: {
                            aceptar: {
                                text: 'Aceptar',
                                btnClass: 'btn btn-warning',
                                action: function () {
                                    $('#cambio-contraseña-primera-vez.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response == 'Su contraseña ha sido cambiada exitosamente') {
                    $.confirm({
                        title: 'Cambiando contraseña',
                        content: '<strong>'+response+'</strong>',
                        type: 'green',
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: false,
                        buttons: {
                            aceptar: {
                                text: 'Aceptar',
                                btnClass: 'btn btn-success',
                                action: function () {
                                    $('#cambio-contraseña-primera-vez.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                }
            },
    
            error: function(error) {
                $.confirm({
                    title: 'Cambiando contraseña',
                    content: '<strong>Error al cambiar su contraseña. '+error+'</strong>',
                    type: 'red',
                    typeAnimated: true,
                    draggable: true,
                    dragWindowBorder: false,
                    buttons: {
                        aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn btn-danger',
                            action: function () {
                                $('#cambio-contraseña-primera-vez.needs-validation').removeClass('was-validated');
                                $(this).fadeOut();
                            }
                        }
                    }
                });
            }
        });
    }

});
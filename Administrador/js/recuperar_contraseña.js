$(document).ready(function () {

    "use strict";

    load_roles_usuario();

    function load_roles_usuario() {
        var IdUsuario = $(".navbar #navbarContent .dropdown .dropdown-item-text").attr("IdUsuario");
        var Usuario = $(".navbar #navbarContent .dropdown .dropdown-menu .dropdown-item-text").attr("Usuario");

        $.ajax({
            url:"ajax/ajax_ver_roles_de_usuario_existentes.php",
            method: "POST",
            data:{IdUsuario: IdUsuario, Usuario: Usuario},
            
            success: function(response) {
                if (response == 'Error al realizar la consulta' || 
                    response == 'No se han podido consultar los roles de usuario' ||
                    response == 'No se encontraron roles de usuario') {
                    var output = '';
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $('#form-recpass #RolUsuario').append(output);
                } else {
                    const info = JSON.parse(response);
                    var output = '';
                    var numRows = info.length;
                    for (var i=0; i<numRows; i++) {
                        output = '<option value="'+info[i].IdRol+'" NomRolUsuario="'+info[i].Clave+'">'+info[i].Rol+' --- '+info[i].Clave+'</option>';
                        $('#form-recpass #RolUsuario').append(output);
                    }
                }
            },

            error: function(error) {
                var output = '';
                output = '<option value="" selected disabled>Error al realizar la consulta. '+error+'</option>';
                $('#form-recpass #RolUsuario').append(output);
            }
        });
    }

    $("#show_password #btn-verPass").on('click', function(event) {
        event.preventDefault();
        if ($('#show_password #Pass').attr("type") == "text") {
            $('#show_password #Pass').attr('type', 'password');
            $('#show_password #btn-verPass i').addClass("fa-eye-slash");
            $('#show_password #btn-verPass i').removeClass("fa-eye");
        } else if ($('#show_password #Pass').attr("type") == "password") {
            $('#show_password #Pass').attr('type', 'text');
            $('#show_password #btn-verPass i').removeClass("fa-eye-slash");
            $('#show_password #btn-verPass i').addClass("fa-eye");
        }
    });

    $("#show_password_confirm #btn-verPassConfirm").on('click', function(event) {
        event.preventDefault();
        if ($('#show_password_confirm #PassConfirm').attr("type") == "text") {
            $('#show_password_confirm #PassConfirm').attr('type', 'password');
            $('#show_password_confirm #btn-verPassConfirm i').addClass("fa-eye-slash");
            $('#show_password_confirm #btn-verPassConfirm i').removeClass("fa-eye");
        } else if ($('#show_password_confirm #PassConfirm').attr("type") == "password") {
            $('#show_password_confirm #PassConfirm').attr('type', 'text');
            $('#show_password_confirm #btn-verPassConfirm i').removeClass("fa-eye-slash");
            $('#show_password_confirm #btn-verPassConfirm i').addClass("fa-eye");
        }
    });

    $("#form-recpass #RolUsuario").on("change", function() {
        var IdRol = $(this).val();
        var output = '';
        
        if (IdRol != 9) {
            output = '<label class="title-input" for="NoEmpleado">Número de empleado</label>'+
                     '<input type="number" class="form-control text-center" id="NoEmpleado" value="" required>';
            $("#form-recpass #NumEmpleado").html(output);
        } if (IdRol == 9) {
            $("#form-recpass #NumEmpleado").html("");
        }
    });

    var formRecPass = $('#form-recpass.needs-validation');
    
    var validation_RecPass = Array.prototype.filter.call(formRecPass, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                $.confirm({
                    title: 'Recuperación de contraseña',
                    content: '<strong>¡Por favor ingrese los datos solicitados para continuar!</strong>',
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
                if (form.checkValidity() == true) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    var Pass = form.querySelector('#Pass').value;
                    var Pass_Confirm = form.querySelector("#PassConfirm").value;
                    if (Pass != Pass_Confirm) {
                        form.classList.remove('was-validated');
                        form.querySelector('#Pass').classList.add('is-invalid');
                        form.querySelector('#PassConfirm').classList.add('is-invalid');
                        $.confirm({
                            title: 'Recuperación de contraseña',
                            content: '<strong>¡Las contraseñas no coinciden, verifiquelas y vuelva a intentarlo!</strong>',
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
                        if (form.querySelector('#Pass').classList.contains('is-invalid') || 
                            form.querySelector('#PassConfirm').classList.contains('is-invalid')) {
                            form.querySelector('#Pass').classList.remove('is-invalid');
                            form.querySelector('#PassConfirm').classList.remove('is-invalid');
                        }
                        var IdUsuarioActualiza = form.querySelector('#UsuarioActualiza').getAttribute('IdUsuarioAct');
                        var UsuarioActualiza = form.querySelector('#UsuarioActualiza').value;
                        var RolUsuarioActualiza = $('.navbar #navbarContent .dropdown .dropdown-item-text').attr('RolUsuario');
                        var Usuario = form.querySelector('#Usuario').value;
                        var PasswordTemp = form.querySelector('.custom-control-input[name="PassTemp"]:checked').value;
                        var IdRolUsuario = form.querySelector('#RolUsuario option:checked').value;
                        var RolUsuario = form.querySelector('#RolUsuario option:checked').getAttribute('NomRolUsuario');

                        if (IdRolUsuario == 9) {
                            recuperar_contraseña(IdUsuarioActualiza, UsuarioActualiza, RolUsuarioActualiza, Usuario, Pass_Confirm, 
                                                PasswordTemp, IdRolUsuario, RolUsuario, NumEmpleado=null);
                        } else {
                            var NumEmpleado = form.querySelector('#NoEmpleado').value;
                            recuperar_contraseña(IdUsuarioActualiza, UsuarioActualiza, RolUsuarioActualiza, Usuario, Pass_Confirm, 
                                                PasswordTemp, IdRolUsuario, RolUsuario, NumEmpleado);
                        }
                    }
                }
            }
        }, false);
    });

    function recuperar_contraseña(IdUsuarioActualiza, UsuarioActualiza, RolUsuarioActualiza, Usuario, Password, PasswordTemp, 
                                IdRolUsuario, RolUsuario, NumEmpleado) {
        var data = new Array();

        if (IdRolUsuario == 9) {
            data = {IdUsuarioActualiza: IdUsuarioActualiza, UsuarioActualiza: UsuarioActualiza, 
                RolUsuarioActualiza: RolUsuarioActualiza, Usuario: Usuario, Password: Password, PasswordTemp: PasswordTemp, 
                IdRolUsuario: IdRolUsuario, RolUsuario: RolUsuario};
        } else if (IdRolUsuario != 9) {
            data = {IdUsuarioActualiza: IdUsuarioActualiza, UsuarioActualiza: UsuarioActualiza, 
                RolUsuarioActualiza: RolUsuarioActualiza, Usuario: Usuario, Password: Password, PasswordTemp: PasswordTemp, 
                IdRolUsuario: IdRolUsuario, RolUsuario: RolUsuario, NumEmpleado: NumEmpleado};
        }
        
        $.ajax({
            url: "ajax/ajax_recuperar_contraseña.php",
            method: "POST",
            async: true,
            data: data,

            beforeSend: function() {
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-secondary fade show text-center" role="alert">'+
                                '<strong class="text-center">¡Recuperando contraseña ...!</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result").fadeTo(2000, 500);
                $("#result").slideUp(500);
            },

            success: function(response) {
                if (response=='Error al realizar la consulta' || response=='No se ha podido recuperar la contraseña') {
                    $.confirm({
                        title: 'Recuperando contraseña',
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
                                    $('#form-recpass.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response=='El usuario al que intenta recuperar la contraseña no existe o los datos son incorrectos') {
                    $.confirm({
                        title: 'Recuperando contraseña',
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
                                    $('#form-recpass.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response == 'La contraseña ha sido recuperada exitosamente') {
                    $.confirm({
                        title: 'Recuperando contraseña',
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
                                    $('#form-recpass.needs-validation').removeClass('was-validated');
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                }
            },
    
            error: function(error) {
                $.confirm({
                    title: 'Recuperando contraseña',
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
                                $('#form-recpass.needs-validation').removeClass('was-validated');
                                $(this).fadeOut();
                            }
                        }
                    }
                });
            }
        });
    }

});
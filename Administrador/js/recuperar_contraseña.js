$(document).ready(function () {

    "use strict";

    load_roles_usuario();

    function load_roles_usuario() {
        var Action = 'Consultar_Roles_Usuario';

        $.ajax({
            url:"ajax/ajax_recuperar_contraseña.php",
            method: "POST",
            data:{Action: Action},
            
            success: function(response) {
                if (response == 'Error al realizar la consulta' || 
                    response == 'No se han podido consultar los roles de usuario') {
                    var output = '';
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $('#form-recpass #RolUsuario').append(output);
                } else if (response == 'No se encontraron roles de usuario') {
                    var output = '';
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $('#form-recpass #RolUsuario').append(output);
                } else {
                    const info = JSON.parse(response);
                    var output = '';
                    var numRows = info.length;
                    for (var i=0; i<numRows; i++) {
                        output = '<option value="'+info[i].IdRol+'">'+info[i].Rol+' --- '+info[i].Clave+'</option>';
                        $('#form-recpass #RolUsuario').append(output);
                    }
                }
            },

            error: function(error) {
                var output = '';
                output = '<option value="" selected disabled>Error al consultar los roles de usuario. '+error+'</option>';
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
                $("#show_password #btn-verPass").removeClass("verPassword");
                $("#show_password_confirm #btn-verPassConfirm").removeClass("verPassword");
                $("#show_password #btn-verPass").addClass("validate-btn-danger");
                $("#show_password_confirm #btn-verPassConfirm").addClass("validate-btn-danger");
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
                    $("#show_password #btn-verPass").removeClass("validate-btn-danger");
                    $("#show_password_confirm #btn-verPassConfirm").removeClass("validate-btn-danger");
                    $("#show_password #btn-verPass").addClass("validate-btn-success");
                    $("#show_password_confirm #btn-verPassConfirm").addClass("validate-btn-success");
                    var Pass = form.querySelector('#Pass').value;
                    var Pass_Confirm = form.querySelector("#PassConfirm").value;
                    if (Pass != Pass_Confirm) {
                        form.classList.remove('was-validated');
                        form.querySelector('#Usuario').classList.add('is-valid');
                        form.querySelector('#Pass').classList.add('is-invalid');
                        form.querySelector('#PassConfirm').classList.add('is-invalid');
                        $("#show_password #btn-verPass").removeClass("validate-btn-success");
                        $("#show_password_confirm #btn-verPassConfirm").removeClass("validate-btn-success");
                        $("#show_password #btn-verPass").addClass("validate-btn-danger");
                        $("#show_password_confirm #btn-verPassConfirm").addClass("validate-btn-danger");
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
                        var Usuario = form.querySelector('#Usuario').value;
                        var IdRolUsuario = form.querySelector('#RolUsuario').value;
                        var IdUsuarioAct = form.querySelector('#UsuarioActualiza').getAttribute('IdUsuarioAct');
                        
                        if (IdRolUsuario == 9) {
                            recuperar_contraseña(Usuario, IdRolUsuario, NumEmpleado=null, Pass_Confirm, IdUsuarioAct);
                        } else {
                            var NumEmpleado = form.querySelector('#NoEmpleado').value;
                            recuperar_contraseña(Usuario, IdRolUsuario, NumEmpleado, Pass_Confirm, IdUsuarioAct);
                        }
                    }
                }
            }
        }, false);
    });

    function recuperar_contraseña(Usuario, IdRolUsuario, NumEmpleado, Pass_Confirm, IdUsuarioAct) {
        var Action = "Actualizar_Contraseña";

        $.ajax({
            url: "ajax/ajax_recuperar_contraseña.php",
            method: "POST",
            data: {Action, Action, Usuario: Usuario, Password: Pass_Confirm, IdRolUsuario: IdRolUsuario, 
                   NumEmpleado: NumEmpleado, IdUsuarioAct: IdUsuarioAct},
            async: true,

            beforeSend: function() {
                $.confirm({
                    title: 'Recuperación de contraseña',
                    content: '<strong>¡Actualizando contraseña ...!</strong>',
                    type: 'blue',
                    typeAnimated: true,
                    draggable: true,
                    dragWindowBorder: false,
                    buttons: {
                        aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn btn-primary',
                            action: function () {
                                $(this).fadeOut();
                            }
                        }
                    }
                });
            },

            success: function(response) {
                var output = "";
                if (response=='Error al realizar la consulta' || response=='No se ha podido cambiar la contraseña') {
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
                    if (response == 'La contraseña ha sido cambiada exitosamente') {
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
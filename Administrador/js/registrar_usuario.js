$(document).ready(function () {
    
    'use strict';

    load_roles_usuario();

    function load_roles_usuario() {
        var Action = 'Consultar_Roles_Usuario';

        $.ajax({
            url:"ajax/ajax_ver_roles_usuario.php",
            method: "POST",
            data:{Action: Action},
            
            success: function(response) {
                if (response== 'Error al consultar los roles de usuario' || 
                    response == 'No se han podido consultar los roles de usuario') {
                    var output = '';
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $('#form-reguser #Rol_Usuario').append(output);
                } else if (response == 'No se encontraron roles de usuario') {
                    var output = '';
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $('#form-reguser #Rol_Usuario').append(output);
                } else {
                    const info = JSON.parse(response);
                    var output = '';
                    var numRows = info.length;
                    for (var i=0; i<numRows; i++) {
                        output = '<option value="'+info[i].IdRol+'">'+info[i].Rol+' --- '+info[i].Clave+'</option>';
                        $('#form-reguser #Rol_Usuario').append(output);
                    }
                }
            },

            error: function(error) {
                var output = '';
                output = '<option value="" selected disabled>Error al consultar los roles de usuario. '+error+'</option>';
                $('#form-reguser #Rol_Usuario').append(output);
            }
        });
    }

    $("#search #buscar").on('click', function() {
        var Clave = $('#search #clave').val();
        var TipoPersona = $('#search #tipo_persona').val();
        var Action = 'Buscar empleado o alumno';
        
        $.ajax({
            url:"ajax/ajax_registrar_usuario.php",
            method: "POST",
            data:{Action: Action, Clave: Clave, TipoPersona: TipoPersona},
            

            success: function(response) {
                if (response== 'Error al buscar el empleado/alumno' || 
                    response == 'No se ha podido buscar el empleado/alumno con los datos ingresados') {
                    $.confirm({
                        title: 'Buscando empleado/alumno',
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
                    if (response == 'No se encontraron empleados/alumnos registrados con los datos ingresados') {
                        $.confirm({
                            title: 'Buscando empleado/alumno',
                            content: response,
                            type: 'orange',
                            typeAnimated: true,
                            draggable: true,
                            dragWindowBorder: false,
                            buttons: {
                                aceptar: {
                                    text: 'Aceptar',
                                    btnClass: 'btn btn-warning',
                                    action: function () {
                                        $(this).fadeOut();
                                    }
                                }
                            }
                        });
                    } else {
                        const info = JSON.parse(response);
                        var output = '';
                        $('#form-reguser #row-nomcompleto #Nombres').val(info[0].NOMBRES);
                        $('#form-reguser #row-nomcompleto #Apellido_Paterno').val(info[0].APELLIDOPATERNO);
                        $('#form-reguser #row-nomcompleto #Apellido_Materno').val(info[0].APELLIDOMATERNO);
                        if (TipoPersona == 'PERSONAL') {
                            var exists = info.includes(info[0], 'IDINSTRUCTOR');
                            output = output + '<div class="col-md-4 mb-3">'+
                                            '<label for="NumEmpleado">Número de empleado</label>'+
                                            '<input type="number" class="form-control text-center" id="NumEmpleado" value="'+info[0].NOEMPLEADO+'" disabled required>'+
                                        '</div>'+
                                        '<div class="col-md-4 mb-3">'+
                                            '<label for="IdPersona">Id de persona</label>'+
                                            '<input type="number" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                        '</div>';
                                    if (exists === true) {
                                        output = output + '<div class="col-md-4 mb-3">'+
                                            '<label for="IdInstructor">Id de instructor</label>'+
                                            '<input type="number" class="form-control text-center" id="IdInstructor" value="'+info[0].IDINSTRUCTOR+'" disabled required>'+
                                        '</div>';
                                    }
                            $('#form-reguser #row-claves-persona').html(output);
                        } else if (TipoPersona == 'ALUMNOS') {
                            output =    '<div class="col-md-4 mb-3">'+
                                            '<label for="IdPersona">Id de persona</label>'+
                                            '<input type="number" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                        '</div>'+
                                        '<div class="col-md-4 mb-3">'+
                                            '<label for="IdAlumno">Id de alumno</label>'+
                                            '<input type="number" class="form-control text-center" id="IdAlumno" value="'+info[0].IDALUMNO+'" disabled required>'+
                                        '</div>';
                            $('#form-reguser #row-claves-persona').html(output);
                            $('#form-reguser #Usuario').val(info[0].MATRICULA);
                        }
                    }
                }
            },

            error: function(error) {
                $.confirm({
                    title: 'Buscando empleado/alumno',
                    content: 'Error al buscar el empleado/alumno. '+error,
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
    });

    $('#form-reguser .form-row .verPassword').on('click', function() {
        var tipo = $('#form-reguser .form-row #Password').attr('type');
        if (tipo == "password") {
            $('#form-reguser .form-row #Password').attr('type', 'text');
        } else {
            $('#form-reguser .form-row #Password').attr('type', 'password');
        }
    });

    var FormRegUser = $('#form-reguser.needs-validation');
    
    var validation_RegUser = Array.prototype.filter.call(FormRegUser, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                $.confirm({
                    title: 'Registrando usuario',
                    content: '<Strong>Atención ingrese los datos de registro faltantes para continuar</Strong>',
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
            } else if (form.checkValidity() == true) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                registrar_usuario();
            }
        }, false);
    });

    function registrar_usuario() {
        var Action = 'Registrar usuario';
        var Nombres = $('#form-reguser #row-nomcompleto #Nombres').val();
        var ApellidoPaterno = $('#form-reguser #row-nomcompleto #Apellido_Paterno').val();
        var ApellidoMaterno = $('#form-reguser #row-nomcompleto #Apellido_Materno').val();
        var IdRolUsuario = $('#form-reguser #Rol_Usuario').val();
        var Usuario = $('#form-reguser #Usuario').val();
        var Password = $('#form-reguser #Password').val();
        var PasswordTemp = $('#form-reguser input[name="PassTemp"]:checked').val();
        var Activo = $('#form-reguser input[name="ActInact"]:checked').val();
        var Bloqueado = $('#form-reguser input[name="BloqDesbloq"]:checked').val();
        var IdUserReg = $('#form-reguser #UsuarioReg').attr('IdUsuarioReg');

        if (IdRolUsuario == 9) {
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            var IdAlumno = $('#form-reguser #row-claves-persona #IdAlumno').val();
            
            var UserData = {Action: Action, IdPersona: IdPersona, IdAlumno: IdAlumno, Nombres: Nombres, ApellidoPaterno: ApellidoPaterno,
                            ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, Contrasenia: Password, ContraseniaTemp: PasswordTemp,
                            Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, IdUsuarioRegistra: IdUserReg};
        } else if (IdRolUsuario == 8) {
            var NumEmpleado = $('#form-reguser #row-claves-persona #NumEmpleado').val();
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            var IdInstructor = $('#form-reguser #row-claves-persona #IdInstructor').val();
            
            var UserData = {Action: Action, NumEmpleado: NumEmpleado, IdPersona: IdPersona, IdInstructor: IdInstructor, Nombres: Nombres, 
                            ApellidoPaterno: ApellidoPaterno, ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, Contrasenia: Password, 
                        ContraseniaTemp: PasswordTemp, Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, IdUsuarioRegistra: IdUserReg};
        } else if (IdRolUsuario != 9 && IdRolUsuario != 8) {
            var NumEmpleado = $('#form-reguser #row-claves-persona #NumEmpleado').val();
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            
            var UserData = {Action: Action, NumEmpleado: NumEmpleado, IdPersona: IdPersona, Nombres: Nombres, 
                ApellidoPaterno: ApellidoPaterno, ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, Contrasenia: Password, 
                ContraseniaTemp: PasswordTemp, Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, IdUsuarioRegistra: IdUserReg};
        }
        
        console.log(UserData);

        $.ajax({
            url: "ajax/ajax_registrar_usuario.php",
            method: "POST",
            async: true,
            data: UserData,
            
            success: function(response) {
                console.log(response);
                if (response== 'Error al registrar el usuario' || 
                    response == 'No se ha podido registrar el usuario') {
                    $.confirm({
                        title: 'Registrando usuario',
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
                } else if (response == 'El usuario ha sido registrado exitosamente') {
                    $.confirm({
                        title: 'Registrando usuario',
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
            },

            error: function(error) {
                $.confirm({
                    title: 'Registrando usuario',
                    content: 'Error al buscar el empleado/alumno. '+error,
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
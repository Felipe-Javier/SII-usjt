$(document).ready(function () {
    
    'use strict';

    load_roles_usuario();

    function load_roles_usuario() {
        var IdUsuario = $(".navbar #navbarContent .dropdown .dropdown-menu .dropdown-item-text").attr("IdUsuario");
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
                    $('#form-reguser #Rol_Usuario').append(output);
                } else {
                    const info = JSON.parse(response);
                    var output = '';
                    var numRows = info.length;
                    for (var i=0; i<numRows; i++) {
                        output = '<option value="'+info[i].IdRol+'" NomRolUsuario="'+info[i].Clave+'">'+info[i].Rol+' --- '+info[i].Clave+'</option>';
                        $('#form-reguser #Rol_Usuario').append(output);
                    }
                }
            },

            error: function(error) {
                var output = '';
                output = '<option value="" selected disabled>Error al realizar la consulta. '+error+'</option>';
                $('#form-reguser #Rol_Usuario').append(output);
            }
        });
    }

    var FormSearchUser = $('#form-searchuser.needs-validation');
    
    var validation_SearchUser = Array.prototype.filter.call(FormSearchUser, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                $.confirm({
                    title: 'Buscando empleado/alumno',
                    content: '<Strong>Atención ingrese los datos de busqueda faltantes para continuar</Strong>',
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
                buscar_empleado_alumno();
            }
        }, false);
    });

    function buscar_empleado_alumno() {
        var IdUsuario = $(".navbar #navbarContent .dropdown .dropdown-menu .dropdown-item-text").attr("IdUsuario");
        var Usuario = $(".navbar #navbarContent .dropdown .dropdown-menu .dropdown-item-text").attr("Usuario");
        var Clave = $('#search #clave').val();
        var TipoPersona = $('#search #tipo_persona').val();
        
        $.ajax({
            url:"ajax/ajax_buscar_empleado_alumno_por_clave.php",
            method: "POST",
            data:{IdUsuario: IdUsuario, Usuario: Usuario, Clave: Clave, TipoPersona: TipoPersona},
            

            success: function(response) {
                if (response== 'Error al realizar la consulta' || 
                    response == 'No se ha podido buscar el empleado/alumno con los datos ingresados') {
                    $.confirm({
                        title: 'Buscando empleado/alumno',
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
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response == 'No se encontraron EMPLEADOS EN GENERAL registrados con los datos ingresados' ||
                           response == 'No se encontraron DOCENTES registrados con los datos ingresados' ||
                           response == 'No se encontraron ALUMNOS registrados con los datos ingresados') {
                        $.confirm({
                            title: 'Buscando empleado/alumno',
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
                    if (TipoPersona == 'PERSONAL_GENERAL' || TipoPersona == 'DOCENTES') {
                        var exists = info.includes(info[0], 'IDINSTRUCTOR');
                        output = output + '<div class="col-md-4 mb-3">'+
                                            '<label class="label-titles" for="NumEmpleado">Número de empleado</label>'+
                                            '<input type="number" class="form-control text-center" id="NumEmpleado" value="'+info[0].NOEMPLEADO+'" disabled required>'+
                                        '</div>'+
                                        '<div class="col-md-4 mb-3">'+
                                            '<label class="label-titles" for="IdPersona">Id de persona</label>'+
                                            '<input type="number" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                        '</div>';
                                    if (exists === true) {
                                        output = output + '<div class="col-md-4 mb-3">'+
                                            '<label class="label-titles" for="IdInstructor">Id de instructor</label>'+
                                            '<input type="number" class="form-control text-center" id="IdInstructor" value="'+info[0].IDINSTRUCTOR+'" disabled required>'+
                                        '</div>';
                                    }
                        $('#form-reguser #row-claves-persona').html(output);
                    } else if (TipoPersona == 'ALUMNOS') {
                        output =    '<div class="col-md-4 mb-3">'+
                                        '<label class="label-titles" for="IdPersona">Id de persona</label>'+
                                        '<input type="number" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                    '</div>'+
                                    '<div class="col-md-4 mb-3">'+
                                        '<label class="label-titles" for="IdAlumno">Id de alumno</label>'+
                                        '<input type="number" class="form-control text-center" id="IdAlumno" value="'+info[0].IDALUMNO+'" disabled required>'+
                                    '</div>'+
                                    '<div class="col-md-4 mb-3">'+
                                        '<label class="label-titles" for="IdAlumnoMatricula">Id de alumno matricula</label>'+
                                        '<input type="number" class="form-control text-center" id="IdAlumnoMatricula" value="'+info[0].IDALUMNOMATRICULA+'" disabled required>'+
                                    '</div>';
                        $('#form-reguser #row-claves-persona').html(output);
                        $('#form-reguser #Usuario').val(info[0].MATRICULA);
                    }
                }
            },

            error: function(error) {
                $.confirm({
                    title: 'Buscando empleado/alumno',
                    content: '<strong>Error al realizar la consulta. '+error+'</strong>',
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

    $("#show_password #btn-showPassword").on('click', function() {
        if ($('#show_password #Password').attr("type") == "text") {
            $('#show_password #Password').attr('type', 'password');
            $('#show_password #btn-showPassword i').addClass("fa-eye-slash");
            $('#show_password #btn-showPassword i').removeClass("fa-eye");
        } else if ($('#show_password #Password').attr("type") == "password") {
            $('#show_password #Password').attr('type', 'text');
            $('#show_password #btn-showPassword i').removeClass("fa-eye-slash");
            $('#show_password #btn-showPassword i').addClass("fa-eye");
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
        var TipoIdentificacion = $('#form-searchuser #tipo_persona>option:selected').val();;
        var Nombres = $('#form-reguser #row-nomcompleto #Nombres').val();
        var ApellidoPaterno = $('#form-reguser #row-nomcompleto #Apellido_Paterno').val();
        var ApellidoMaterno = $('#form-reguser #row-nomcompleto #Apellido_Materno').val();
        var IdRolUsuario = $('#form-reguser #Rol_Usuario>option:selected').val();
        var NomRolUsuario = $('#form-reguser #Rol_Usuario>option:selected').attr('NomRolUsuario');
        var Usuario = $('#form-reguser #Usuario').val();
        var Password = $('#form-reguser #Password').val();
        var PasswordTemp = $('#form-reguser input[name="PassTemp"]:checked').val();
        var Activo = $('#form-reguser input[name="ActInact"]:checked').val();
        var Bloqueado = $('#form-reguser input[name="BloqDesbloq"]:checked').val();
        var IdUserReg = $('#form-reguser #UsuarioReg').attr('IdUsuarioReg');
        var NombreUserReg = $('#form-reguser #UsuarioReg').val();

        if (IdRolUsuario == 9) {
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            var IdAlumno = $('#form-reguser #row-claves-persona #IdAlumno').val();
            var IdAlumnoMatricula = $('#form-reguser #row-claves-persona #IdAlumnoMatricula').val();
            
            var UserData = {TipoIdentificacion: TipoIdentificacion, IdPersona: IdPersona, IdAlumno: IdAlumno, IdAlumnoMatricula: IdAlumnoMatricula,
                            Nombres: Nombres, ApellidoPaterno: ApellidoPaterno, ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, Contrasenia: Password, 
                            ContraseniaTemp: PasswordTemp, Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, 
                            NomRolUsuario: NomRolUsuario, IdUsuarioRegistra: IdUserReg, NombreUsuarioRegistra: NombreUserReg};
            
        } else if (IdRolUsuario == 8) {
            var NumEmpleado = $('#form-reguser #row-claves-persona #NumEmpleado').val();
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            var IdInstructor = $('#form-reguser #row-claves-persona #IdInstructor').val();
            
            var UserData = {TipoIdentificacion: TipoIdentificacion, NumEmpleado: NumEmpleado, IdPersona: IdPersona, IdInstructor: IdInstructor, 
                            Nombres: Nombres, ApellidoPaterno: ApellidoPaterno, ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, 
                            Contrasenia: Password, ContraseniaTemp: PasswordTemp, Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, 
                            NomRolUsuario: NomRolUsuario, IdUsuarioRegistra: IdUserReg, NombreUsuarioRegistra: NombreUserReg};
        } else if (IdRolUsuario != 9 && IdRolUsuario != 8) {
            var NumEmpleado = $('#form-reguser #row-claves-persona #NumEmpleado').val();
            var IdPersona = $('#form-reguser #row-claves-persona #IdPersona').val();
            
            var UserData = {TipoIdentificacion: TipoIdentificacion, NumEmpleado: NumEmpleado, IdPersona: IdPersona, Nombres: Nombres, 
                            ApellidoPaterno: ApellidoPaterno, ApellidoMaterno: ApellidoMaterno, Usuario: Usuario, Contrasenia: Password, 
                            ContraseniaTemp: PasswordTemp, Activo: Activo, Bloqueado: Bloqueado, IdRolUsuario: IdRolUsuario, 
                            NomRolUsuario: NomRolUsuario, IdUsuarioRegistra: IdUserReg, NombreUsuarioRegistra: NombreUserReg};
        }
        
        $.ajax({
            url: "ajax/ajax_registrar_usuario.php",
            method: "POST",
            async: true,
            data: UserData,
            
            success: function(response) {
                if (response== 'Error al realizar el registro' || 
                    response == 'No se ha podido registrar el usuario') {
                    $.confirm({
                        title: 'Registrando usuario',
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
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response == 'Ya existe una cuenta con el mismo nombre de usuario' ||
                           response == 'La persona a la que se le esta creando una cuenta de usuario no es ALUMNO' ||
                           response == 'La persona a la que se le esta creando una cuenta de usuario no es DOCENTE' ||
                           response == 'La persona a la que se le esta creando una cuenta de usuario no es EMPLEADO EN GENERAL') {
                    $.confirm({
                        title: 'Registrando usuario',
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
                                    $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else if (response == 'El usuario ha sido registrado exitosamente') {
                    $.confirm({
                        title: 'Registrando usuario',
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
                    content: '<strong>Error al realizar el registro. '+error+'</strong>',
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
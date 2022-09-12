$(document).ready(function () {
    
    'use strict';

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
                                            '<input type="text" class="form-control text-center" id="NumEmpleado" value="'+info[0].NOEMPLEADO+'" disabled required>'+
                                        '</div>'+
                                        '<div class="col-md-4 mb-3">'+
                                            '<label for="IdPersona">Id de persona</label>'+
                                            '<input type="text" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                        '</div>';
                                    if (exists === true) {
                                        output = output + '<div class="col-md-4 mb-3">'+
                                            '<label for="IdInstructor">Id de instructor</label>'+
                                            '<input type="text" class="form-control text-center" id="IdInstructor" value="'+info[0].IDINSTRUCTOR+'" disabled required>'+
                                        '</div>';
                                    }
                            $('#form-reguser #row-claves-persona').html(output);
                        } else if (TipoPersona == 'ALUMNOS') {
                            output =    '<div class="col-md-4 mb-3">'+
                                            '<label for="IdPersona">Id de persona</label>'+
                                            '<input type="text" class="form-control text-center" id="IdPersona" value="'+info[0].IDPERSONA+'" disabled required>'+
                                        '</div>'+
                                        '<div class="col-md-4 mb-3">'+
                                            '<label for="IdAlumno">Id de alumno</label>'+
                                            '<input type="text" class="form-control text-center" id="IdAlumno" value="'+info[0].IDALUMNO+'" disabled required>'+
                                        '</div>';
                            $('#form-reguser #row-claves-persona').html(output);
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
    
    window.addEventListener('load', function() {
        // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap 
        var forms = document.getElementsByClassName('needs-validation');
        // Bucle sobre ellos y evitar la presentación
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);


    function registrar_usuario() {
        var Nombres = $('#form-reguser #row-nomcompleto #Nombres').val();
        var ApellidoPaterno = $('#form-reguser #row-nomcompleto #Apellido_Paterno').val();
        var ApellidoMaterno = $('#form-reguser #row-nomcompleto #Apellido_Materno').val();
        var RolUsuario = $('#form-reguser #row-nomcompleto #Rol_Usuario').val();
        $.ajax({
            url:"ajax/ajax_registrar_usuario.php",
            method: "POST",
            data:{Action: Action, Clave: Clave, TipoPersona: TipoPersona},
            

            success: function(response) {
                if (response== 'Error al registrar el usuario' || 
                    response == 'No se ha podido registrar el usuario con los datos ingresados') {
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
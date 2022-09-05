$(document).ready(function () {
    
    'use strict';

    $("#buscar").on('click', function() {
        var Clave = $('#clave').val();
        var TipoPersona = $('#tipo_persona').val();

        console.log(Clave + TipoPersona);
        
        $.ajax({
            url:"ajax/ajax_registrar_usuario.php",
            method: "POST",
            data:{Action: 'Buscar empleado o alumno', Clave: Clave, TipoPersona: TipoPersona},
            

            success: function(response) {
                console.log(response);
                if (response== 'Ingrese los datos de busqueda' || 
                    response == 'Error al buscar el empleado/alumno') {
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
                    if (response == 'No hay empleados/alumnos registrados con esa clave') {
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

    // Boton para ver la contraseña

    $('.form-row .verPassword').on('click', function() {
        mostrarContraseña()
    });

    function mostrarContraseña(){
        var tipo = document.getElementById("password");
        if(tipo.type == "password"){
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
});
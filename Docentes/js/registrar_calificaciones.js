$(document).ready(function () {
    var IdPersona = $("#barra #datos-usuario").attr("IdPersona");
    var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");

    load_grupos(IdPersona, IdInstructor);

    function load_grupos(IdPersona, IdInstructor) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                IdPersona: IdPersona,
                IdInstructor: IdInstructor
            },

            success: function (response) {
                var output = "";
                if (response == 'Ingrese los datos de usuario para ver los grupos asignados' || response == 'No se ha podido consultar los grupos asignados') {
                    $.confirm({
                        title: 'Consultando grupos asignados',
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
                    if (response == 'No se encontraron grupos asignados') {
                        output = '<option value="" selected>' + response + '</option>';
                        $("#barra #grupos").append(output);
                    } else {
                        var info = JSON.parse(response);
                        var array = [];
                        array = info;
                        var numRows = array.length;
                        for (var i = 0; i < numRows; i++) {
                            output = '<option value="' + array[i].IDGRUPO + '" idplanmateria="' + array[i].IDPLANMATERIA + '"' +
                                'materia="' + array[i].MATERIA + '">' + array[i].GRUPO + '</option>';
                            $("#barra #grupos").append(output);
                        }
                    }
                }
            },

            error: function (error) {
                $("#result").html(error);
            }
        });
    }

    $("#barra #grupos").on("change", function (event) {
        event.preventDefault();

        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $("#barra #grupos").val();
        var IdPlanMateria = $("#barra #grupos option:selected").attr("idplanmateria");
        var Materia = $("#barra #grupos option:selected").attr("materia");

        $.ajax({
            url: "ajax/ajax_ver_alumnos.php",
            method: "POST",
            async: true,
            data: {
                IdGrupo: IdGrupo,
                IdInstructor: IdInstructor
            },

            success: function (response) {
                var output = "";
                if (response == 'Ingrese los datos de usuario para ver los grupos asignados' || response == 'No se ha podido consutar los alumnos registrados') {
                    $.confirm({
                        title: 'Consultando alumnos de este grupo',
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
                    output = response;
                    $("#contenido-cuerpo #result").html(output);
                    if (Materia == "null") {
                        $("#contenido-cuerpo #Nombre_Materia").html("No hay una materia activa en este grupo");
                    } else {
                        $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria", IdPlanMateria);
                        $("#contenido-cuerpo #Nombre_Materia").html(Materia);
                    }
                }
            },

            error: function (error) {
                $("#result").html(error);
            }
        });
    });

    $("body").on("click", "#contenido-cuerpo #result #btn-reg-cal", function (event) {
        event.preventDefault();

        var Matriculas = new Array();
        var IdsRelsGruposAlumnos = new Array();
        var Calificaciones = new Array();
        var IdsTiposCortes = new Array();
        var IdsTiposCalificaciones = new Array();
        var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");

        $("#contenido-cuerpo #table-subir-cal tbody .th-td-mat").each(function () {
            if ($(this).html != "") {
                Matriculas.push($(this).html());
            }
        });

        $("#contenido-cuerpo #table-subir-cal .input-cal").each(function () {
            if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2842") {
                Calificaciones.push($(this).val());
                IdsRelsGruposAlumnos.push($(this).attr("IdRelGrupoAlumno"));
                IdsTiposCortes.push($(this).attr("IdTipoCorte"));
            } else {
                if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2843") {
                    Calificaciones.push($(this).val());
                    IdsRelsGruposAlumnos.push($(this).attr("IdRelGrupoAlumno"));
                    IdsTiposCortes.push($(this).attr("IdTipoCorte"));
                } else {
                    if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2844") {
                        Calificaciones.push($(this).val());
                        IdsRelsGruposAlumnos.push($(this).attr("IdRelGrupoAlumno"));
                        IdsTiposCortes.push($(this).attr("IdTipoCorte"));
                    }
                }
            }
        });

        $("#contenido-cuerpo #table-subir-cal .tipo-cal").each(function () {
            if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2842") {
                IdsTiposCalificaciones.push($(this).val());
            } else {
                if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2843") {
                    IdsTiposCalificaciones.push($(this).val());
                } else {
                    if ($(this).val() != "" && $(this).attr("IdTipoCorte") == "2844") {
                        IdsTiposCalificaciones.push($(this).val());
                    }
                }
            }
        });

        console.log(Matriculas);
        /*console.log(IdsRelsGruposAlumnos);
        console.log(Calificaciones);
        console.log(IdsTiposCortes);
        console.log(IdsTiposCalificaciones);
        console.log(IdPlanMateria);
        console.log(IdUsuario);*/

        $.confirm({
            title: 'Registrando calificaciones de los alumnos',
            content: 'Se registraran las calificaciones en el sistema. ¿Esta seguro que desea continuar?',
            type: 'blue',
            typeAnimated: true,
            draggable: true,
            dragWindowBorder: false,
            buttons: {
                aceptar: {
                    text: 'Aceptar',
                    btnClass: 'btn btn-primary',
                    action: function () {
                        $.ajax({
                            url: "ajax/ajax_registrar_calificaciones.php",
                            method: "POST",
                            async: true,
                            data: {
                                Matriculas: Matriculas,
                                IdsRelsGruposAlumnos: IdsRelsGruposAlumnos,
                                Calificaciones: Calificaciones,
                                IdsTiposCortes: IdsTiposCortes,
                                IdsTiposCalificaciones: IdsTiposCalificaciones,
                                IdPlanMateria: IdPlanMateria,
                                IdUsuario: IdUsuario
                            },

                            success: function (response) {
                                console.log(response);
                                var output = "";
                                if (response == 'Es necesario ingresar los datos requeridos para continuar' ||
                                    response == 'No se han podido registrar las calificaciones de los alumnos') {
                                    $.confirm({
                                        title: 'Registrando calificaciones de los alumnos',
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
                                    if (response == 'Las calificaciones de los alumnos han sido registradas exitosamente') {
                                        $.confirm({
                                            title: 'Registrando calificaciones de los alumnos',
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

                            error: function (error) {
                                if (response == 'Las calificaciones de los alumnos han sido registradas exitosamente') {
                                    $.confirm({
                                        title: 'Registrando calificaciones de los alumnos',
                                        content: 'Error en el proceso de registro de calificaciones. ' + error,
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
                            }
                        });
                    }
                },

                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn btn-primary',
                    action: function () {
                        $(this).fadeOut();
                    }
                }
            }
        });
    });
    
})


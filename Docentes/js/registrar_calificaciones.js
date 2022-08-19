$(document).ready(function () {

    "use strict";

    var IdPersona = $("#barra #datos-usuario").attr("IdPersona");
    var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");

    load_años_por_grupos(IdPersona, IdInstructor);

    function load_años_por_grupos(IdPersona, IdInstructor) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Action: 'Consultar_Años_Por_Grupos',
                IdPersona: IdPersona,
                IdInstructor: IdInstructor
            },

            success: function (response) {
                console.log(response);
                var output = "";
                if (response == 'Error al consultar los grupos asignados' ||
                    response == 'No se ha podido consultar los grupos asignados') {
                    output = '<div class="text-center grupos-ciclos">GRUPOS</div>'+
                                '<nav class="sidebar card py-2 mb-4">'+
                                    '<ul class="nav flex-column">'+
                                        '<li class="nav-item has-submenu">'+
                                            '<a class="ciclos nav-link">'+response+'</a>'+
                                        '</li>'+
                                    '</ul>'+
                                '</nav>';
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos").html(output);
                    /*$("ul .nav-item .ciclos.nav-link").each(function() {
                        var Año = $(this).attr('IdAño');
                        console.log(Año);
                        load_cuatrimestres_por_años(IdPersona, IdInstructor, Año);
                    });*/
                }
            },

            error: function (error) {
                $("#contenido-cuerpo #grupos").html(error);
            }
        });
    }

    setTimeout(function() {
        $("ul .nav-item .ciclos.nav-link").each(function() {
            var Año = $(this).attr('IdAño');
            console.log(Año);
            load_cuatrimestres_por_años(IdPersona, IdInstructor, Año);
        });
    }, 400);

    function load_cuatrimestres_por_años(IdPersona, IdInstructor, Año) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Action: 'Consultar_Cuatrimestres_Por_Años',
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                Año: Año
            },

            success: function (response) {
                console.log(response);
                var output = "";
                if (response == 'Error al consultar los grupos asignados' ||
                    response == 'No se ha podido consultar los periodos cargados') {
                        var output  =   '<ul class="submenu collapse" id="CuatrimestresAño-'+Año+'">'+
                                            '<li class="nav-item has-submenu">'+
                                                '<a class="nav-item has-submenu">'+response+'</a>'+
                                            '<li>'+
                                        '<ul>';
                        $("#contenido-cuerpo #grupos #Año-"+Año).append(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos #Año-"+Año).append(output);
                }
            },

            error: function (error) {
                var output  =   '<ul class="submenu collapse" id="CuatrimestresAño-'+Año+'">'+
                                    +'<li class="nav-item has-submenu">'+
                                        +'<a class="nav-item has-submenu">No tiene periodos cargados.'+error+'</a>'+
                                    +'<li>'+
                                '<ul>';
                $("#contenido-cuerpo #grupos #Año-"+Año).append(output);
            }
        });
    }

    setTimeout(function() {
        $("ul .nav-item .nav-item .cuatrimestres.nav-link").each(function() {
            var IdCuatrimestre = $(this).attr('IdCuatrimestre');
            console.log(IdCuatrimestre);
            load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre);
        });
    }, 500);

    function load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Action: 'Consultar_Grupos_Por_Cuatrimestre',
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                IdCuatrimestre: IdCuatrimestre
            },

            success: function (response) {
                console.log(response);
                var output = "";
                if (response == 'Error al consultar los grupos asignados' ||
                    response == 'No se ha podido consultar los grupos asignados') {
                        var output = '<ul class="submenu collapse" id="GruposCuatrimestre-'+IdCuatrimestre+'">'+
                                        +'<li class="nav-item has-submenu">'+
                                            +'<a class="nav-item has-submenu">'+response+'</a>'+
                                        +'<li>'+
                                    '<ul>';
                    $("#contenido-cuerpo #grupos #Cuatrimestre-"+IdCuatrimestre).append(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos #Cuatrimestre-"+IdCuatrimestre).append(output);
                }
            },

            error: function (error) {
                var output  =   '<ul class="submenu collapse" id="GruposCuatrimestre-'+IdCuatrimestre+'">'+
                                    +'<li class="nav-item has-submenu">'+
                                        +'<a class="nav-item has-submenu">Error al consultar los grupos asignados.'+error+'</a>'+
                                    +'<li>'+
                                '<ul>';
                $("#contenido-cuerpo #grupos #Cuatrimestre-"+IdCuatrimestre).append(output);
            }
        });
    }

    setTimeout(function() {
        $("ul .nav-item .nav-item .grupos.nav-link").each(function() {
            var IdGrupo = $(this).attr('IdGrupo');
            console.log(IdGrupo);
            load_materias_por_grupos(IdPersona, IdInstructor, IdGrupo);
        });
    }, 600);

    function load_materias_por_grupos(IdPersona, IdInstructor, IdGrupo) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Action: 'Consultar_Materias_Por_Grupo',
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                IdGrupo: IdGrupo
            },

            success: function (response) {
                console.log(response);
                var output = "";
                if (response == 'Error al consultar los grupos asignados' || 
                    response == 'No se ha podido consultar las materias asignadas') {
                        var output = '<ul class="submenu collapse" id="MateriasGrupo-'+$IdGrupo+'">'+
                                        +'<li class="nav-item has-submenu">'+
                                            +'<a class="nav-item has-submenu">'+response+'</a>'+
                                        +'<li>'+
                                    '<ul>';
                        $("#contenido-cuerpo #grupos #Grupo-"+IdGrupo).append(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos #Grupo-"+IdGrupo).append(output);
                    
                }
            },

            error: function (error) {
                if (error == 'Error al consultar las materias asignadas') {
                    $.confirm({
                        title: 'Consultando grupos asignados. '+error,
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
                }
            }
        });
    }

    $('body').on('click', 'ul .nav-item .nav-link', function() {
		$('body ul .nav-item .nav-link').removeClass('selected');
		$(this).addClass('selected');
	});

    $("body").on("click", "ul .nav-item .materias.nav-link", function () {
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $(this).attr("IdGrupo");
        var IdPlanMateria = $(this).attr("IdPlanMateria");
        var Materia = $(this).html();
        console.log(IdInstructor, IdGrupo, IdPlanMateria, Materia);
        $.ajax({
            url: "ajax/ajax_ver_alumnos.php",
            method: "POST",
            async: true,
            data: {
                IdInstructor: IdInstructor,
                IdGrupo: IdGrupo,
                IdPlanMateria: IdPlanMateria
            },

            success: function (response) {
                var output = "";
                if (response == 'Ingrese los datos de usuario para ver los grupos asignados' || 
                    response == 'No se ha podido consutar los alumnos registrados') {
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
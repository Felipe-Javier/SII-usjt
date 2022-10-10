$(document).ready(function () {

    "use strict";

    var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
    var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
    var IdPersona = $("#barra #datos-usuario").attr("IdPersona");
    var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");

    setTimeout(function() {
        load_años_por_grupos(IdUsuario, Docente, IdPersona, IdInstructor);
    }, 100);

    function load_años_por_grupos(IdUsuario, Docente, IdPersona, IdInstructor) {
        var Opcion = 'Traer_anios_por_grupos';
        $.ajax({
            url: "ajax/ajax_ver_grupos_asistencias.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                IdUsuario: IdUsuario, 
                Docente: Docente,
                IdPersona: IdPersona,
                IdInstructor: IdInstructor
            },

            success: function (response) {
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
                    $("#contenido-cuerpo #grupos").html(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos").html(output);
                }
            },

            error: function (error) {
                $("#contenido-cuerpo #grupos").html(error);
            }
        });
    }

    setTimeout(function() {
        load_cuatrimestres_por_años(IdPersona, IdInstructor);
        $("ul .nav-item .ciclos.nav-link").each(function() {
            var Anio = $(this).attr('Anio');
            load_cuatrimestres_por_años(IdPersona, IdInstructor, Anio);
        });
    }, 200);

    function load_cuatrimestres_por_años(IdPersona, IdInstructor, Anio) {
        var Opcion = 'Traer_cuatrimestres_por_anio';
        $.ajax({
            url: "ajax/ajax_ver_grupos_asistencias.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                Anio: Anio
            },

            success: function (response) {
                var output = "";
                if (response == 'Error al consultar los grupos asignados' ||
                    response == 'No se ha podido consultar los periodos cargados') {
                        var output  =   '<ul class="submenu collapse" id="CuatrimestresAño-'+Anio+'">'+
                                            '<li class="nav-item has-submenu">'+
                                                '<a class="nav-item has-submenu">'+response+'</a>'+
                                            '<li>'+
                                        '<ul>';
                        $("#contenido-cuerpo #grupos #Año-"+Anio).append(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos #Año-"+Anio).append(output);
                }
            },

            error: function (error) {
                var output  =   '<ul class="submenu collapse" id="CuatrimestresAño-'+Anio+'">'+
                                    +'<li class="nav-item has-submenu">'+
                                        +'<a class="nav-item has-submenu">No tiene periodos cargados.'+error+'</a>'+
                                    +'<li>'+
                                '<ul>';
                $("#contenido-cuerpo #grupos #Año-"+Anio).append(output);
            }
        });
    }

    setTimeout(function() {
        $("ul .nav-item .nav-item .cuatrimestres.nav-link").each(function() {
            var IdCuatrimestre = $(this).attr('IdCuatrimestre');
            load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre);
        });
    }, 300);

    function load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre) {
        var Opcion = 'Traer_grupos_por_cuatrimestre';
        $.ajax({
            url: "ajax/ajax_ver_grupos_asistencias.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                IdCuatrimestre: IdCuatrimestre
            },

            success: function (response) {
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
            load_materias_por_grupos(IdPersona, IdInstructor, IdGrupo);
        });
    }, 400);

    function load_materias_por_grupos(IdPersona, IdInstructor, IdGrupo) {
        var Opcion = 'Traer_materias_por_grupo';
        $.ajax({
            url: "ajax/ajax_ver_grupos_asistencias.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                IdPersona: IdPersona,
                IdInstructor: IdInstructor,
                IdGrupo: IdGrupo
            },

            success: function (response) {
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

    $("body").on("click", "ul .nav-item .meses.nav-link", function () {
        var Action = 'VerAsistencias';
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $(this).attr("IdGrupo");
        var Grupo = $(this).attr("Grupo");
        var IdPlanMateria = $(this).attr("IdPlanMateria");
        var Materia = $(this).attr("Materia");
        var IdCicloEscolar = $(this).attr("IdCicloEscolar");
        var Cuatrimestre = $(this).attr("Cuatrimestre");
        var Turno = $(this).attr("Turno");
        var Carrera = $(this).attr("Carrera");
        var AnioAsistencia = $(this).attr("AnioEscolar");
        var MesAsistencia = $(this).html();
        
        $("#contenido-cuerpo #result").html(
            '<div class="row ">'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">CUATRIMESTRE: <span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                    Cuatrimestre+'</span>'+
                '</div>'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">MES: <span class="text-nobold" id="Mes_Asistencia">'+MesAsistencia+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">Carrera: <span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span>'+
                '</div>'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">AÑO: <span class="text-nobold" id="Anio_Escolar">'+AnioAsistencia+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">Materia: <span class="text-nobold" id="Nombre_Materia" '+
                    'IdPlanMateria="'+IdPlanMateria+'">'+Materia+'</span>'+
                '</div>'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">GRUPO: <span class="text-nobold" id="Grupo_Asistencia" IdGrupoAsistencia="'+IdGrupo+'">'+Grupo+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">MODALIDAD: <span class="text-nobold" id="Grupo_Modalidad">'+Turno+'</span>'+
                '</div>'+
                '<div class="col-sm-6 mb-2 text-center">'+
                    '<span class="text-bold">TURNO: <span class="text-nobold" id="Grupo_Turno"></span>'+
                '</div>'+
            '</div>'
        );

        load_asistencias_alumnos(Action, IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, AnioAsistencia, MesAsistencia);

        /*setTimeout(function() {
            if (Materia == "null") {
                $("#contenido-cuerpo #Nombre_Materia").html("No hay una materia activa en este grupo");
            } else {
                $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria", IdPlanMateria);
                $("#contenido-cuerpo #Nombre_Materia").html(Materia);
            }

            $("#contenido-cuerpo #Mes_Asistencia").html(MesAsistencia);
            $("#contenido-cuerpo #Anio_Escolar").html(AnioAsistencia);
            $("#contenido-cuerpo #Grupo_Asistencia").html(Grupo);
            $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia", IdGrupo);
            $("#contenido-cuerpo #Carrera_Grupo").html(Carrera);
            $("#contenido-cuerpo #Grupo_Turno").html(Turno);
            $("#contenido-cuerpo #Cuatrimestre_Grupo").attr("IdCicloEscolar", IdCicloEscolar);
            $("#contenido-cuerpo #Cuatrimestre_Grupo").html(Cuatrimestre);
        }, 100);*/
    });

    $("body").on("click", "#contenido-cuerpo #result #btnRegistrarAsistencia", function() {
        var Action = 'VerAlumnos';
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
        var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
        var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
        var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
        
        $(".modalRegistrarAsistencias").fadeIn();
        load_asistencias_alumnos(Action, IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, null, null);
        load_CatDia(IdUsuario, Docente, Grupo, Materia);
    });

    $(".modalRegistrarAsistencias #closeModalRegistrarAsistencia").on("click", function() {
        $(".modalRegistrarAsistencias .input-group #Fecha_Asistencia").val("");
        $(".modalRegistrarAsistencias .input-group #Dia_Asistencia").empty();
        $(".modalRegistrarAsistencias .input-group #Dia_Asistencia").append('<option value="" selected disabled>-- seleccione --</option>');
        $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #table-registrar-asistencia tbody .NomenAlumno").each(function () {
            $(this).empty();
            $(this).append('<option value="" selected disabled>-- seleccione --</option>');
        });
        $('.modalRegistrarAsistencias #Form-RegistrarAsistencia').removeClass("was-validated");
        $(".modalRegistrarAsistencias").fadeOut();
    });

    function load_asistencias_alumnos(Action, IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, 
                                      AnioAsistencia, MesAsistencia) {
        if (Action == 'VerAsistencias') {
            var dataGrupo = {Action: Action, IdUsuario: IdUsuario, Docente: Docente, IdInstructor: IdInstructor, IdGrupo: IdGrupo,
                            Grupo: Grupo, IdPlanMateria: IdPlanMateria, Materia: Materia, AnioAsistencia: AnioAsistencia,
                            MesAsistencia: MesAsistencia};
        } else if (Action == 'VerAlumnos') {
            var dataGrupo = {Action: Action, IdUsuario: IdUsuario, Docente: Docente, IdInstructor: IdInstructor, IdGrupo: IdGrupo,
                            Grupo: Grupo, IdPlanMateria: IdPlanMateria, Materia: Materia};
        }

        $.ajax({
            url: "ajax/ajax_ver_asistencias_alumnos.php",
            method: "POST",
            async: true,
            data: dataGrupo,

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || 
                    response == 'No se han podido consutar las asistencias registradas' ||
                    response == 'No se han podido consutar los alumnos activos') {
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
                    if (Action == 'VerAsistencias') {
                        output = response;
                        $("#contenido-cuerpo #result").append(output);
                    } else if (Action == 'VerAlumnos') {
                        output = response;
                        $(".modalRegistrarAsistencias .form-body #alumnos").html(output);
                        load_CatNomenclaturaAsistencia(IdUsuario, Docente, Grupo, Materia);
                    }
                }
            },

            error: function (error) {
                $("#result").html(error);
            }
        });
    }

    function load_CatDia(IdUsuario, Docente, Grupo, Materia) {
        $.ajax({
            url: "ajax/ajax_ver_CatDia_CatNomenclaturaAsistencia.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatDia',
                IdUsuario: IdUsuario,
                Docente: Docente,
                Grupo: Grupo,
                Materia: Materia
            },

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || response == 'No se ha podido realizar la consulta' || 
                    response == 'No hay elementos en el catalogo para mostrar') {
                    output = '<option value="" selected disabled>'+response+'</option>';
                    $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #Dia_Asistencia").append(output);
                } else {
                    var array = [];
                    var info = JSON.parse(response);
                    array = info;
                    var numRows = array.length;
                    for (var i=0; i<numRows; i++) {
                        output = '<option value="'+array[i].IdElementoInternoDetalle+'">'+array[i].ElementoCatalogo+'</option>';
                        $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #Dia_Asistencia").append(output);
                    };
                }
            },

            error: function (error) {
                output = '<option value="" selected disabled>'+error+'</option>';
                $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #Dia_Asistencia").append(output);
            }
        });
    }

    function load_CatNomenclaturaAsistencia(IdUsuario, Docente, Grupo, Materia) {
        $.ajax({
            url: "ajax/ajax_ver_CatDia_CatNomenclaturaAsistencia.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatNomenclaturaAsistencia',
                IdUsuario: IdUsuario,
                Docente: Docente,
                Grupo: Grupo,
                Materia: Materia
            },

            success: function (response) {
                var output = '';
                if (response == 'Error al realizar la consulta' || response == 'No se ha podido realizar la consulta' || 
                    response == 'No hay elementos en el catalogo para mostrar') {
                    $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #table-registrar-asistencia tbody .NomenAlumno").each(function () {
                        output = '<option value="" selected disabled>'+response+'</option>';
                        $(this).append(output);
                    });
                } else {
                    var array = [];
                    var info = JSON.parse(response);
                    array = info;
                    var numRows = array.length;
                    $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #table-registrar-asistencia tbody .NomenAlumno").each(function () {
                        for (var i=0; i<numRows; i++) {
                            output = '<option value="'+array[i].IDNOMENCLATURA+'">'+array[i].NOMENCLATURA+'</option>';
                            $(this).append(output);
                            output = '';
                        }
                    });
                }
            },

            error: function (error) {
                $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #table-registrar-asistencia tbody .NomenAlumno").each(function () {
                    output = '<option value="" selected disabled>'+error+'</option>';
                    $(this).append(output);
                });
            }
        });
    }

    var formRegistrarAsistencia = $('.modalRegistrarAsistencias #Form-RegistrarAsistencia.needs-validation');
    
    var validation_RegistrarAsistencia = Array.prototype.filter.call(formRegistrarAsistencia, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                $.confirm({
                    title: 'Registrando asistencias',
                    content: '<strong>¡Atención: Ingrese los datos de registro para continuar!</strong>',
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
                    
                    var FechaAsistencia = '';
                    var IdDiaAsistencia = '';
                    var IdsRelsGruposAlumnos = new Array();
                    var IdsAlumnos = new Array();
                    var IdsAlumnosMatriculas = new Array();
                    var IdsPersonas = new Array();
                    var IdGrupo = '';
                    var IdPlanMateria = '';
                    var IdInstructor = '';
                    var IdCicloEscolar = '';
                    var IdsNomenclaturas = new Array();
                    var RowCount = '';
                    var IdUsuario = '';
                    
                    FechaAsistencia = form.querySelector("#Fecha_Asistencia").value;
                    IdDiaAsistencia = form.querySelector("#Dia_Asistencia option:checked").value;

                    form.querySelectorAll(".DatosAlumno_C1").forEach(function (element) {
                        IdsRelsGruposAlumnos.push(element.getAttribute("IdRelGruAlu"));
                        IdsAlumnos.push(element.getAttribute("IdAlumno"));
                        IdsAlumnosMatriculas.push(element.getAttribute("IdAlumnoMatricula"));
                        IdsPersonas.push(element.getAttribute("IdPersona"));
                    });

                    IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
                    IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
                    IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
                    IdCicloEscolar = $("#contenido-cuerpo #Cuatrimestre_Grupo").attr("IdCicloEscolar");

                    form.querySelectorAll(".NomenAlumno option:checked").forEach(function (element) {
                        IdsNomenclaturas.push(element.value);
                    });

                    IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");

                    RowCount = $(".modalRegistrarAsistencias #Form-RegistrarAsistencia #table-registrar-asistencia tbody tr").length;
                    
                    registrar_asistencia (FechaAsistencia, IdDiaAsistencia, IdsRelsGruposAlumnos, IdsAlumnos, IdsAlumnosMatriculas,
                        IdsPersonas, IdGrupo, IdPlanMateria, IdInstructor, IdCicloEscolar, IdsNomenclaturas, IdUsuario, RowCount);
                }
            }
        }, false);
    });

    function registrar_asistencia (FechaAsistencia, IdDiaAsistencia, IdsRelsGruposAlumnos, IdsAlumnos, IdsAlumnosMatriculas,
                                   IdsPersonas, IdGrupo, IdPlanMateria, IdInstructor, IdCicloEscolar, IdsNomenclaturas, IdUsuario, RowCount) {
        
        $.confirm({
            title: 'Consultando alumnos de este grupo',
            content: '¿Esta seguro(a) que desea realizar el registro de asistencias?',
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
                            url: "ajax/ajax_registrar_asistencias_alumnos.php",
                            method: "POST",
                            async: true,
                            data: {
                                FechaAsistencia: FechaAsistencia, 
                                IdDiaAsistencia: IdDiaAsistencia, 
                                IdsRelsGruposAlumnos: IdsRelsGruposAlumnos, 
                                IdsAlumnos: IdsAlumnos, 
                                IdsAlumnosMatriculas: IdsAlumnosMatriculas,
                                IdsPersonas: IdsPersonas, 
                                IdGrupo: IdGrupo, 
                                IdPlanMateria: IdPlanMateria, 
                                IdInstructor: IdInstructor, 
                                IdCicloEscolar: IdCicloEscolar, 
                                IdsNomenclaturas: IdsNomenclaturas, 
                                IdUsuario: IdUsuario, 
                                RowCount: RowCount
                            },

                            success: function (response) {
                                console.log(response);
                                if (response == 'Error al realizar el registro de asistencias de los alumnos' || 
                                    response == 'No se han podido registrar las asistencias de los alumnos') {
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
                                } else if (response == 'Registro de asistencias realizado exitosamente') {
                                    $.confirm({
                                        title: 'Consultando alumnos de este grupo',
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
                                                    var Action = 'VerAsistencias';
                                                    var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
                                                    var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
                                                    var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
                                                    var MesAsistencia = $("#contenido-cuerpo #Mes_Asistencia").html();
                                                    var AnioAsistencia = $("#contenido-cuerpo #Anio_Escolar").html();
                                                    var Carrera = $("#contenido-cuerpo #Carrera_Grupo").html();
                                                    var Turno = $("#contenido-cuerpo #Grupo_Turno").html();
                                                    var Cuatrimestre = $("#contenido-cuerpo #Cuatrimestre_Grupo").html();

                                                    $("#contenido-cuerpo #result").html();

                                                    $("#contenido-cuerpo #result").html(
                                                        '<div class="row ">'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">CUATRIMESTRE: <span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                                                                Cuatrimestre+'</span>'+
                                                            '</div>'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">MES: <span class="text-nobold" id="Mes_Asistencia">'+MesAsistencia+'</span>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="row">'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">Carrera: <span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span>'+
                                                            '</div>'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">AÑO: <span class="text-nobold" id="Anio_Escolar">'+AnioAsistencia+'</span>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="row">'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">Materia: <span class="text-nobold" id="Nombre_Materia" '+
                                                                'IdPlanMateria="'+IdPlanMateria+'">'+Materia+'</span>'+
                                                            '</div>'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">GRUPO: <span class="text-nobold" id="Grupo_Asistencia" IdGrupoAsistencia="'+IdGrupo+'">'+Grupo+'</span>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="row">'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">MODALIDAD: <span class="text-nobold" id="Grupo_Modalidad"></span>'+
                                                            '</div>'+
                                                            '<div class="col-sm-6 mb-2 text-center">'+
                                                                '<span class="text-bold">TURNO: <span class="text-nobold" id="Grupo_Turno">'+Turno+'</span>'+
                                                            '</div>'+
                                                        '</div>'
                                                    );

                                                    load_asistencias_alumnos(Action, IdUsuario, Docente, IdInstructor, 
                                                    IdGrupo, Grupo, IdPlanMateria, Materia, AnioAsistencia, MesAsistencia);
                                                    $(this).fadeOut();
                                                }
                                            }
                                        }
                                    });
                                }
                            },

                            error: function (error) {
                                $.confirm({
                                    title: 'Consultando alumnos de este grupo',
                                    content: error,
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
                },

                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn btn-danger',
                    action: function () {
                        $(this).fadeOut();
                    }
                }
            }
        });
    }

});
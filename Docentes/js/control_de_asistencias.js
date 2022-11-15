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
    }, 300);

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
    }, 500);

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
    }, 700);

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
        var Modalidad = $(this).attr("Modalidad");
        var AnioAsistencia = $(this).attr("AnioEscolar");
        var MesAsistencia = $(this).html();

        $("#contenido-cuerpo #result").html(
                '<div class="menu-asistencias">'+
                    '<a class="btn-custom-menu active" id="registrar-editar-asistencias">Registrar/Editar Asistencias</a>'+
                    '<a class="btn-custom-menu" id="generar-formato-asistencias">Formato de lista de asistencias</a>'+
                '</div>'+
                '<div class="row justify-content-center" id="InformacionGrupo">'+
                    '<div class="col-sm-9">'+
                        '<div class="table-responsive">'+
                            '<table class="table table-bordered" id="table-informacionGrupo">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th scope="row">CUATRIMESTRE:</th>'+
                                        '<td>'+
                                            '<span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                                                Cuatrimestre+
                                            '</span>'+
                                        '</td>'+
                                        '<th scope="row">MES:</th>'+
                                        '<td><span class="text-nobold" id="Mes_Asistencia">'+MesAsistencia+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<th scope="row">CARRERA:</th>'+
                                        '<td><span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span></td>'+
                                        '<th scope="row">AÑO:</th>'+
                                        '<td><span class="text-nobold" id="Anio_Escolar">'+AnioAsistencia+'</span></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<th scope="row">MATERIA:</th>'+
                                        '<td>'+
                                            '<span class="text-nobold" id="Nombre_Materia" IdPlanMateria="'+IdPlanMateria+'">'+
                                                Materia+
                                            '</span>'+
                                        '</td>'+
                                        '<th scope="row">GRUPO:</th>'+
                                        '<td><span class="text-nobold" id="Grupo_Asistencia" IdGrupoAsistencia="'+IdGrupo+'">'+Grupo+'</span></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<th scope="row">MODALIDAD:</th>'+
                                        '<td><span class="text-nobold" id="Grupo_Modalidad">'+Modalidad+'</span></td>'+
                                        '<th scope="row">TURNO:</th>'+
                                        '<td><span class="text-nobold" id="Grupo_Turno">'+Turno+'</span></td>'+
                                    '</tr>'+
                                '</thead>'+
                            '</table>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div id="formato-asistencias">'+
                    '<form action="" method="post" class="row justify-content-center mt-3 needs-validation" id="form-GenerarFormatoListaAsistencias" novalidate>'+
                        '<div class="col-sm-4">'+
                            '<div class="input-group">'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text text-bold text-size">Fecha Inicio</span>'+
                                '</div>'+
                                '<input type="date" name="fechaInicio" id="fechaInicio" class="form-control rounded-right text-size" value required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                            '<div class="input-group">'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text text-bold text-size">Fecha Final</span>'+
                                '</div>'+
                                '<input type="date" name="fechaTermino" id="fechaTermino" class="form-control rounded-right text-size" value required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                            '<button type="submit" class="btnMostrarLista text-size" Id="btnGenerarFormatoListaAsistencias">'+
                                '<i class="fas fa-spinner h6 mr-2"></i>Generar'+
                            '</button>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                            '<button type="submit" class="btnMostrarLista text-size" Id="btnImprimirFormatoListaAsistencias">'+
                                '<i class="fas fa-print h6 mr-2"></i>Imprimir'+
                            '</button>'+
                        '</div>'+
                    '</form>'+
                    '<div id="result-formato"></div>'+
                '</div>'
        );

        load_asistencias_alumnos(IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, AnioAsistencia, MesAsistencia)
    });

    $("body").on("click", "#btnGenerarFormatoListaAsistencias", function(event) {
        event.preventDefault();
        var fechaInicio = $('#contenido-cuerpo #result #form-GenerarFormatoListaAsistencias #fechaInicio').val();
        var fechaFinalizacion = $('#contenido-cuerpo #result #form-GenerarFormatoListaAsistencias #fechaTermino').val();
        if ((fechaInicio == '' && fechaFinalizacion == '') || (fechaInicio == '' || fechaFinalizacion == '')) {
            $('#contenido-cuerpo #result #form-GenerarFormatoListaAsistencias').addClass('was-validated');

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
        } else if (fechaInicio != '' && fechaFinalizacion != '') {
            $('#contenido-cuerpo #result #form-GenerarFormatoListaAsistencias').addClass('was-validated');
            var IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
            var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
            var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
            var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
            var CicloEscolar = $("#contenido-cuerpo #Cuatrimestre_Grupo").html();
            generar_formato_lista_asistencias(IdUsuario, IdInstructor, Docente, IdGrupo, Grupo, IdPlanMateria, Materia, 
                CicloEscolar, fechaInicio, fechaFinalizacion);
        }
    });

    $("body").on("click", "#btnImprimirFormatoListaAsistencias", function(event) {
        event.preventDefault();
        if ($("#contenido-cuerpo #result #formato-asistencias #result-formato").html() == '') {
            $.confirm({
                title: 'Imprimiendo Formato de Lista de Asistencias',
                content: '<strong>¡Atención: No se ha generado ningun Formato de Lista de Asistencias!</strong>',
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
            imprimir_formato_lista_asistencias();
        }
    });
    
    $("body").on("click", ".menu-asistencias #registrar-editar-asistencias", function() {
        $('#control-asistencias').show();
        $("#formato-asistencias").hide();
        $('#registrar-editar-asistencias').addClass('active');
        if($('#generar-formato-asistencias').hasClass('active')){
            $('#generar-formato-asistencias').removeClass('active');
        }
    });

    $("body").on("click", ".menu-asistencias #generar-formato-asistencias", function() {
        $('#control-asistencias').hide();
        $("#formato-asistencias").show();
        if($('#registrar-editar-asistencias').hasClass('active')) {
            $('#registrar-editar-asistencias').removeClass('active');
        }
        $('#generar-formato-asistencias').addClass('active');
    });

    $("body").on("click", "#contenido-cuerpo #result #btnRegistrarAsistencia", function() {
        var Form = 'Registrar_Asistencias';
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
        var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
        var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
        var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
        
        $(".modalRegistrarAsistencias").fadeIn();
        $(".modalRegistrarAsistencias .input-group #Fecha_Asistencia").val("");
        $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #Dia_Asistencia").empty();
        $(".modalRegistrarAsistencias .form-body #alumnos").html();
        if ($(".modalRegistrarAsistencias #Form-RegistrarAsistencias").hasClass("was-validated")) {
            $('.modalRegistrarAsistencias #Form-RegistrarAsistencias').removeClass("was-validated");
        }
        load_CatDia(Form, IdUsuario, Docente, Grupo, Materia);
        load_alumnos_GMD_registro_asistencias(IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia);
    });

    $(".modalRegistrarAsistencias #closeModalRegistrarAsistencias").on("click", function() {
        $(".modalRegistrarAsistencias .input-group #Fecha_Asistencia").val("");
        $(".modalRegistrarAsistencias .input-group #Dia_Asistencia").empty();
        $(".modalRegistrarAsistencias .form-body #alumnos").html();
        if ($(".modalRegistrarAsistencias #Form-RegistrarAsistencias").hasClass("was-validated")) {
            $('.modalRegistrarAsistencias #Form-RegistrarAsistencias').removeClass("was-validated");
        }
        $(".modalRegistrarAsistencias").fadeOut();
    });

    function load_alumnos_GMD_registro_asistencias (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia) {
        var dataGrupo = {IdUsuario: IdUsuario, Docente: Docente, IdInstructor: IdInstructor, IdGrupo: IdGrupo,
        Grupo: Grupo, IdPlanMateria: IdPlanMateria, Materia: Materia};
        
        $.ajax({
            url: "ajax/ajax_ver_alumnos_GMD_registro_asistencias.php",
            method: "POST",
            async: true,
            data: dataGrupo,

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || response == 'No se han podido consutar los alumnos asignados') {
                    $.confirm({
                        title: 'Consultando asistencias de alumnos',
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
                } else if (response == 'No se encontraron alumnos con los datos ingresados') {
                    $.confirm({
                        title: 'Consultando asistencias de alumnos',
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
                    output = response;
                    $(".modalRegistrarAsistencias .form-body #alumnos").html(output);
                    var Form = 'Registrar_Asistencias';
                    load_CatNomenclaturaAsistencia(Form, IdUsuario, Docente, Grupo, Materia);
                }
            },

            error: function (error) {
                output = error;
                $(".modalRegistrarAsistencias .form-body #alumnos").html(output);
            }
        });
    }

    function load_asistencias_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, AnioAsistencia, MesAsistencia) {
        var dataGrupo = {IdUsuario: IdUsuario, Docente: Docente, IdInstructor: IdInstructor, IdGrupo: IdGrupo,
                         Grupo: Grupo, IdPlanMateria: IdPlanMateria, Materia: Materia, AnioAsistencia: AnioAsistencia,
                         MesAsistencia: MesAsistencia};

        $.ajax({
            url: "ajax/ajax_ver_asistencias_alumnos.php",
            method: "POST",
            async: true,
            data: dataGrupo,

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || response == 'No se han podido consutar las asistencias registradas') {
                    $.confirm({
                        title: 'Consultando asistencias de alumnos',
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
                } else if (response == 'No se encontraron asistencias registradas con los datos ingresados') {
                    $.confirm({
                        title: 'Consultando asistencias de alumnos',
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
                    output = response;
                    $("#contenido-cuerpo #result").append(output);
                }
            },

            error: function (error) {
                output = error;
                $("#contenido-cuerpo #result").append(output);
            }
        });
    }

    function load_CatDia(Form, IdUsuario, Docente, Grupo, Materia) {
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
                    if (Form == 'Registrar_Asistencias') {
                        $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #Dia_Asistencia").append(output);
                    } else if (Form == 'Editar_Asistencias') {
                        $(".modalEditarAsistencias #Form-EditarAsistencias #Dia_Asistencia").append(output);
                    }
                } else {
                    var array = [];
                    var info = JSON.parse(response);
                    array = info;
                    var numRows = array.length;
                    output = '<option value="" selected disabled>-- seleccione --</option>';
                    if (Form == 'Registrar_Asistencias') {
                        $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #Dia_Asistencia").append(output);
                        output = '';
                        for (var i=0; i<numRows; i++) {
                            output = '<option value="'+array[i].IdElementoInternoDetalle+'">'+array[i].ElementoCatalogo+'</option>';
                            $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #Dia_Asistencia").append(output);
                            output = '';
                        };
                    } else if (Form == 'Editar_Asistencias') {
                        $(".modalEditarAsistencias #Form-EditarAsistencias #Dia_Asistencia").append(output);
                        output = '';
                        for (var i=0; i<numRows; i++) {
                            output = '<option value="'+array[i].IdElementoInternoDetalle+'">'+array[i].ElementoCatalogo+'</option>';
                            $(".modalEditarAsistencias #Form-EditarAsistencias #Dia_Asistencia").append(output);
                            output = '';
                        };
                    }
                }
            },

            error: function (error) {
                var output = "";
                output = '<option value="" selected disabled>Error al intentar realizar la consulta. '+error+'</option>';
                if (Form == 'Registrar_Asistencias') {
                    $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #Dia_Asistencia").append(output);
                } else if (Form == 'Editar_Asistencias') {
                    $(".modalEditarAsistencias #Form-EditarAsistencias #Dia_Asistencia").append(output);
                }
            }
        });
    }

    function load_CatNomenclaturaAsistencia(Form, IdUsuario, Docente, Grupo, Materia) {
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
                        output = '<option value="" selected disabled>'+response+'</option>';
                    if (Form == 'Registrar_Asistencias') {
                        $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #table-registrar-asistencias tbody .NomenAlumno").each(function () {
                            $(this).append(output);
                        });
                    } else if (Form == 'Editar_Asistencias') {
                        $(".modalEditarAsistencias #Form-EditarAsistencias #table-editar-asistencias tbody .NomenAlumno").append(output);
                    }
                } else {
                    var array = [];
                    var info = JSON.parse(response);
                    array = info;
                    var numRows = array.length;
                    if (Form == 'Registrar_Asistencias') {
                        $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #table-registrar-asistencias tbody .NomenAlumno").each(function () {
                            for (var i=0; i<numRows; i++) {
                                output = '<option value="'+array[i].IDNOMENCLATURA+'">'+array[i].NOMENCLATURA+'</option>';
                                $(this).append(output);
                                output = '';
                            }
                        });
                    } else if (Form == 'Editar_Asistencias') {
                        var IdNomenclaturaActual = $(".modalEditarAsistencias #Form-EditarAsistencias #table-editar-asistencias"+ 
                                                    " tbody .NomenAlumno").attr("IdNomenclaturaActual");
                        for (var i=0; i<numRows; i++) {
                            if (IdNomenclaturaActual == array[i].IDNOMENCLATURA) {
                                output = '<option value="'+array[i].IDNOMENCLATURA+'" selected>'+array[i].NOMENCLATURA+'</option>';
                                $(".modalEditarAsistencias #Form-EditarAsistencias #table-editar-asistencias tbody .NomenAlumno").append(output);
                                output = '';
                            } else {
                                output = '<option value="'+array[i].IDNOMENCLATURA+'">'+array[i].NOMENCLATURA+'</option>';
                                $(".modalEditarAsistencias #Form-EditarAsistencias #table-editar-asistencias tbody .NomenAlumno").append(output);
                                output = '';
                            }
                        }
                    }
                }
            },

            error: function (error) {
                var output = '';
                if (Form == 'Registrar_Asistencias') {
                    output = '<option value="" selected disabled>Error. '+error+'</option>';
                    output = '';
                    $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #table-registrar-asistencias tbody .NomenAlumno").each(function () {
                        $(this).append(output);
                        output = '';
                    });
                } else if (Form == 'Editar_Asistencias') {
                    $(".modalEditarAsistencias #Form-EditarAsistencias #table-editar-asistencias tbody .NomenAlumno").append(output);
                }
            }
        });
    }

    var formRegistrarAsistencias = $('.modalRegistrarAsistencias #Form-RegistrarAsistencias.needs-validation');
    
    var validation_RegistrarAsistencias = Array.prototype.filter.call(formRegistrarAsistencias, function(form) {
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

                    RowCount = $(".modalRegistrarAsistencias #Form-RegistrarAsistencias #table-registrar-asistencias tbody tr").length;
                    
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
                                        title: 'Registrando asistencias',
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
                                } else if (response == 'Ya existe un registro previo de las asistencias con la fecha ingresada') {
                                    $.confirm({
                                        title: 'Registrando asistencias',
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
                                } else if (response == 'Registro de asistencias realizado exitosamente') {
                                    $.confirm({
                                        title: 'Registrando asistencias',
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
                                                    var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
                                                    var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
                                                    var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
                                                    var MesAsistencia = $("#contenido-cuerpo #Mes_Asistencia").html();
                                                    var AnioAsistencia = $("#contenido-cuerpo #Anio_Escolar").html();
                                                    var Carrera = $("#contenido-cuerpo #Carrera_Grupo").html();
                                                    var Turno = $("#contenido-cuerpo #Grupo_Turno").html();
                                                    var Cuatrimestre = $("#contenido-cuerpo #Cuatrimestre_Grupo").html();
                                                    var Modalidad = $("#contenido-cuerpo #Grupo_Modalidad").html();

                                                    $("#contenido-cuerpo #result").html("");

                                                    $("#contenido-cuerpo #result").html(
                                                        '<div class="menu-asistencias">'+
                                                            '<a class="btn-custom-menu active" id="registrar-editar-asistencias">Registrar/Editar Asistencias</a>'+
                                                            '<a class="btn-custom-menu" id="generar-formato-asistencias">Formato de lista de asistencias</a>'+
                                                        '</div>'+
                                                        '<div class="row justify-content-center" id="InformacionGrupo">'+
                                                            '<div class="col-sm-9">'+
                                                                '<div class="table-responsive">'+
                                                                    '<table class="table table-bordered" id="table-informacionGrupo">'+
                                                                        '<thead>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">CUATRIMESTRE:</th>'+
                                                                                '<td>'+
                                                                                    '<span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                                                                                        Cuatrimestre+
                                                                                    '</span>'+
                                                                                '</td>'+
                                                                                '<th scope="row">MES:</th>'+
                                                                                '<td><span class="text-nobold" id="Mes_Asistencia">'+MesAsistencia+'</td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">CARRERA:</th>'+
                                                                                '<td><span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span></td>'+
                                                                                '<th scope="row">AÑO:</th>'+
                                                                                '<td><span class="text-nobold" id="Anio_Escolar">'+AnioAsistencia+'</span></td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">MATERIA:</th>'+
                                                                                '<td>'+
                                                                                    '<span class="text-nobold" id="Nombre_Materia" IdPlanMateria="'+IdPlanMateria+'">'+
                                                                                        Materia+
                                                                                    '</span>'+
                                                                                '</td>'+
                                                                                '<th scope="row">GRUPO:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Asistencia" IdGrupoAsistencia="'+IdGrupo+'">'+Grupo+'</span></td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">MODALIDAD:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Modalidad">'+Modalidad+'</span></td>'+
                                                                                '<th scope="row">TURNO:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Turno">'+Turno+'</span></td>'+
                                                                            '</tr>'+
                                                                        '</thead'+
                                                                    '</table>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div id="formato-asistencias">'+
                                                            '<form action="" method="post" class="row justify-content-center mt-3 needs-validation" id="form-GenerarFormatoListaAsistencias" novalidate>'+
                                                                '<div class="col-sm-4">'+
                                                                    '<div class="input-group">'+
                                                                        '<div class="input-group-prepend">'+
                                                                            '<span class="input-group-text text-bold text-size">Fecha Inicio</span>'+
                                                                        '</div>'+
                                                                        '<input type="date" name="fechaInicio" id="fechaInicio" class="form-control rounded-right text-size" value required>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                                '<div class="col-sm-4">'+
                                                                    '<div class="input-group">'+
                                                                        '<div class="input-group-prepend">'+
                                                                            '<span class="input-group-text text-bold text-size">Fecha Final</span>'+
                                                                        '</div>'+
                                                                        '<input type="date" name="fechaTermino" id="fechaTermino" class="form-control rounded-right text-size" value required>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                                '<div class="col-sm-2">'+
                                                                    '<button type="submit" class="btnMostrarLista text-size" Id="btnGenerarFormatoListaAsistencias">'+
                                                                        '<i class="fas fa-spinner h6 mr-2"></i>Generar'+
                                                                    '</button>'+
                                                                '</div>'+
                                                                '<div class="col-sm-2">'+
                                                                    '<button type="submit" class="btnMostrarLista text-size" Id="btnImprimirFormatoListaAsistencias">'+
                                                                        '<i class="fas fa-print h6 mr-2"></i>Imprimir'+
                                                                    '</button>'+
                                                                '</div>'+
                                                            '</form>'+
                                                            '<div id="result-formato"></div>'+
                                                        '</div>'
                                                    );

                                                    load_asistencias_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, 
                                                        IdPlanMateria, Materia, AnioAsistencia, MesAsistencia)
                                                    $(this).fadeOut();
                                                }
                                            }
                                        }
                                    });
                                }
                            },

                            error: function (error) {
                                $.confirm({
                                    title: 'Registrando asistencias',
                                    content: '<strong>Error al registrar las asistencias. '+error+'</strong>',
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

    $("body").on("click", "#contenido-cuerpo #result #btnEditarAsistencia", function() {
        var Form = 'Editar_Asistencias';
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
        var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
        var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
        var Materia = $("#contenido-cuerpo #Nombre_Materia").html();

        $(".modalEditarAsistencias").fadeIn();
        $(".modalEditarAsistencias .input-group #Fecha_Asistencia").val("");
        $(".modalEditarAsistencias #Form-EditarAsistencias #Dia_Asistencia").empty();
        $(".modalEditarAsistencias .input-group #Clave_Busqueda").val("");
        $(".modalEditarAsistencias .form-body #alumno").html("");
        if ($(".modalEditarAsistencias #Form-EditarAsistencias").hasClass("was-validated")) {
            $('.modalEditarAsistencias #Form-EditarAsistencias').removeClass("was-validated");
        }

        load_CatDia(Form, IdUsuario, Docente, Grupo, Materia);
    });

    $(".modalEditarAsistencias #closeModalEditarAsistencias").on("click", function() {
        $(".modalEditarAsistencias .input-group #Fecha_Asistencia").val("");
        $(".modalEditarAsistencias .input-group #Dia_Asistencia").empty();
        $(".modalEditarAsistencias .input-group #Clave_Busqueda").val("");
        $(".modalEditarAsistencias .form-body #alumno").html("");
        if ($(".modalEditarAsistencias #Form-EditarAsistencias").hasClass("was-validated")) {
            $('.modalEditarAsistencias #Form-EditarAsistencias').removeClass("was-validated");
        }
        $(".modalRegistrarAsistencias").fadeOut();
    });

    var formEditarAsistencias = $('.modalEditarAsistencias #Form-EditarAsistencias.needs-validation');

    var IdButton = '';
    $('.modalEditarAsistencias #Form-EditarAsistencias button[type="submit"]').on("click", function() {
        IdButton = $(this).attr('id');
    });
    
    var validation_EditarAsistencias = Array.prototype.filter.call(formEditarAsistencias, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                if (IdButton == 'btn-buscar') {
                    $.confirm({
                        title: 'Editando asistencias',
                        content: '<strong>¡Atención: Complete los datos de busqueda para continuar!</strong>',
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
                } else if (IdButton == 'btn-editar') {
                    $.confirm({
                        title: 'Editando asistencias',
                        content: '<strong>¡Atención: Complete los datos de edición para continuar!</strong>',
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
            } else {
                if (form.checkValidity() == true) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');

                    var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
                    var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
                    var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
                    var IdGrupo = $("#contenido-cuerpo #Grupo_Asistencia").attr("IdGrupoAsistencia");
                    var Grupo = $("#contenido-cuerpo #Grupo_Asistencia").html();
                    var IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
                    var Materia = $("#contenido-cuerpo #Nombre_Materia").html();
                    var FechaAsistencia = form.querySelector("#Fecha_Asistencia").value;
                    var IdCatDiaAsistencia = form.querySelector("#Dia_Asistencia option:checked").value;

                    if (IdButton == 'btn-buscar') {
                        var ClaveBusqueda = form.querySelector("#Clave_Busqueda").value;
                        load_asistencia_alumno_por_NombreMatricula (ClaveBusqueda, IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, 
                            Materia, FechaAsistencia, IdCatDiaAsistencia);
                    } else if (IdButton == 'btn-editar') {
                        var Matricula = form.querySelector(".DatosAlumno_C1").getAttribute("Matricula");
                        var IdCatNomenclaturaAsistencia = form.querySelector(".NomenAlumno option:checked").value;
                        console.log('Matricula: '+Matricula+', Grupo: '+Grupo+', IdGrupo: '+IdGrupo+', Materia: '+Materia+', IdPlanMateria: '+
                        IdPlanMateria+', Docente: '+Docente+', IdInstructor: '+IdInstructor+', FechaAsistencia: '+FechaAsistencia+
                        ', IdCatDiaAsistencia: '+IdCatDiaAsistencia+', IdCatNomenclaturaAsistencia: '+IdCatNomenclaturaAsistencia+
                        ', IdUsuario: '+IdUsuario);
                        editar_asistencia (Matricula, Grupo, IdGrupo, Materia, IdPlanMateria, Docente, IdInstructor, FechaAsistencia, 
                            IdCatDiaAsistencia, IdCatNomenclaturaAsistencia, IdUsuario);
                    }
                }
            }
        }, false);
    });

    function load_asistencia_alumno_por_NombreMatricula (ClaveBusqueda, IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, 
        Materia, FechaAsistencia, IdCatDiaAsistencia) {
        var data = {ClaveBusqueda: ClaveBusqueda, IdUsuario: IdUsuario, Docente: Docente, IdInstructor: IdInstructor, 
            IdGrupo: IdGrupo, Grupo: Grupo, IdPlanMateria: IdPlanMateria, Materia: Materia, FechaAsistencia: FechaAsistencia,
            IdCatDiaAsistencia: IdCatDiaAsistencia};
        var Form = 'Editar_Asistencias';

        $.ajax({
            url: "ajax/ajax_ver_asistencia_alumno_por_NombreMatricula.php",
            method: "POST",
            async: true,
            data: data,
    
            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || 
                    response == 'No se ha podido consutar la asistencia actual del alumno con los datos ingresados') {
                    $.confirm({
                        title: 'Consultando asistencia actual del alumno',
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
                } else if (response == 'No se encontraro registro de asistencia del alumno con los datos ingresados') {
                    $.confirm({
                        title: 'Consultando asistencias de alumnos',
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
                    if ($(".modalEditarAsistencias #Form-EditarAsistencias").hasClass("was-validated")) {
                        $('.modalEditarAsistencias #Form-EditarAsistencias').removeClass("was-validated");
                    }
                    output = response;
                    $(".modalEditarAsistencias #Form-EditarAsistencias .form-body #alumno").html(output);
                    load_CatNomenclaturaAsistencia(Form, IdUsuario, Docente, Grupo, Materia);
                }
            },
    
            error: function (error) {
                output = 'Error al realizar la consulta. '+error;
                $(".modalEditarAsistencias .form-body #alumno").html(output);
            }
        });
    }

    function editar_asistencia (Matricula, Grupo, IdGrupo, Materia, IdPlanMateria, Docente, IdInstructor, FechaAsistencia, 
        IdCatDiaAsistencia, IdCatNomenclaturaAsistencia, IdUsuario) {

        $.confirm({
            title: 'Editando asistencia',
            content: '¿Esta seguro(a) que desea realizar la edición de la asistencia de este alumno?',
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
                            url: "ajax/ajax_actualizar_asistencias_alumnos.php",
                            method: "POST",
                            async: true,
                            data: {
                                Matricula: Matricula,
                                Grupo: Grupo,
                                IdGrupo: IdGrupo,
                                Materia: Materia, 
                                IdPlanMateria: IdPlanMateria,
                                Docente: Docente, 
                                IdInstructor: IdInstructor, 
                                FechaAsistencia: FechaAsistencia, 
                                IdCatDiaAsistencia: IdCatDiaAsistencia,
                                IdCatNomenclaturaAsistencia: IdCatNomenclaturaAsistencia, 
                                IdUsuario: IdUsuario
                            },

                            success: function (response) {
                                console.log(response);
                                if (response == 'Error al realizar la edición' || response == 'No se ha podido editar la asistencia ingresada') {
                                    $.confirm({
                                        title: 'Registrando asistencias',
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
                                } else if (response == 'No hay un registro de asistencia con los datos ingresados') {
                                    $.confirm({
                                        title: 'Registrando asistencias',
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
                                } else if (response == 'La edición de asistencia del alumno con los datos ingresados se ha realizado exitosamente') {
                                    $.confirm({
                                        title: 'Editando asistencias',
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
                                                    var MesAsistencia = $("#contenido-cuerpo #Mes_Asistencia").html();
                                                    var AnioAsistencia = $("#contenido-cuerpo #Anio_Escolar").html();
                                                    var Carrera = $("#contenido-cuerpo #Carrera_Grupo").html();
                                                    var Turno = $("#contenido-cuerpo #Grupo_Turno").html();
                                                    var Cuatrimestre = $("#contenido-cuerpo #Cuatrimestre_Grupo").html();
                                                    var Modalidad = $("#contenido-cuerpo #Grupo_Modalidad").html();
                                                    var IdCicloEscolar = $("#contenido-cuerpo #Cuatrimestre_Grupo").attr("IdCicloEscolar");

                                                    $("#contenido-cuerpo #result").html("");

                                                    $("#contenido-cuerpo #result").html(
                                                        '<div class="menu-asistencias">'+
                                                            '<a class="btn-custom-menu active" id="registrar-editar-asistencias">Registrar/Editar Asistencias</a>'+
                                                            '<a class="btn-custom-menu" id="generar-formato-asistencias">Formato de lista de asistencias</a>'+
                                                        '</div>'+
                                                        '<div class="row justify-content-center" id="InformacionGrupo">'+
                                                            '<div class="col-sm-9">'+
                                                                '<div class="table-responsive">'+
                                                                    '<table class="table table-bordered" id="table-informacionGrupo">'+
                                                                        '<thead>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">CUATRIMESTRE:</th>'+
                                                                                '<td>'+
                                                                                    '<span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                                                                                        Cuatrimestre+
                                                                                    '</span>'+
                                                                                '</td>'+
                                                                                '<th scope="row">MES:</th>'+
                                                                                '<td><span class="text-nobold" id="Mes_Asistencia">'+MesAsistencia+'</td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">CARRERA:</th>'+
                                                                                '<td><span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span></td>'+
                                                                                '<th scope="row">AÑO:</th>'+
                                                                                '<td><span class="text-nobold" id="Anio_Escolar">'+AnioAsistencia+'</span></td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">MATERIA:</th>'+
                                                                                '<td>'+
                                                                                    '<span class="text-nobold" id="Nombre_Materia" IdPlanMateria="'+IdPlanMateria+'">'+
                                                                                        Materia+
                                                                                    '</span>'+
                                                                                '</td>'+
                                                                                '<th scope="row">GRUPO:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Asistencia" IdGrupoAsistencia="'+IdGrupo+'">'+Grupo+'</span></td>'+
                                                                            '</tr>'+
                                                                            '<tr>'+
                                                                                '<th scope="row">MODALIDAD:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Modalidad">'+Modalidad+'</span></td>'+
                                                                                '<th scope="row">TURNO:</th>'+
                                                                                '<td><span class="text-nobold" id="Grupo_Turno">'+Turno+'</span></td>'+
                                                                            '</tr>'+
                                                                        '</thead'+
                                                                    '</table>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div id="formato-asistencias">'+
                                                            '<form action="" method="post" class="row justify-content-center mt-3 needs-validation" id="form-GenerarFormatoListaAsistencias" novalidate>'+
                                                                '<div class="col-sm-4">'+
                                                                    '<div class="input-group">'+
                                                                        '<div class="input-group-prepend">'+
                                                                            '<span class="input-group-text text-bold text-size">Fecha Inicio</span>'+
                                                                        '</div>'+
                                                                        '<input type="date" name="fechaInicio" id="fechaInicio" class="form-control rounded-right text-size" value required>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                                '<div class="col-sm-4">'+
                                                                    '<div class="input-group">'+
                                                                        '<div class="input-group-prepend">'+
                                                                            '<span class="input-group-text text-bold text-size">Fecha Final</span>'+
                                                                        '</div>'+
                                                                        '<input type="date" name="fechaTermino" id="fechaTermino" class="form-control rounded-right text-size" value required>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                                '<div class="col-sm-2">'+
                                                                    '<button type="submit" class="btnMostrarLista text-size" Id="btnGenerarFormatoListaAsistencias">'+
                                                                        '<i class="fas fa-spinner h6 mr-2"></i>Generar'+
                                                                    '</button>'+
                                                                '</div>'+
                                                                '<div class="col-sm-2">'+
                                                                    '<button type="submit" class="btnMostrarLista text-size" Id="btnImprimirFormatoListaAsistencias">'+
                                                                        '<i class="fas fa-print h6 mr-2"></i>Imprimir'+
                                                                    '</button>'+
                                                                '</div>'+
                                                            '</form>'+
                                                            '<div id="result-formato"></div>'+
                                                        '</div>'
                                                    );

                                                    load_asistencias_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, 
                                                        IdPlanMateria, Materia, AnioAsistencia, MesAsistencia)
                                                    $(this).fadeOut();
                                                }
                                            }
                                        }
                                    });
                                }
                            },

                            error: function (error) {
                                $.confirm({
                                    title: 'Registrando asistencias',
                                    content: '<strong>Error al registrar las asistencias. '+error+'</strong>',
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

    function generar_formato_lista_asistencias (IdUsuario, IdInstructor, Docente, IdGrupo, Grupo, IdPlanMateria, Materia,
         CicloEscolar, fechaInicio, fechaFinalizacion) {
        var FI = moment(fechaInicio);
        var FF = moment(fechaFinalizacion);

        if ((FI.format('MMMM')==FF.format('MMMM')) && (FI.format('YYYY')==FF.format('YYYY'))) {
            var numDiaFechas = new Array();
            var nomDiaFechas = new Array();

            while (FI.isSameOrBefore(FF)) {
                numDiaFechas.push(FI.format('DD'));
                if (FI.format('dddd') == 'Monday') {
                    nomDiaFechas.push('LU');
                } else if (FI.format('dddd') == 'Tuesday') {
                    nomDiaFechas.push('MA');
                } else if (FI.format('dddd') == 'Wednesday') {
                    nomDiaFechas.push('MI');
                } else if (FI.format('dddd') == 'Thursday') {
                    nomDiaFechas.push('JU');
                } else if (FI.format('dddd') == 'Friday') {
                    nomDiaFechas.push('VI');
                } else if (FI.format('dddd') == 'Saturday') {
                    nomDiaFechas.push('SA');
                } else if (FI.format('dddd') == 'Sunday') {
                    nomDiaFechas.push('DO');
                }
                FI.add(1, 'days');
            }

            $.ajax({
                url: "ajax/ajax_generar_formato_asistencias.php",
                method: "POST",
                async: true,
                data: {
                    IdUsuario: IdUsuario,
                    IdInstructor: IdInstructor,
                    Docente: Docente,
                    IdGrupo: IdGrupo,
                    Grupo: Grupo,
                    IdPlanMateria: IdPlanMateria,
                    Materia: Materia,
                    CicloEscolar: CicloEscolar,
                    NumDiaFechas: numDiaFechas, 
                    NomDiaFechas: nomDiaFechas
                },

                success: function (response) {
                    var output = '';
                    if (response == 'Error al generar el formato de lista asistencias' || 
                        response == 'No se han podido consultar los alumnos registrados en la materia '+Materia+' del grupo '+Grupo) {
                        $.confirm({
                            title: 'Generando Formato de Lista de Asistencias',
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
                    } else if (response == 'No se encontraron alumnos registrados en la materia '+Materia+' del grupo '+Grupo) {
                        $.confirm({
                            title: 'Generando Formato de Lista de Asistencias',
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
                        output = response;
                        $("#contenido-cuerpo #result #formato-asistencias #result-formato").html('');
                        $("#contenido-cuerpo #result #formato-asistencias #result-formato").html(output);
                    }
                },

                error: function (error) {
                    $.confirm({
                        title: 'Generando Formato de Lista de Asistencias',
                        content: '<strong>Error al generar el formato de lista de asistencias. '+error+'</strong>',
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
        } else {
            $.confirm({
                title: 'Generando formato de lista de asistencias',
                content: '<strong>El mes y/o el año de ambas fechas no coincide. Las fechas tienen que contener '+
                         'el mismo mes y el mismo año.</strong>',
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
        }
    }

    function imprimir_formato_lista_asistencias() {
        var doc = new jsPDF(
            {
                orientation: "lanscape",
                format: "letter"
            }
        );
        
        doc.setFontStyle('normal');
        doc.setFontStyle('bold');
        doc.setFontSize(12);
        doc.text(150, 10, 'LISTA DE ASISTENCIAS');

        var img = new Image();
        img.src = 'img/logo-usjt.png';
        doc.addImage(img, 'PNG', 25, 15, 35, 25);

        doc.autoTable({
            html: '#contenido-cuerpo #result #table-informacionGrupo',
            styles: {halign: 'center', valign: 'middle', fillColor: [194, 197, 204], textColor: [0, 0, 0], lineColor: [0, 0, 0], lineWidth: 0.35, 
            fontSize: 6},
            margin: {
                top: 15,
                bottom: 5,
                left: 80,
                right: 5
            }
        });

        doc.setFontStyle('normal');
        doc.setFontStyle('bold');
        doc.setFontSize(8);
        doc.autoTable({
            html: '#contenido-cuerpo #result #table-formato-asistencias',
            styles: {halign: 'center', valign: 'middle', textColor: [0, 0, 0], lineColor: [0, 0, 0], lineWidth: 0.35, fontSize: 5.5},
            headStyles: {fillColor: [194, 197, 204]},
            alternateRowStyles: {valign: 'middle', fillColor: [255, 253, 252]},
            bodyStyles: {valign: 'middle', fillColor: [255, 253, 252]},
            margin: {
                top: 10,
                bottom: 10,
                left: 5,
                right: 5
            }
        });

        doc.save('FormatoListaAsistencia.pdf');
    }

});
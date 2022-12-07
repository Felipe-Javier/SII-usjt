$(document).ready(function () {

    "use strict";

    var IdUsuario = $(".navbar #navbarContent .dropdown #Empleado.dropdown-item-text").attr("IdUsuario");
    var Empleado = $(".navbar #navbarContent .dropdown #Empleado.dropdown-item-text").attr("NombreEmpleado");
    var Departamento = $(".navbar #navbarContent .dropdown #Departamento.dropdown-item-text").attr("Departamento");
    var Subdepartamento = $(".navbar #navbarContent .dropdown #SubDepartamento.dropdown-item-text").attr("SubDepartamento");

    setTimeout(function() {
        var Opcion = 'Traer_anios_escolares';
        load_años_por_grupos(Opcion);
    }, 100);

    function load_años_por_grupos(Opcion) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion
            },

            success: function (response) {
                var output = "";
                if (response == 'Error al consultar los grupos activos' ||
                    response == 'No se ha podido consultar los grupos activos') {
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
        var Opcion = 'Traer_cuatrimestres_por_anio';
        console.log(Opcion);
        $("ul .nav-item .ciclos.nav-link").each(function() {
            var AnioEscolar = $(this).attr('AnioEscolar');
            console.log(AnioEscolar);
            load_cuatrimestres_por_años(Opcion, AnioEscolar);
        });
    }, 200);

    function load_cuatrimestres_por_años(Opcion, AnioEscolar) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                AnioEscolar: AnioEscolar
            },

            success: function (response) {
                console.log(response);
                var output = "";
                if (response == 'Error al consultar los grupos activos' ||
                    response == 'No se han podido consultar los cuatrimestres activos en este año') {
                        var output  =   '<ul class="submenu collapse" id="CuatrimestresAnioEscolar-'+AnioEscolar+'">'+
                                            '<li class="nav-item has-submenu">'+
                                                '<a class="nav-item has-submenu">'+response+'</a>'+
                                            '<li>'+
                                        '<ul>';
                        $("#contenido-cuerpo #grupos #AnioEscolar-"+AnioEscolar).append(output);
                } else {
                    output = response;
                    $("#contenido-cuerpo #grupos #AnioEscolar-"+AnioEscolar).append(output);
                }
            },

            error: function (error) {
                var output  =   '<ul class="submenu collapse" id="CuatrimestresAnioEscolar-'+AnioEscolar+'">'+
                                    +'<li class="nav-item has-submenu">'+
                                        +'<a class="nav-item has-submenu">No tiene periodos cargados.'+error+'</a>'+
                                    +'<li>'+
                                '<ul>';
                $("#contenido-cuerpo #grupos #AnioEscolar-"+AnioEscolar).append(output);
            }
        });
    }

    setTimeout(function() {
        var Opcion = 'Traer_docentes_por_cuatrimestre';
        $("ul .nav-item .nav-item .docentes.nav-link").each(function() {
            var IdCuatrimestre = $(this).attr('IdCuatrimestre');
            var Cuatrimestre = $(this).attr('Cuatrimestre');
            load_docentes_por_cuatrimestre(Opcion, IdCuatrimestre, Cuatrimestre);
        });
    }, 300);

    function load_docentes_por_cuatrimestre(Opcion, IdCuatrimestre, Cuatrimestre) {
        $.ajax({
            url: "ajax/ajax_ver_grupos_calificaciones.php",
            method: "POST",
            async: true,
            data: {
                Opcion: Opcion,
                IdCuatrimestre: IdCuatrimestre,
                Cuatrimestre: Cuatrimestre,
                IdUsuario: IdUsuario,
                Empleado: Empleado,
                Departamento: Departamento,
                Subdepartamento: Subdepartamento
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

    /*setTimeout(function() {
        $("ul .nav-item .nav-item .cuatrimestres.nav-link").each(function() {
            var IdCuatrimestre = $(this).attr('IdCuatrimestre');
            load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre);
        });
    }, 300);

    function load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre) {
        var Opcion = 'Traer_grupos_por_cuatrimestre';
        $.ajax({
            url: "ajax/ajax_ver_grupos_calificaciones.php",
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
            url: "ajax/ajax_ver_grupos_calificaciones.php",
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
    }*/

    /*$('body').on('click', 'ul .nav-item .nav-link', function() {
		$('body ul .nav-item .nav-link').removeClass('selected');
		$(this).addClass('selected');
	});

    $("body").on("click", "ul .nav-item .materias.nav-link", function () {
        var IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        var Docente = $("#barra #datos-usuario").attr("NombreEmpleado");
        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $(this).attr("IdGrupo");
        var Grupo = $(this).attr("Grupo");
        var IdPlanMateria = $(this).attr("IdPlanMateria");
        var Materia = $(this).html();
        var IdCicloEscolar = $(this).attr("IdCicloEscolar");
        var Cuatrimestre = $(this).attr("Cuatrimestre");
        var Turno = $(this).attr("Turno");
        var Carrera = $(this).attr("Carrera");
        var Modalidad = $(this).attr("Modalidad");
        var FIE_P1 = $(this).attr("FIE_P1");
        var FTE_P1 = $(this).attr("FTE_P1");
        var FIE_P2 = $(this).attr("FIE_P2");
        var FTE_P2 = $(this).attr("FTE_P2");
        var FIE_F = $(this).attr("FIE_F");
        var FTE_F = $(this).attr("FTE_F");

        $("#contenido-cuerpo #result").html(
            '<div class="row justify-content-center mb-3" id="InformacionGrupo">'+
                '<div class="col-sm-9">'+
                    '<div class="table-responsive">'+
                        '<table class="table table-bordered" id="table-informacionGrupo" FIE_P1="'+FIE_P1+'"'+
                        ' FTE_P1="'+FTE_P1+'" FIE_P2="'+FIE_P2+'" FTE_P2="'+FTE_P2+'" FIE_F="'+FIE_F+'" FTE_F="'+FTE_F+'">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th scope="row">CUATRIMESTRE:</th>'+
                                    '<td>'+
                                        '<span class="text-nobold" id="Cuatrimestre_Grupo" IdCicloEscolar="'+IdCicloEscolar+'">'+
                                            Cuatrimestre+
                                        '</span>'+
                                    '</td>'+
                                    '<th scope="row">CARRERA:</th>'+
                                    '<td><span class="text-nobold" id="Carrera_Grupo">'+Carrera+'</span></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th scope="row">MATERIA:</th>'+
                                    '<td>'+
                                        '<span class="text-nobold" id="Nombre_Materia" IdPlanMateria="'+IdPlanMateria+'">'+
                                            Materia+
                                        '</span>'+
                                    '</td>'+
                                    '<th scope="row">GRUPO:</th>'+
                                    '<td><span class="text-nobold" id="Nombre_Grupo" IdGrupo="'+IdGrupo+'">'+Grupo+'</span></td>'+
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
            '<div class="row" id="control-calificaciones"></div>'
        );

        ver_calificaciones_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, Cuatrimestre,
        FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F);
    });

    $("body").on("click", "#contenido-cuerpo #result #btn-reg-cal", function (event) {
        event.preventDefault();

        var Matriculas = new Array();
        var NombresAlumnos = new Array();
        var IdsRelsGruposAlumnos = new Array();
        var Calificaciones = new Array();
        var IdsTiposCortes = new Array();
        var IdsTiposCalificaciones = new Array();
        var IdGrupo = "";
        var Grupo = "";
        var IdPlanMateria = "";
        var Materia = "";
        var Cuatrimestre = "";
        var IdUsuario = "";
        var FIE_P1 = "";
        var FTE_P1 = "";
        var FIE_P2 = "";
        var FTE_P2 = "";
        var FIE_F = "";
        var FTE_F = "";
        
        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find(".th-td-nom .nom").attr("NombreAlumno") != "" && $(this).find(".th-td-p1 .input-cal").val() != "" 
                && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false && $(this).find(".th-td-p1 .tipo-cal").val() != "" &&
                $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                    NombresAlumnos.push($(this).find(".th-td-nom .nom").attr("NombreAlumno"));
            } else {
                if($(this).find(".th-td-nom .nom").attr("NombreAlumno") != "" && $(this).find(".th-td-p2 .input-cal").val() != "" 
                    && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false && $(this).find(".th-td-p2 .tipo-cal").val() != "" &&
                    $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                        NombresAlumnos.push($(this).find(".th-td-nom .nom").attr("NombreAlumno"));
                } else {
                    if($(this).find(".th-td-nom .nom").attr("NombreAlumno") != "" && $(this).find(".th-td-p3 .input-cal").val() != "" 
                        && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false && $(this).find(".th-td-p3 .tipo-cal").val() != "" &&
                        $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                            NombresAlumnos.push($(this).find(".th-td-nom .nom").attr("NombreAlumno"));
                    }
                }
            }
        });

        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find(".th-td-mat .mat").attr("matricula") != "" && $(this).find(".th-td-p1 .input-cal").val() != "" 
                && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false && $(this).find(".th-td-p1 .tipo-cal").val() != "" &&
                $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                Matriculas.push($(this).find(".th-td-mat .mat").attr("matricula"));
            } else {
                if($(this).find(".th-td-mat .mat").attr("matricula") != "" && $(this).find(".th-td-p2 .input-cal").val() != "" 
                    && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false && $(this).find(".th-td-p2 .tipo-cal").val() != "" &&
                    $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                    Matriculas.push($(this).find(".th-td-mat .mat").attr("matricula"));
                } else {
                    if($(this).find(".th-td-mat .mat").attr("matricula") != "" && $(this).find(".th-td-p3 .input-cal").val() != "" 
                        && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false && $(this).find(".th-td-p3 .tipo-cal").val() != "" &&
                        $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                        Matriculas.push($(this).find(".th-td-mat .mat").attr("matricula"));
                    }
                }
            }
        });

        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte") == "2842" 
                && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false && $(this).find(".th-td-p1 .tipo-cal").val() != "" &&
                $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                Calificaciones.push($(this).find(".th-td-p1 .input-cal").val());
                IdsRelsGruposAlumnos.push($(this).find(".th-td-p1 .input-cal").attr("IdRelGrupoAlumno"));
                IdsTiposCortes.push($(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte"));
            } else {
                if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte") == "2843" 
                    && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false && $(this).find(".th-td-p1 .tipo-cal").val() != "" &&
                    $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                    Calificaciones.push($(this).find(".th-td-p1 .input-cal").val());
                    IdsRelsGruposAlumnos.push($(this).find(".th-td-p1 .input-cal").attr("IdRelGrupoAlumno"));
                    IdsTiposCortes.push($(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte"));
                } else {
                    if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte") == "2844"
                        && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false && $(this).find(".th-td-p1 .tipo-cal").val() != "" &&
                        $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                        Calificaciones.push($(this).find(".th-td-p1 .input-cal").val());
                        IdsRelsGruposAlumnos.push($(this).find(".th-td-p1 .input-cal").attr("IdRelGrupoAlumno"));
                        IdsTiposCortes.push($(this).find(".th-td-p1 .input-cal").attr("IdTipoCorte"));
                    }
                }
            }

            if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte") == "2842" 
                && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false && $(this).find(".th-td-p2 .tipo-cal").val() != "" &&
                $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                Calificaciones.push($(this).find(".th-td-p2 .input-cal").val());
                IdsRelsGruposAlumnos.push($(this).find(".th-td-p2 .input-cal").attr("IdRelGrupoAlumno"));
                IdsTiposCortes.push($(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte"));
            } else {
                if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte") == "2843" 
                    && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false && $(this).find(".th-td-p2 .tipo-cal").val() != "" &&
                    $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                    Calificaciones.push($(this).find(".th-td-p2 .input-cal").val());
                    IdsRelsGruposAlumnos.push($(this).find(".th-td-p2 .input-cal").attr("IdRelGrupoAlumno"));
                    IdsTiposCortes.push($(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte"));
                } else {
                    if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte") == "2844"
                        && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false && $(this).find(".th-td-p2 .tipo-cal").val() != "" &&
                        $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                        Calificaciones.push($(this).find(".th-td-p2 .input-cal").val());
                        IdsRelsGruposAlumnos.push($(this).find(".th-td-p2 .input-cal").attr("IdRelGrupoAlumno"));
                        IdsTiposCortes.push($(this).find(".th-td-p2 .input-cal").attr("IdTipoCorte"));
                    }
                }
            }

            if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte") == "2842" 
                && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false && $(this).find(".th-td-p3 .tipo-cal").val() != "" &&
                $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                Calificaciones.push($(this).find(".th-td-p3 .input-cal").val());
                IdsRelsGruposAlumnos.push($(this).find(".th-td-p3 .input-cal").attr("IdRelGrupoAlumno"));
                IdsTiposCortes.push($(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte"));
            } else {
                if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte") == "2843" 
                    && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false && $(this).find(".th-td-p3 .tipo-cal").val() != "" &&
                    $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                    Calificaciones.push($(this).find(".th-td-p3 .input-cal").val());
                    IdsRelsGruposAlumnos.push($(this).find(".th-td-p3 .input-cal").attr("IdRelGrupoAlumno"));
                    IdsTiposCortes.push($(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte"));
                } else {
                    if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte") == "2844"
                        && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false && $(this).find(".th-td-p3 .tipo-cal").val() != "" &&
                        $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                        Calificaciones.push($(this).find(".th-td-p3 .input-cal").val());
                        IdsRelsGruposAlumnos.push($(this).find(".th-td-p3 .input-cal").attr("IdRelGrupoAlumno"));
                        IdsTiposCortes.push($(this).find(".th-td-p3 .input-cal").attr("IdTipoCorte"));
                    }
                }
            }
        });

        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false &&
                $(this).find(".th-td-p1 .tipo-cal").val() != "" && $(this).find(".th-td-p1 .tipo-cal").attr("IdTipoCorte") == "2842" && 
                $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                IdsTiposCalificaciones.push($(this).find(".th-td-p1 .tipo-cal").val());
            } else {
                if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false &&
                    $(this).find(".th-td-p1 .tipo-cal").val() != "" && $(this).find(".th-td-p1 .tipo-cal").attr("IdTipoCorte") == "2843" && 
                    $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                    IdsTiposCalificaciones.push($(this).find(".th-td-p1 .tipo-cal").val());
                } else {
                    if ($(this).find(".th-td-p1 .input-cal").val() != "" && $(this).find('.th-td-p1 .input-cal').prop('disabled')==false &&
                        $(this).find(".th-td-p1 .tipo-cal").val() != "" && $(this).find(".th-td-p1 .tipo-cal").attr("IdTipoCorte") == "2844" && 
                        $(this).find('.th-td-p1 .tipo-cal').prop('disabled')==false) {
                        IdsTiposCalificaciones.push($(this).find(".th-td-p1 .tipo-cal").val());
                    }
                }
            }

            if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false &&
                $(this).find(".th-td-p2 .tipo-cal").val() != "" && $(this).find(".th-td-p2 .tipo-cal").attr("IdTipoCorte") == "2842" && 
                $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                IdsTiposCalificaciones.push($(this).find(".th-td-p2 .tipo-cal").val());
            } else {
                if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false &&
                    $(this).find(".th-td-p2 .tipo-cal").val() != "" && $(this).find(".th-td-p2 .tipo-cal").attr("IdTipoCorte") == "2843" && 
                    $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                    IdsTiposCalificaciones.push($(this).find(".th-td-p2 .tipo-cal").val());
                } else {
                    if ($(this).find(".th-td-p2 .input-cal").val() != "" && $(this).find('.th-td-p2 .input-cal').prop('disabled')==false &&
                        $(this).find(".th-td-p2 .tipo-cal").val() != "" && $(this).find(".th-td-p2 .tipo-cal").attr("IdTipoCorte") == "2844" && 
                        $(this).find('.th-td-p2 .tipo-cal').prop('disabled')==false) {
                        IdsTiposCalificaciones.push($(this).find(".th-td-p2 .tipo-cal").val());
                    }
                }
            }

            if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false &&
                $(this).find(".th-td-p3 .tipo-cal").val() != "" && $(this).find(".th-td-p3 .tipo-cal").attr("IdTipoCorte") == "2842" && 
                $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                IdsTiposCalificaciones.push($(this).find(".th-td-p3 .tipo-cal").val());
            } else {
                if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false &&
                    $(this).find(".th-td-p3 .tipo-cal").val() != "" && $(this).find(".th-td-p3 .tipo-cal").attr("IdTipoCorte") == "2843" && 
                    $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                    IdsTiposCalificaciones.push($(this).find(".th-td-p3 .tipo-cal").val());
                } else {
                    if ($(this).find(".th-td-p3 .input-cal").val() != "" && $(this).find('.th-td-p3 .input-cal').prop('disabled')==false &&
                        $(this).find(".th-td-p3 .tipo-cal").val() != "" && $(this).find(".th-td-p3 .tipo-cal").attr("IdTipoCorte") == "2844" && 
                        $(this).find('.th-td-p3 .tipo-cal').prop('disabled')==false) {
                        IdsTiposCalificaciones.push($(this).find(".th-td-p3 .tipo-cal").val());
                    }
                }
            }
        });
        
        if (Matriculas.length > 0 && IdsRelsGruposAlumnos.length > 0 && Calificaciones.length > 0
            && IdsTiposCortes.length && IdsTiposCalificaciones.length > 0) {
            IdGrupo = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo #Nombre_Grupo").attr('IdGrupo');
            Grupo = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo #Nombre_Grupo").html();
            IdPlanMateria = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo #Nombre_Materia").attr("IdPlanMateria");
            Materia = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo #Nombre_Materia").html();
            Cuatrimestre = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo #Cuatrimestre_Grupo").html();
            IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
            FIE_P1 = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FIE_P1');
            FTE_P1 = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FTE_P1');
            FIE_P2 = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FIE_P2');
            FTE_P2 = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FTE_P2');
            FIE_F = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FIE_F');
            FTE_F = $("#contenido-cuerpo #InformacionGrupo #table-informacionGrupo").attr('FTE_F');
        }

        registrar_calificaciones_alumnos (Matriculas, NombresAlumnos, IdsRelsGruposAlumnos, Calificaciones, IdsTiposCortes,
        IdsTiposCalificaciones, IdGrupo, Grupo, IdPlanMateria, Materia, Cuatrimestre, IdUsuario, FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F);
    });

    function ver_calificaciones_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, Materia, Cuatrimestre, 
                                        FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F) {
        $.ajax({
            url: "ajax/ajax_ver_calificaciones_alumnos.php",
            method: "POST",
            async: true,
            data: {
                IdUsuario: IdUsuario,
                Docente: Docente,
                IdInstructor: IdInstructor,
                IdGrupo: IdGrupo,
                Grupo: Grupo,
                IdPlanMateria: IdPlanMateria,
                Materia: Materia,
                Cuatrimestre: Cuatrimestre
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
                    $("#contenido-cuerpo #result #control-calificaciones").html(output);
                    load_CatTipoCorte(IdUsuario, Docente, Grupo, Materia);
                    load_CatTipoCalificacion(IdUsuario, Docente, Grupo, Materia);
                    deshabilitar_habilitar_por_fechas(FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F);
                }
            },

            error: function (error) {
                $("#result").html(error);
            }
        });
    }

    function load_CatTipoCorte(IdUsuario, Docente, Grupo, Materia) {
        $.ajax({
            url: "ajax/ajax_ver_CatTipoCorte_CatTipoCalificacion.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatTipoCorte',
                IdUsuario: IdUsuario,
                Docente: Docente,
                Grupo: Grupo,
                Materia: Materia
            },

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || response == 'No se ha podido realizar la consulta') {
                    $.confirm({
                        title: 'Consultando los tipos de corte',
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
                    if (response == 'No hay tipos de corte para mostrar') {
                        $.confirm({
                            title: 'Consultando los tipos de corte',
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
                        var array = [];
                        var info = JSON.parse(response);
                        array = info;
                        var numRows = array.length;
                        $("body #contenido-cuerpo #table-subir-cal tbody").each(function() {
                            for (var i=0; i<numRows; i++) {
                                output = array[i].IdElementoInternoDetalle;
                                if (output == 2842) {
                                    $(this).find(".th-td-p1").attr('IdTipocorte',output);
                                    $(this).find(".th-td-p1 .input-cal").attr('IdTipocorte',output);
                                    $(this).find(".th-td-p1 .tipo-cal").attr('IdTipocorte',output);
                                } else {
                                    if (output == 2843) {
                                        $(this).find(".th-td-p2").attr('IdTipocorte',output);
                                        $(this).find(".th-td-p2 .input-cal").attr('IdTipocorte',output);
                                        $(this).find(".th-td-p2 .tipo-cal").attr('IdTipocorte',output);
                                    } else {
                                        if (output == 2844) {
                                            $(this).find(".th-td-p3").attr('IdTipocorte',output);
                                            $(this).find(".th-td-p3 .input-cal").attr('IdTipocorte',output);
                                            $(this).find(".th-td-p3 .tipo-cal").attr('IdTipocorte',output);
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            },

            error: function (error) {
                $.confirm({
                    title: 'Consultando los tipos de corte',
                    content: 'Error al realizar la consulta. '+error,
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
        });
    }

    function load_CatTipoCalificacion(IdUsuario, Docente, Grupo, Materia) {
        $.ajax({
            url: "ajax/ajax_ver_CatTipoCorte_CatTipoCalificacion.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatTipoCalificacion',
                IdUsuario: IdUsuario,
                Docente: Docente,
                Grupo: Grupo,
                Materia: Materia
            },

            success: function (response) {
                var output = "";
                if (response == 'Error al realizar la consulta' || response == 'No se ha podido realizar la consulta') {
                    $.confirm({
                        title: 'Consultando los tipos de calificacion',
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
                    if (response == 'No hay tipos de corte para mostrar') {
                        $.confirm({
                            title: 'Consultando los tipos de calificacion',
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
                        var array = [];
                        var info = JSON.parse(response);
                        array = info;
                        var numRows = array.length;
                        $("body #contenido-cuerpo #table-subir-cal .tipo-cal").each(function() {
                            var TipoCal = $(this).attr('TipoCal');
                            for (var i=0; i<numRows; i++) {
                                if (TipoCal == array[i].ElementoCatalogo) {
                                    output = '<option value="'+array[i].IdElementoInternoDetalle+'" selected>'+array[i].ElementoCatalogo+'</option>';
                                } else {
                                    output = '<option value="'+array[i].IdElementoInternoDetalle+'">'+array[i].ElementoCatalogo+'</option>';
                                }
                                $(this).append(output);
                            }
                        });
                    }   
                }
            },

            error: function (error) {
                $.confirm({
                    title: 'Consultando los tipos de calificacion',
                    content: 'Error al realizar la consulta. '+error,
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
        });
    }

    function deshabilitar_habilitar_por_fechas(FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F) {
        $("body #contenido-cuerpo #table-subir-cal tbody tr").each(function() {
            //let DateTime = new Date('2020-04-26 17:35:20.000');
            let DateTime = new Date();
            let mxDateTime = DateTime.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFIE_P1 = new Date(FIE_P1);
            let mxDateTimeFIE_P1 = DateTimeFIE_P1.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFTE_P1 = new Date(FTE_P1);
            let mxDateTimeFTE_P1 = DateTimeFTE_P1.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFIE_P2 = new Date(FIE_P2);
            let mxDateTimeFIE_P2 = DateTimeFIE_P2.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFTE_P2 = new Date(FTE_P2);
            let mxDateTimeFTE_P2 = DateTimeFTE_P2.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFIE_F = new Date(FIE_F);
            let mxDateTimeFIE_F = DateTimeFIE_F.toLocaleString('es-MX', { timeZone: "America/Monterrey" });

            let DateTimeFTE_F = new Date(FTE_F);
            let mxDateTimeFTE_F = DateTimeFTE_F.toLocaleString('es-MX', { timeZone: "America/Monterrey" });
            
            if (mxDateTime < mxDateTimeFIE_P1 || mxDateTime > mxDateTimeFTE_P1) {
                $(this).find(".th-td-p1 .input-cal").attr('disabled', true);
                $(this).find(".th-td-p1 .tipo-cal").attr('disabled', true);
            }

            if (mxDateTime < mxDateTimeFIE_P2 || mxDateTime > mxDateTimeFTE_P2) {
                $(this).find(".th-td-p2 .input-cal").attr('disabled', true);
                $(this).find(".th-td-p2 .tipo-cal").attr('disabled', true);
            }

            if (mxDateTime < mxDateTimeFIE_F || mxDateTime > mxDateTimeFTE_F) {
                $(this).find(".th-td-p3 .input-cal").attr('disabled', true);
                $(this).find(".th-td-p3 .tipo-cal").attr('disabled', true);
            }
        });
    }

    function registrar_calificaciones_alumnos (Matriculas, NombresAlumnos, IdsRelsGruposAlumnos, Calificaciones, IdsTiposCortes,
                                               IdsTiposCalificaciones, IdGrupo, Grupo, IdPlanMateria, Materia, Cuatrimestre, IdUsuario,
                                               FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F) {
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
                                NombresAlumnos: NombresAlumnos,
                                IdsRelsGruposAlumnos: IdsRelsGruposAlumnos,
                                Calificaciones: Calificaciones,
                                IdsTiposCortes: IdsTiposCortes,
                                IdsTiposCalificaciones: IdsTiposCalificaciones,
                                Docente: Docente,
                                Grupo: Grupo,
                                IdPlanMateria: IdPlanMateria,
                                Materia: Materia,
                                Cuatrimestre: Cuatrimestre,
                                IdUsuario: IdUsuario
                            },

                            success: function (response) {
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
                                                        $("#contenido-cuerpo #result #control-calificaciones").html("");
                                                        ver_calificaciones_alumnos (IdUsuario, Docente, IdInstructor, IdGrupo, Grupo, IdPlanMateria, 
                                                            Materia, Cuatrimestre, FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F);
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
    }*/
    
})


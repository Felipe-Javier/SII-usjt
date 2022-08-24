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
            load_cuatrimestres_por_años(IdPersona, IdInstructor, Año);
        });
    }, 200);

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
            load_grupos_por_cuatrimestre(IdPersona, IdInstructor, IdCuatrimestre);
        });
    }, 300);

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
        var FIE_P1 = $(this).attr("FIE_P1");
        var FTE_P1 = $(this).attr("FTE_P1");
        var FIE_P2 = $(this).attr("FIE_P2");
        var FTE_P2 = $(this).attr("FTE_P2");
        var FIE_F = $(this).attr("FIE_F");
        var FTE_F = $(this).attr("FTE_F");
        console.log("FIE_P1: "+FIE_P1);
        console.log("FTE_P1: "+FTE_P1);
        console.log("FIE_P2: "+FIE_P2);
        console.log("FTE_P2: "+FTE_P2);
        console.log("FIE_F: "+FIE_F);
        console.log("FTE_F: "+FTE_F);
        
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
                    load_CatTipoCorte();
                    load_CatTipoCalificacion();
                    deshabilitar_habilitar_por_fechas(FIE_P1, FTE_P1, FIE_P2, FTE_P2, FIE_F, FTE_F);
                }
            },

            error: function (error) {
                $("#result").html(error);
            }
        });
    });

    function load_CatTipoCorte() {
        $.ajax({
            url: "ajax/ajax_ver_CatTipoCorte_CatTipoCalificacion.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatTipoCorte'
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

    function load_CatTipoCalificacion() {
        $.ajax({
            url: "ajax/ajax_ver_CatTipoCorte_CatTipoCalificacion.php",
            method: "POST",
            async: true,
            data: {
                Action: 'VerCatTipoCalificacion'
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

    /*$("body #contenido-cuerpo #table-subir-cal tbody").each(function() {
        let DateTime = new Date();
        let mxDateTime = DateTime.toLocaleString('es-MX', { timeZone: "America/Monterrey" });
        console.log(mxDateTime);
        if (mxDateTime > '23/8/2022, 10:18:01') {
            $(this).find(".th-td-p2 .input-cal").attr('disabled', true);
            $(this).find(".th-td-p2 .tipo-cal").attr('disabled', true);
            $(this).find(".th-td-p3 .input-cal").attr('disabled', true);
            $(this).find(".th-td-p3 .tipo-cal").attr('disabled', true);
        }
    });*/

    /*setTimeout(function() {
        console.log('Hola');
        $("body #contenido-cuerpo #table-subir-cal tbody").each(function() {
            let DateTime = new Date();
            let mxDateTime = DateTime.toLocaleString('es-MX', { timeZone: "America/Monterrey" });
            console.log(mxDateTime);
            if (mxDateTime > '23/8/2022, 10:18:01') {
                $(this)+$(" .th-td-p1 .input-cal").attr('disabled', 'true');
                $(this)+$(" .th-td-p1 .tipo-cal").attr('disabled', 'true');
            }
        });
    }, 250);

    function loadDateTime() {
        let DateTime = new Date();
        let mxDateTime = DateTime.toLocaleString('es-MX', { timeZone: "America/Monterrey" });
        return mxDateTime;
    }*/

    $("body").on("click", "#contenido-cuerpo #result #btn-reg-cal", function (event) {
        event.preventDefault();

        var Matriculas = new Array();
        var IdsRelsGruposAlumnos = new Array();
        var Calificaciones = new Array();
        var IdsTiposCortes = new Array();
        var IdsTiposCalificaciones = new Array();
        var IdPlanMateria = "";
        var IdUsuario = "";
        
        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find(".th-td-mat .mat").attr("matricula") != "" && $(this).find("td .input-cal").val() != "" 
                && $(this).find('td .input-cal[disabled=false]') && $(this).find("td .tipo-cal").val() != "" &&
                $(this).find('td .tipo-cal[disabled=false]')) {
                Matriculas.push($(this).find(".th-td-mat .mat").attr("matricula"));
            }
        });

        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find("td .input-cal").val() != "" && $(this).find("td .input-cal").attr("IdTipoCorte") == "2842" 
                && $(this).find('td .input-cal[disabled=false]') && $(this).find("td .tipo-cal").val() != "" &&
                $(this).find('td .tipo-cal[disabled=false]')) {
                Calificaciones.push($(this).find("td .input-cal").val());
                IdsRelsGruposAlumnos.push($(this).find("td .input-cal").attr("IdRelGrupoAlumno"));
                IdsTiposCortes.push($(this).find("td .input-cal").attr("IdTipoCorte"));
            } else {
                if ($(this).find("td .input-cal").val() != "" && $(this).find("td .input-cal").attr("IdTipoCorte") == "2843" 
                    && $(this).find('td .input-cal[disabled=false]') && $(this).find("td .tipo-cal").val() != "" &&
                    $(this).find('td .tipo-cal[disabled=false]')) {
                    Calificaciones.push($(this).find("td .input-cal").val());
                    IdsRelsGruposAlumnos.push($(this).find("td .input-cal").attr("IdRelGrupoAlumno"));
                    IdsTiposCortes.push($(this).find("td .input-cal").attr("IdTipoCorte"));
                } else {
                    if ($(this).find("td .input-cal").val() != "" && $(this).find("td .input-cal").attr("IdTipoCorte") == "2844"
                        && $(this).find('td .input-cal[disabled=false]') && $(this).find("td .tipo-cal").val() != "" &&
                        $(this).find('td .tipo-cal[disabled=false]')) {
                        Calificaciones.push($(this).find("td .input-cal").val());
                        IdsRelsGruposAlumnos.push($(this).find("td .input-cal").attr("IdRelGrupoAlumno"));
                        IdsTiposCortes.push($(this).find("td .input-cal").attr("IdTipoCorte"));
                    }
                }
            }
        });

        $("#contenido-cuerpo #table-subir-cal tbody tr").each(function () {
            if ($(this).find("td .input-cal").val() != "" && $(this).find('td .input-cal[disabled=false]') &&
                $(this).find("td .tipo-cal").val() != "" && $(this).find("td .tipo-cal").attr("IdTipoCorte") == "2842" && 
                $(this).find('td .tipo-cal[disabled=false]')) {
                IdsTiposCalificaciones.push($(this).find("td .tipo-cal").val());
            } else {
                if ($(this).find("td .input-cal").val() != "" && $(this).find('td .input-cal[disabled=false]') &&
                    $(this).find("td .tipo-cal").val() != "" && $(this).find("td .tipo-cal").attr("IdTipoCorte") == "2843" && 
                    $(this).find('td .tipo-cal[disabled=false]')) {
                    IdsTiposCalificaciones.push($(this).find("td .tipo-cal").val());
                } else {
                    if ($(this).find("td .input-cal").val() != "" && $(this).find('td .input-cal[disabled=false]') &&
                        $(this).find("td .tipo-cal").val() != "" && $(this).find("td .tipo-cal").attr("IdTipoCorte") == "2844" && 
                        $(this).find('td .tipo-cal[disabled=false]')) {
                        IdsTiposCalificaciones.push($(this).find("td .tipo-cal").val());
                    }
                }
            }
        });
        
        if (Matriculas.length > 0 && IdsRelsGruposAlumnos.length > 0 && Calificaciones.length > 0
            && IdsTiposCortes.length && IdsTiposCalificaciones.length > 0) {
            IdPlanMateria = $("#contenido-cuerpo #Nombre_Materia").attr("IdPlanMateria");
            IdUsuario = $("#barra #datos-usuario").attr("IdUsuario");
        }

        /*console.log(Matriculas);
        console.log(IdsRelsGruposAlumnos);
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


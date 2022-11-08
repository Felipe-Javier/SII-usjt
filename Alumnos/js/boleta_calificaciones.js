$(document).ready(function() {

    "use strict";

    var IdUsuario = $(".navbar #navbarContent .dropdown .nav-link").attr("IdUsuario");
    var Matricula = $("#Matricula").attr("mat");

    load_periodos(IdUsuario, Matricula);

    function load_periodos(IdUsuario, Matricula) {
        $.ajax({
            url: "ajax/ajax_ver_periodos_disponibles.php",
            method: "POST",
            async: true,
            data: {IdUsuario: IdUsuario, Matricula: Matricula},

            success: function(response) {
                var output = "";
                if (response=='No se encontraron periodos disponibles') {
                    output = '<div class="col-12">'+
                                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                                        '<strong>¡'+response+'!</strong></strong>'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>';
                    $("#periodos").html(output);
                } else {
                    output = response;
                    $("#periodos").html(output);
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    }

    $("body").on("click", ".table-periodo .tbody-periodo a.periodo", function(event) {
        event.preventDefault();
        var IdUsuario = $(".navbar #navbarContent .dropdown .nav-link").attr("IdUsuario");
        var Matricula = $("#Matricula").attr("mat");
        var IdCiclo = $(this).attr("id");
        var Ciclo = $(this).html();
        
        $.ajax({
            url: "ajax/ajax_ver_calificaciones.php",
            method: "POST",
            async: true,
            data: {IdUsuario: IdUsuario, Matricula: Matricula, IdCiclo: IdCiclo, Ciclo: Ciclo},

            success: function(response) {
                var output = "";
                if (response=='Error al consultar tu boleta de calificaciones' || 
                    response=='Tu boleta de calificaciones aún no esta disponible') {
                    output = '<div class="row align-items-center">'+
                               '<div class="col-sm-12">'+
                                    '<div class="justify-conten-center alert alert-danger alert-dismissible fade show" role="alert">'+
                                        '<strong id="alert-boleta">'+response+'</strong>'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    $("#boleta").html(output);
                } else {
                    output = response;
                    $("#boleta").html(output);
                    $("body #boleta .table-boleta").attr("IdCiclo",IdCiclo);
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    });

    $("body").on("click", "#btn-imprimir", function(event) {
        event.preventDefault();
        var IdUsuario = $(".navbar #navbarContent .dropdown .nav-link").attr("IdUsuario");
        var Matricula = $("#Matricula").attr("mat");
        var IdCiclo = $("body #boleta .table-boleta").attr("IdCiclo");
        var Ciclo = $('body #boleta .table-boleta .thead-boleta #ciclo-escolar').html();
        
        $.ajax({
            url: "ajax/ajax_imprimir_boleta.php",
            method: "POST",
            async: true,
            data: {IdUsuario: IdUsuario, Matricula: Matricula, IdCiclo: IdCiclo, Ciclo: Ciclo},

            success: function(response) {
                var output = "";
                if (response=='No se ha podido generar su boleta de calificaciones') {
                    $.confirm({
                        title: 'Generando boleta de calificaciones',
                        content: response,
                        type: 'red',
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: false,
                        buttons: {
                          aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn btn-danger',
                            action: function() {
                              $(this).fadeOut();
                            }
                          }
                        }
                    });
                } else {
                    window.open("impresiones/"+response,'_blank');
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    });

})
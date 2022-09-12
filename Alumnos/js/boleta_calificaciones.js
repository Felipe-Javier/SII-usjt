$(document).ready(function() {
    var matricula = $("#Matricula").attr("mat");
    load_periodos(matricula);

    function load_periodos(matricula) {
        $.ajax({
            url: "ajax/ajax_ver_periodos_disponibles.php",
            method: "POST",
            async: true,
            data: {Matricula: matricula},

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
        var Matricula = $("#Matricula").attr("mat");
        var IdCiclo = $(this).attr("id");
        
        $.ajax({
            url: "ajax/ajax_ver_calificaciones.php",
            method: "POST",
            async: true,
            data: {Matricula: Matricula, IdCiclo: IdCiclo},

            success: function(response) {
                console.log(response);
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
        var Matricula = $("#Matricula").attr("mat");
        var IdCiclo = $("body #boleta .table-boleta").attr("IdCiclo");
        
        $.ajax({
            url: "ajax/ajax_imprimir_boleta.php",
            method: "POST",
            async: true,
            data: {Matricula: Matricula, IdCiclo: IdCiclo},

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
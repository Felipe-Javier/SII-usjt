$(document).ready(function() {
    var IdPersona = $("#barra #datos-usuario").attr("IdPersona");
    var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");

    load_grupos(IdPersona, IdInstructor);

    function load_grupos(IdPersona, IdInstructor) {
        $.ajax({
            url: "ajax/ajax_ver_grupos.php",
            method: "POST",
            async: true,
            data: {IdPersona: IdPersona, IdInstructor: IdInstructor},

            success: function(response) {
                var output = "";
                if(response=='Ingrese los datos de usuario para ver los grupos asignados' || response=='No se ha podido consultar los grupos asignados') {
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
                                action: function() {
                                $(this).fadeOut();
                                }
                            }
                        }
                    });
                } else {
                    if (response=='No se encontraron grupos asignados') {
                        output = '<option value="" selected>'+response+'</option>';
                        $("#barra #grupos").append(output);
                    } else {
                        var info = JSON.parse(response);
                        var array = [];
                        array = info;
                        var numRows = array.length;
                        for(var i=0; i<numRows; i++) {
                            output = '<option value="'+array[i].IDGRUPO+'" materia="'+array[i].MATERIA+'">'+array[i].GRUPO+'</option>';
                            $("#barra #grupos").append(output);
                        }
                    }
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    }

    $("#barra #grupos").on("change", function(event) {
        event.preventDefault();

        var IdInstructor = $("#barra #datos-usuario").attr("IdInstructor");
        var IdGrupo = $("#barra #grupos").val();
        var Materia = $("#barra #grupos option:selected").attr("materia");

        $.ajax({
            url: "ajax/ajax_ver_alumnos.php",
            method: "POST",
            async: true,
            data: {IdGrupo: IdGrupo, IdInstructor: IdInstructor},

            success: function(response) {
                var output = "";
                if (response=='Ingrese los datos de usuario para ver los grupos asignados' || response=='No se ha podido consutar los alumnos registrados') {
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
                                action: function() {
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
                        $("#contenido-cuerpo #Nombre_Materia").html(Materia);
                    }
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    });
})
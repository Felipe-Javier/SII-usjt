$(document).ready(function() {

    /*$("#rol_usuario").on("change", function(){
        var rol_usuario = $("form .form-group #rol_usuario").val();
        if ($("#general").attr("class")=="d-none") {
            $("#general").toggleClass("d-none");
        }
    
        if (rol_usuario=="DOCENTE") {
            $("#docente").show();
            $("#alumno").hide();
        }
    
        if (rol_usuario=="ALUMNO") {
            $("#docente").hide();
            $("#alumno").show();
        }
    });*/

    $("#button_entrar").on("click", function() {
        var rol_usuario = $("form .form-group #rol_usuario").val();
        var usuario = $("form .form-group #usuario").val();
        var contraseña = $("form .form-group #password").val();
        console.log(rol_usuario);
        console.log(usuario);
        console.log(contraseña);
        $.ajax({
            url: "ajax/ajax_iniciar_sesion.php",
            method: "POST",
            data: {rol_usuario: rol_usuario, usuario: usuario, contraseña: contraseña},
            async: true,

            success: function(response) {
                console.log(response);
                var output = "";
                if (response=='¡Usuario inactivo!' || response=='¡Usuario bloqueado!' || response=='¡Datos de incio de sesion incorrectos!') {
                    output = '<div class="col-12">'+
                                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                                        '<strong>¡Atención: '+response+'!</strong></strong>'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>';
                    $("#result").html(output);
                } else {
                    var info = JSON.parse(response);
                    if (info.Rol == 'DOCENTE') {
                        location.href = '../Docentes/Inicio.php';
                    } else {
                        location.href = '../Alumnos/Inicio.php';
                    }
                }
            },
    
            error: function(error) {
                $("#result").html(error);
            }
        });
    });

})
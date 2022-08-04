
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

    var formsUIT = $('#loguear.needs-validation');
    var validation_UIT = Array.prototype.filter.call(formsUIT, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() == false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            $("#result").html("Atencion: Ingrese los datos de inicio de sesion para continuar");
          } else {
            if (form.checkValidity() == true) {
              event.preventDefault();
              event.stopPropagation();
              form.classList.add('was-validated');
              Iniciar_Sesion();
            }
          }
        }, false);
    });

    function Iniciar_Sesion() {
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

           /* beforeSend:function(){
                $("#result").html("<div> iniciando sesion </div>");

            },*/
 
            success: function(response) {
                console.log(response);
                var output = "";
                if (response=='¡Atención: Usuario inactivo!' || response=='¡Atención: Usuario bloqueado!' || response=='¡Atención: Datos de incio de sesion incorrectos!') {
                    output =  response;
                            
                    $("#result").html(output);
                } else {
                    var info = JSON.parse(response);
                    if (info.Rol == 'DOCENTE') {
                        location.href = '../Docentes/Inicio.php';
                    } else {
                        if (info.Rol == 'ALUMNO') {
                            location.href = '../Alumnos/Inicio.php';
                        }
                    }
                }
            },
            
            error: function(error) {
                $("#result").html(error);
            }
            
        });
    }
    
    $(document).ready(function() {
        $("#result").hide();
        $("#button_entrar").click(function showAlert() {
            $("#result").fadeTo(2000, 500).slideUp(500, function() {
            $("#result").slideUp(500);
            });
        });
    });
      
})
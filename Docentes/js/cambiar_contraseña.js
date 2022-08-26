$(document).ready(function () {

    "use strict";

    var formCambioContraseñaPrimeraVez = $('#cambio-contraseña-primera_vez.needs-validation');

    var validation_CambioContraseñaPrimeraVez = Array.prototype.filter.call(formCambioContraseñaPrimeraVez, function(form) {
       form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                var output = "";
                output = '<div class="col-12">'+
                            '<div class="alert alert-danger fade show text-center" role="alert">'+
                                '<strong>¡Atención: Ingrese su nueva contraseña para continuar!</strong>'+
                            '</div>'+
                         '</div>';
                $("#result").html(output);
                $("#result .alert").fadeTo(2000, 500);
                $("#result .alert").slideUp(500);
            } else {
                if (form.checkValidity() == true) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    var pass = $("#cambio-contraseña-primera_vez #password").val();
                    var pass_confirm = $("#cambio-contraseña-primera_vez #password-confirm").val();
                    if (pass != pass_confirm) {
                        output = '<div class="col-12">'+
                            '<div class="alert alert-danger fade show text-center" role="alert">'+
                                '<strong>¡Las contraseñas no coinciden, verifiquelas y vuelva a intentarlo!</strong>'+
                            '</div>'+
                         '</div>';
                        $("#result").html(output);
                        $("#result .alert").fadeTo(2000, 500);
                        $("#result .alert").slideUp(500);
                    } else {
                        cambiar_contraseña_primera_vez();
                    }
                }
            }
        }, false);
    });

    

});
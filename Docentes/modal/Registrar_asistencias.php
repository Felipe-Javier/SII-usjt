<div class="modal fade modalRegistrarAsistencias" id="modalRegAsistencias" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
          <form action="" method="post" id="Form-RegistrarAsistencias" class="needs-validation" novalidate>
            <div class="text-center form-header">
              <section class="row">
                <div class="col-sm-12">
                  <div class="title">
                    <b class=""><i class="fas fa-edit mr-3"></i>Registrar asistencia</b>
                  </div>
                </div>
              </section>
            </div>
            <div class="form-body">
              <section class="row">
                <div class="col-sm-6 mt-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-bold text-size">Fecha de asistencia</span>
                    </div>
                    <input type="date" name="Fecha_Asistencia" id="Fecha_Asistencia" class="form-control rounded-right text-size" value="" required>
                  </div>
                </div>
                <div class="col-sm-6 mt-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-bold text-size">Dia de asistencia</span>
                    </div>
                    <select name="Dia_Asistencia" id="Dia_Asistencia" class="custom-select rounded-right text-size" status="" required>
                      
                    </select>
                  </div>
                </div>
              </section>
              <section class="row mt-2" id="alumnos"></section>
              <section class="row">
                <div class="col-sm-12">
                  <div class="row justify-content-center">
                    <div class="col-sm-3 mt-3">
                      <button type="submit" class="button-custom button-blue">
                        <i class="far fa-save h6 mr-2"></i>Guardar
                      </button>
                    </div>
                    <div class="col-sm-3 mt-3">
                      <button class="button-custom button-red" data-dismiss="modal" id="closeModalRegistrarAsistencias">
                        <i class="far fa-window-close h6 mr-2"></i>Cerrar
                      </button>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </form>
      </div>   
    </div>
  </div>
</div> 
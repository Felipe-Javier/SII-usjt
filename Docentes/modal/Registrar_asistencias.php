<div class="modal fade modalRegistrarAsistencias" id="modalForm" role="dialog">
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
              <section class="row mt-2">
                <div class="col-sm-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-bold text-size">Fecha de asistencia</span>
                    </div>
                    <input type="date" name="Fecha_Asistencia" id="Fecha_Asistencia" class="form-control rounded-right text-size" value="" required>
                  </div>
                </div>
                <div class="col-sm-6">
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
              <section class="row mt-3">
                <div class="col-sm-12">
                  <div class="row justify-content-center">
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary btnCustom">
                        <i class="far fa-save mr-2 size-icon"></i>Guardar
                      </button>
                    </div>
                    <div class="col-sm-3">
                      <a href="#" class="btn btn-danger btnCustom" data-dismiss="modal" id="closeModalRegistrarAsistencias">
                      <i class="far fa-window-close mr-2 size-icon"></i>Cerrar</a>
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
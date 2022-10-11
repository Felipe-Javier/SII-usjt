<!--<div class="modal modalRegistrarAsistencias">
  <div class="bodyModal">  
    <form action="" method="post" id="Form-RegistrarAsistencia" class="needs-validation" novalidate>
      <div class="text-center form-header">
        <section class="row">
          <div class="col-sm-12">
            <b><i class="fas fa-plus-octagon mr-3"></i>Registrar asistencia</b>
          </div>
        </section>
      </div>
      <div class="form-body">
        <section class="row">
          <div class="col-sm-12">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Fecha de asistencia</span>
              </div>
              <input type="date" name="Fecha_Asistencia" id="Fecha_Asistencia" class="form-control rounded-right" value="" required>
            </div>
          </div>
        </section>
        <section class="row">
          <div class="col-sm-12">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Dia de asistencia</span>
              </div>
              <select name="Dia_Asistencia" id="Dia_Asistencia" class="custom-select rounded-right" status="" required>
                <option value="" selected disabled>-- seleccione --</option>
              </select>
            </div>
          </div>
        </section>
        <section class="row" id="alumnos"></section>
        <section class="row mt-3">
          <div class="col-sm-12">
            <div class="row justify-content-center">
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary form-control">Guardar</button>
              </div>
              <div class="col-sm-4">
                <a href="#" class="btn btn-danger form-control" id="closeModalRegistrarAsistencia" style="height: 38px; border-radius: 5px;">Cerrar</a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>
-->
<!--
Modal 
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    Open Contact Form
</button>
-->

<div class="modal fade modalRegistrarAsistencias" id="modalForm" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        <p class="statusMsg"></p>
          <form action="" method="post" id="Form-RegistrarAsistencia" class="needs-validation" novalidate>
            <div class="text-center form-header">
              <section class="row">
                <div class="col-sm-12">
                  <b><i class="fas fa-plus-octagon mr-3"></i>Registrar asistencia</b>
                </div>
              </section>
            </div>
            <div class="form-body">
              <section class="row">
                <div class="col-sm-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Fecha de asistencia</span>
                    </div>
                    <input type="date" name="Fecha_Asistencia" id="Fecha_Asistencia" class="form-control rounded-right" value="" required>
                  </div>
                </div>
              </section>
              <section class="row">
                <div class="col-sm-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Dia de asistencia</span>
                    </div>
                    <select name="Dia_Asistencia" id="Dia_Asistencia" class="custom-select rounded-right" status="" required>
                      <option value="" selected disabled>-- seleccione --</option>
                    </select>
                  </div>
                </div>
              </section>
              <section class="row" id="alumnos"></section>
              <section class="row mt-3">
                <div class="col-sm-12">
                  <div class="row justify-content-center">
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-primary form-control">Guardar</button>
                    </div>
                    <div class="col-sm-4">
                      <a href="#" class="btn btn-danger form-control" data-dismiss="modal" id="closeModalRegistrarAsistencia" style="height: 38px; border-radius: 5px;">Cerrar</a>
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
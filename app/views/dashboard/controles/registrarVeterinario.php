<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>

<!-- Poner aquí los formularios del dashboard -->
<div class="container registrarVeterinario">
  <div class="pl-0 col-12">
    <div class="row">
      <div class="col">
        <h3 class="text-center">
          <i class="fas fa-users"></i> Veterinarios de Pluto
        </h3>
        <div class="row alerta"></div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div class="row mb-1 mt-2 text-white rounded">
                  <div class="col">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="fas fa-user"></i>
                        </div>
                        <input
                          type="text"
                          name="nombreVeterinario"
                          id="nombreVeterinario"
                          class="form-control"
                          placeholder="Nombre del veterinario"
                        />
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="fas fa-id-card"></i
                          ></span>
                        </div>
                        <select
                          class="custom-select"
                          id="seleccionTipoDocumento"
                          name="seleccionTipoDocumento"
                        >
                          <option value="0" selected
                            >Tipo de documento</option
                          >
                          <option value="Cedula de Ciudadania"
                            >Cédula de Ciudadanía</option
                          >
                          <option value="Documento de ciudadano extranjero"
                            >Documento de ciudadano extranjero</option
                          >
                          <option value="Registro Civil">Registro Civil</option>
                          <option value="Targeta de Identidad"
                            >Targeta de identidad</option
                          >
                          <option value="Permiso especial de permanencia"
                            >Permiso especial de permanencia</option
                          >
                        </select>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="fal fa-id-card"></i></span
                          >
                        </div>
                        <input
                          type="number"
                          name="idVeterinario"
                          id="idVeterinario"
                          class="form-control"
                          placeholder="Número del documento"
                        />
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto pl-0">
                    <button
                      class="btn btn-primary btn-block active"
                      id="registrarVeterinario"
                    >
                    <i class="fal fa-user-plus"></i> Registrar Veterinario
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <table
              class="table text-center table-striped table-primary table-hover rounded"
              id="tablaVeterinarios"
            >
              <thead class="thead">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><i class="fas fa-user"></i> Nombre</th>
                  <th scope="col"><i class="fas fa-id-card"></i
                    > Tipo Documento</th>
                  <th scope="col"><i class="fal fa-id-card"></i> ID</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
          <div class="modal-header d-flex flex-row">
            <h3 class="modal-title text-danger ml-auto">Eliminar veterinario</h3>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body text-danger pt-0">
            <div class="container-fluid">
              <div class="row">
                <div class="col">
                  <p class="text-justify" id="mensaje">
                    ¿Estas seguro de eliminar el veterinario
                    <strong>Paco</strong> con Cedula de ciudadania <strong>123458641</strong>?
                  </p>
                  <div class="row mt-3">
                    <div class="col">
                      <button
                        class="btn btn-danger btn-block"
                        id="btnEliminar"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        Si, eliminar
                      </button>
                    </div>
                    <div class="col">
                      <button
                        class="btn btn-primary btn-block"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        No, cancelar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="height:495px"></div>

<?php  include APPROOT."/views/dashboard/inc/footer.php"; ?>
<script src="<?php echo URLROOT?>js/registrarVeterinario.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

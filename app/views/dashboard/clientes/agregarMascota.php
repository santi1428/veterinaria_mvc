<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>

<!-- Poner aquí los formularios del dashboard -->
<div class="container agregarMascota">
  <div class="pl-0 col-12">
    <div class="row alerta"></div>
    <h5 class="text-center font-italic font-weight-normal">
      Selecciona el cliente que deseas registrarle o removerle mascotas.
    </h5>
    <div class="form-group">
      <select
        class="custom-select"
        id="seleccionClientes"
        name="tipoDocumentoCliente"
      >
        <option value="0" selected>Seleccione el cliente</option>
        <?php listarClientes($data["clientes"]); ?>
      </select>
      <div class="invalid-feedback"></div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card text-white bg-success">
          <div class="card-header text-center">Registro de mascota</div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nombreMascota">Nombre</label>
                  <input
                    type="text"
                    name="nombreMascota"
                    id="nombreMascota"
                    class="form-control"
                    placeholder="Nombre de la mascota"
                  />
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="edadMascota">Edad</label>
                  <input
                    type="number"
                    name="edadMascota"
                    id="edadMascota"
                    class="form-control"
                    placeholder="Ingrese la edad"
                  />
                  <div class="invalid-feedback"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="razaMascota">Raza</label>
                  <select
                    class="custom-select"
                    id="razaMascota"
                    name="razaMascota"
                  >
                    <option selected>Seleccione la raza</option>
                    <?php listarRazas($data["razas"]); ?>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button
                  class="btn btn-success btn-block active"
                  id="anadirMascota"
                >
                  Añadir mascota
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <table
          class="table text-center table-striped table-primary table-hover rounded"
          id="tablaMascotas"
        >
          <thead class="thead">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Raza</th>
              <th scope="col">Edad</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
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
            <h3 class="modal-title text-danger ml-auto">Eliminar mascota</h3>
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
                  <p class="text-justify">
                    ¿Estas seguro de eliminar el servicio de
                    <strong>Vacunación</strong>?
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
<script src="<?php echo URLROOT?>js/formularioAnadirMascota.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

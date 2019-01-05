<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>

<!-- Poner aquí los formularios del dashboard -->
<div class="container inicio">
  <div class="pl-0 col-12">
    <div class="row alerta"></div>
    <div class="row">
      <!-- FORMULARIO CLIENTES -->
      <div class="col pl-0">
        <div class="card p-0 bg-primary">
          <div class="card-header bg-primary text-center text-white">
            Registro de clientes
          </div>
          <div class="card-body text-white">
            <div class="form-group">
              <label for="nombreCliente">Nombre</label>
              <input
                type="text"
                name="nombreCliente"
                id="nombreCliente"
                class="form-control"
                placeholder="Escriba su nombre"
              />
              <div class="invalid-feedback"></div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tipoDocumentoCliente">Tipo de documento</label>
                  <select
                    class="custom-select"
                    id="tipoDocumentoCliente"
                    name="tipoDocumentoCliente"
                  >
                    <option selected>Tipo de documento</option>
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
              <div class="col">
                <div class="form-group">
                  <label for="nombreCliente">Número de documento</label>
                  <input
                    type="number"
                    name="numeroDocumentoCliente"
                    id="numeroDocumentoCliente"
                    class="form-control"
                    placeholder="Número de documento"
                  />
                  <div class="invalid-feedback"></div>
                </div>
              </div>
            </div>
            <div id="telefonosydirecciones">
              <div class="row mt-0 pt-0">
                <div class="col">
                  <div class="form-group">
                    <label for="nombreCliente">Dirección</label>
                    <input
                      class="form-control"
                      placeholder="Dirección"
                      id="direccion"
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="nombreCliente">Ciudad</label>
                    <input
                      class="form-control"
                      placeholder="Ciudad"
                      id="ciudad"
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="col mr-0 pr-0">
                  <div class="form-group">
                    <label for="nombreCliente">Teléfono</label>
                    <input
                      class="form-control"
                      placeholder="Teléfono"
                      type="number"
                      id="telefono"
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col-auto">
                  <hr />
                  <button class="btn btn-danger p-1" disabled>
                    <i class="fal fa-trash-alt"></i>
                  </button>
                </div>
              </div>
            </div>
            <!--BOTONES AGREGAR DIRECCION Y TELEFONO-->
            <div class="row">
              <div class="col">
                <a
                  href="#"
                  class="btn btn-primary btn-block active"
                  id="agregarDireccionYTelefono"
                  >Agregar dirección o teléfono</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <!-- TABLA MASCOTAS -->
        <table
          class="table text-center table-striped table-primary table-hover rounded"
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
    <!-- FORMULARIO MASCOTA -->
    <div class="row mt-1 bg-success text-white pt-2 rounded pl-0 shadow">
      <div class="col">
        <div class="form-group">
          <label for="nombreMascota">Nombre</label>
          <input
            type="text"
            name="nombreMascota"
            id="nombreMascota"
            class="form-control"
            placeholder="Escriba el nombre de la mascota"
          />
          <div class="invalid-feedback"></div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="razaMascota">Raza</label>
          <select class="custom-select" id="razaMascota" name="razaMascota">
            <option selected>Raza</option>
            <?php listarRazas($data["razas"]); ?>
          </select>
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
      <div class="col-auto pl-0">
        <hr />
        <button class="btn btn-success btn-block active" id="anadirMascota">
          <i class="fal fa-plus"></i> Añadir mascota
        </button>
      </div>
    </div>

    <button class="btn btn-primary btn-block mt-3" id="guardarDatos">
      <i class="fas fa-hdd"></i> Guardar Datos
    </button>
    <!-- VENTANA MODAL -->
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
            <h3 class="modal-title text-danger ml-auto">Error de guardado</h3>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div
            class="modal-body text-danger d-flex justify-content-center mt-0 pt-0"
          >
            Debes de ingresar por lo menos una mascota.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php  include APPROOT."/views/dashboard/inc/footer.php"; ?>

<script src="<?php echo URLROOT?>js/formularioCliente.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

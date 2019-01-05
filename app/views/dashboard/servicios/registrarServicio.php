<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>

<!-- Poner aquí los formularios del dashboard -->
<div class="container registrarServicio">
  <div class="pl-0 col-12">
    <div class="row">
      <div class="col">
        <h3 class="text-center">
          <i class="fas fa-briefcase"></i> Servicios que se prestan
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
                            ><i class="fal fa-briefcase"></i></i
                          ></span>
                        </div>
                        <input
                          type="text"
                          name="nombreServicio"
                          id="nombreServicio"
                          class="form-control"
                          placeholder="Escriba el nombre del servicio"
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
                            ><i class="fal fa-dollar-sign"></i
                          ></span>
                        </div>
                        <input
                          type="number"
                          name="valorServicio"
                          id="valorServicio"
                          class="form-control"
                          placeholder="Ingrese el valor del servicio"
                        />
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto pl-0">
                    <button
                      class="btn btn-primary btn-block active"
                      id="anadirServicio"
                    >
                      <i class="far fa-plus"></i> Añadir Servicio
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <table
              class="table text-center table-striped table-primary table-hover rounded" id="tablaServicios"
            >
              <thead class="thead">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre</th>
                  <th scope="col"><i class="fal fa-dollar-sign"></i> Valor</th>
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
                <p class="text-center" id="mensaje">
                  ¿Estas seguro de eliminar la mascota
                  <strong>Paco</strong> de raza <strong>Bulldog</strong> con
                  <strong>25</strong> años?
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
<script src="<?php echo URLROOT?>js/registrarServicio.js"></script>
<?php include APPROOT."/views/inc/footer.php"; ?>

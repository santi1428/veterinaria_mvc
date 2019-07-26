<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>

<div class="container modificarCliente">
  <div class="pl-0 col-12">
    <div class="row">
      <div class="col">
        <h3 class="text-center">
          <i class="fas fa-users"></i> Clientes de la veterinaria
          <span class="badge badge-primary">50</span>
        </h3>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-search"></i></div>
            </div>
            <input
              type="text"
              name="busqueda"
              id="busqueda"
              class="form-control text-center font-weight-bold"
              placeholder="Ingresa el nombre o el ID del cliente"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table
          class="table text-center table-striped table-primary table-hover rounded"
        >
          <thead class="thead">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Tipo de documento</th>
              <th scope="col">Numero de documento</th>
              <th scope="col">Mascotas</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Santiago A. Molina Restrepo</td>
              <td>Cedula de Ciudadania</td>
              <td>14587456984</td>
              <td><span class="badge badge-success p-1">50</span></td>
              <td>
                <button class="btn btn-success p-1">
                  <i class="fal fa-pen-alt"></i>
                </button>
                <button class="btn btn-danger p-1 ml-2">
                  <i class="fal fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div style="height:495px"></div>

<?php  include APPROOT."/views/dashboard/inc/footer.php"; ?>

<script src="<?php echo URLROOT; ?>js/modificarCliente.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

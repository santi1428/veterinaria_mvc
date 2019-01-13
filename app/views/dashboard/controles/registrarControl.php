<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>
<div class="container registrarVeterinario">
  <div class="pl-0 col-12">
    <div class="row alertaError"></div>
    <div class="row mt-1">
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
              id="seleccionCliente"
              name="seleccionCliente"
            >
              <option value="0" selected>Seleccione el cliente</option>
              <?php listarClientes($data["clientes"]); ?>
            </select>
            <div class="invalid-feedback"></div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fal fa-paw"></i></span>
            </div>
            <select
              class="custom-select"
              id="seleccionMascota"
              name="seleccionMascota"
              disabled
            >
              <option value="0" selected
                >Seleccione la mascota del cliente
              </option>
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
                ><i class="fal fa-credit-card"></i
              ></span>
            </div>
            <select
              class="custom-select"
              id="seleccionMetodoPago"
              name="seleccionMetodoPago"
            >
              <option value="0" selected>Seleccione el metodo de pago</option>
              <option value="Efectivo">Efectivo</option>
              <option value="Targeta de Credito">Targeta de Credito</option>
              <option value="Targeta Debito">Targeta Debito</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-around">
      <div class="col">
        <div class="row">
          <div class="col-auto pr-0">
            <div class="custom-control custom-radio">
              <input
                type="radio"
                id="fechaProxima"
                name="customRadio"
                class="custom-control-input"
              />
              <label class="custom-control-label" for="fechaProxima"
                >Seleccionar próxima fecha del control:</label
              >
            </div>
          </div>
          <div class="col">
            <input
              type="date"
              name="proximaFechaInput"
              id="proximaFechaInput"
              class="text-center pl-3"
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-auto pr-2">
            <div class="custom-control custom-radio align-self-center">
              <input
                type="radio"
                id="dias"
                name="customRadio"
                class="custom-control-input"
              />
              <label class="custom-control-label" for="dias"
                >Proxima fecha del control en:</label
              >
            </div>
          </div>
          <div class="col-auto p-0 m-0">
            <div class="input-group">
              <input
                type="number"
                name="numeroDias"
                id="numeroDias"
                class="form-control text-center"
                style="height: 30px;"
              />
              <div class="input-group-append" style="height: 30px;">
                <span class="input-group-text">dias</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"
                ><i class="fal fa-briefcase"></i
              ></span>
            </div>
            <select
              class="custom-select"
              id="seleccionServicio"
              name="seleccionServicio"
            >
              <option value="0" selected
                >Seleccione el servicio prestado a la mascota
              </option>
              <?php listarServicios($data["servicios"]); ?>
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
                ><i class="far fa-user-md"></i
              ></span>
            </div>
            <select
              class="custom-select"
              id="seleccionVeterinario"
              name="seleccionVeterinario"
            >
              <option value="0" selected
                >Seleccione el veterinario que presto el servicio
              </option>
              <?php listarVeterinarios($data["veterinarios"]); ?>
            </select>
            <div class="invalid-feedback"></div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <button class="btn btn-primary btn-block" id="anadirServicio">
            <i class="far fa-plus"></i> Añadir Servicio
          </button>
        </div>
      </div>
    </div>
    <div class="row alerta"></div>
    <div class="row">
      <div class="col">
        <table
          class="table text-center table-striped table-primary table-hover rounded"
          id="tablaServicios"
        >
          <thead class="thead">
            <tr>
              <th scope="col">#</th>
              <th scope="col">
                <i class="fal fa-briefcase"></i> Nombre del Servicio
              </th>
              <th scope="col">
                <i class="fas fa-usd-square"></i> Valor del servicio
              </th>
              <th scope="col">
                <i class="far fa-user-md"></i> Servicio atendido por
              </th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr id="vacio">
              <td colspan="5" style="height:235px; padding-top:105px;">
                <i class="fal fa-info-circle"></i> No hay contenido en esta
                tabla
              </td>
            </tr>
            <tr class="total bg-info">
              <td></td>
              <td><i class="fas fa-dollar-sign"></i> <strong>Total</strong></td>
              <td><strong>0</strong> <i class="fas fa-dollar-sign"></i></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <button class="btn btn-primary btn-block" id="registrarControl">
          <i class="fas fa-hdd"></i> Registrar Control
        </button>
      </div>
    </div>
  </div>
</div>

<div style="height:495px"></div>

<?php  include APPROOT."/views/dashboard/inc/footer.php"; ?>
<script src="<?php echo URLROOT?>js/registrarControl.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

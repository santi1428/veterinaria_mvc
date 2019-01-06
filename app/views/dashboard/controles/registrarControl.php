<?php  include APPROOT."/views/inc/header.php"; ?>

<?php  include APPROOT."/views/dashboard/inc/header.php"; ?>

<?php include  APPROOT."/views/dashboard/inc/dashboardNav.php"; ?>
<div class="container registrarVeterinario">
  <div class="pl-0 col-12">
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
    </div>
  </div>
</div>

<div style="height:495px"></div>

<?php  include APPROOT."/views/dashboard/inc/footer.php"; ?>
<script src="<?php echo URLROOT?>js/registrarControl.js"></script>

<?php include APPROOT."/views/inc/footer.php"; ?>

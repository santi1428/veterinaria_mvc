<?php  include APPROOT."/views/inc/header.php"; ?>
<title>Registro de empleado</title>
<div class="full-width-3">
  <div class="container">
    <hr />
    <hr />
    <div class="row justify-content-center py-5">
        <?php  mostrarError($data); ?>
      <div
        class="card card-fluid col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 border-primary"
      >
        <div class="card-header text-center text-primary">
          Registro de empleado
        </div>
        <div class="card-body text-primary">
          <form action="<?php echo URLROOT; ?>empleados/registro" id="formularioRegistro" method="POST">
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input
                type="text"
                name="usuarioRegistro"
                id="usuarioRegistro"
                class="form-control <?php echo $data["errorUsuario"]; ?>"
                placeholder="Escribe tu usuario"
                value = "<?php echo $data["usuarioRegistro"]; ?>"
              />
              <div class="invalid-feedback">  
              <?php echo $data["errorUsuarioMensaje"]; ?>
            </div>

            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input
                type="text"
                name="nombreRegistro"
                id="nombreRegistro"
                class="form-control border-primary"
                placeholder="Escribe tu nombre"
                value = "<?php echo $data["nombreRegistro"]; ?>"
              />
              <div class="invalid-feedback">
                
            </div>
            </div>
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input
                type="password"
                name="contrasenaRegistro"
                id="contrasenaRegistro"
                class="form-control border-primary"
                placeholder="Escribe tu contraseña"
                value="<?php echo $data["contrasenaRegistro"]; ?>"
              />
              <div class="invalid-feedback">
            </div>
            </div>
            <div class="form-group mb-2">
              <label for="concontraseña">Confirmar contraseña</label>
              <input
                type="password"
                name="concontrasenaRegistro"
                id="concontrasenaRegistro"
                class="form-control border-primary"
                placeholder="Confirma tu contraseña"
                value="<?php echo $data["concontrasenaRegistro"]; ?>"
              />
              <div class="invalid-feedback">
            </div>
            </div>
            <div class="custom-control custom-checkbox mb-3">
              <input
                type="checkbox"
                class="custom-control-input"
                id="terminos"
              />
              <label class="custom-control-label" for="terminos"
                >Acepto términos y condiciones</label
              >
            </div>
            <div class="row">
              <div class="col-sm-6 mb-2">
                <input
                  type="submit"
                  class="btn btn-outline-primary btn-block active"
                  value="Registrarse"
                />
              </div>
              <div class="col-sm-6">
                <a href="#" class="card-link text-primary" id="link-registro"
                  >¿Ya tienes cuenta? Inicia sesión</a
                >
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo URLROOT;?>js/validarRegistro.js"></script>
<script src="<?php echo URLROOT;?>js/validarLogin.js"></script>
<?php include APPROOT."/views/inc/footer.php"; ?>
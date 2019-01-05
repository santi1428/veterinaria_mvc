<nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <div class="container">
          <a href="<?php echo URLROOT; ?>" class="navbar-brand"><i class="fal fa-paw"></i> Veterinaria Pluto</i></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse text-center"
            id="navbarSupportedContent"
          >
            <ul class="navbar-nav ml-auto">
            <?php if(!isset($_SESSION["empleadoUsuario"])): ?>
              <div class="dropdown">
                <li class="nav-item mr-5">
                  <a
                    href=""
                    class="nav-link active"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><i class="fal fa-sign-in"></i> Inicia Sesión</a
                  >
                  <div
                    class="mx-auto dropdown-menu formulario-login bg-primary"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <!-- FORMULARIO DE INICIO DE SESIÓN -->

                    <form action = "<?php echo URLROOT; ?>empleados/login" method="POST" class="card-body pt-1 pl-3 pr-3 pb-1 text-center" id="formularioLogin">
                      <div class="form-group mb-2 text-primary">
                        <input
                          type="text"
                          name="usuarioLogin"
                          id="usuarioLogin"
                          class="form-control"
                          placeholder="Ingrese su usuario"
                        />
                      </div>
                      <div class="form-group text-primary mb-2">
                        <input
                          type="password"
                          name="contrasenaLogin"
                          id="contrasenaLogin"
                          class="form-control"
                          placeholder="Ingrese su contraseña"
                        />
                      </div>
                      <input
                        type="submit"
                        class="btn btn-primary  btn-block active"
                        value="Iniciar sesión"
                        id="botonLogin"
                      disabled />
                    </form>

                    <!-- FIN FORMULARIO DE INICIO DE SESIÓN -->
                  </div>
                </li>
              </div>
              <li class="nav-item mr-5">
                <a href="<?php echo URLROOT; ?>empleados" class="nav-link active"
                  ><i class="fal fa-user-plus"> </i> Registrate</a
                >
              </li>
              <?php else: ?>
              <li class="nav-item mr-5">
              <a href="<?php echo URLROOT; ?>dashboard" class="nav-link active"
                  ><i class="fal fa-tasks"></i> Dashboard</a
                >
              </li>
              <li class="nav-item mr-5">
              <a href="<?php echo URLROOT; ?>empleados/logout" class="nav-link active"
                  ><i class="fal fa-sign-out-alt"></i
          > Cerrar Sesión</a
                >
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
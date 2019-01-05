<div class="col-2">
  <div class="card bg-primary">
    <div class="card-header">
      <p class="text-center text-white mb-0"><strong>DASHBOARD</strong></p>
    </div>
    <div class="card-header">
      <div class="d-flex justify-content-center mt-2">
        <img src="<?php echo URLROOT;?>public/img/dashboard/user.png" alt="" />
      </div>
      <p class="text-center text-white mt-2 mb-2 pb-0 border-bottom">
        <?php echo $_SESSION["empleadoUsuario"]; ?>
      </p>
      <div class="d-flex flex-row justify-content-center">
        <a href="#" class="mr-4 text-white"><i class="fal fa-cog"></i></a>
        <a href="<?php echo URLROOT ?>empleados/logout" class="text-white"
          ><i class="fal fa-sign-out-alt"></i
        ></a>
      </div>
    </div>
    <ul class="nav flex-column text-center mt-0">
      <li class="nav-item">
        <div class="card-header bg-success">
          <a
            class="text-white nav-link p-0"
            data-toggle="collapse"
            href="#collapseClientes"
            role="button"
            aria-expanded="false"
            aria-controls="collapseClientes"
            ><i class="fal fa-users"></i> Clientes</a
          >
        </div>
        <div class="collapse" id="collapseClientes">
          <div class="">
            <ul class="nav d-flex flex-column">
              <li class="nav-item pb-2 pt-2">
                <a
                  href="<?php echo URLROOT ?>dashboard"
                  class="text-white"
                  style="font-size:15px;"
                  >Registrar cliente</a
                >
              </li>
              <li class="nav-item pb-2">
                <a
                  href="<?php echo URLROOT ?>dashboard/agregarmascota"
                  class="text-white"
                  style="font-size:15px;"
                  >Registrar mascota</a
                >
              </li>
            </ul>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <div class="card-header bg-secondary">
          <a
            class="text-white nav-link p-0"
            data-toggle="collapse"
            href="#collapseServicios"
            role="button"
            aria-expanded="false"
            aria-controls="collapseServicios"
            ><i class="fal fa-briefcase"></i> Servicios</a
          >
        </div>
        <div class="collapse" id="collapseServicios">
          <div class="">
            <ul class="nav d-flex flex-column">
              <li class="nav-item pb-2 pt-2">
                <a
                  href="<?php echo URLROOT ?>dashboard/registrarServicio"
                  class="text-white"
                  style="font-size:15px;"
                  >Registrar Servicio</a
                >
              </li>
            </ul>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <div class="card-header" style="background:#33ba27;">
          <a
            class="text-white nav-link p-0"
            data-toggle="collapse"
            href="#collapseControles"
            role="button"
            aria-expanded="false"
            aria-controls="collapseControles"
            ><i class="fal fa-money-bill"></i> Controles</a
          >
        </div>
        <div class="collapse" id="collapseControles">
          <div class="">
            <ul class="nav d-flex flex-column">
              <li class="nav-item pb-2 pt-2">
                <a
                  href="<?php echo URLROOT ?>dashboard/registrarVeterinario"
                  class="text-white"
                  style="font-size:15px;"
                  >Registrar Veterinario</a
                >
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

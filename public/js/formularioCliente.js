document
  .getElementById("agregarDireccionYTelefono")
  .addEventListener("click", function() {
    let camposAdicionales = document.createElement("div");
    camposAdicionales.className = "row";
    camposAdicionales.innerHTML = `<div class="col">
              <div class="form-group">
                <input class="form-control" placeholder="Dirección" />
                <div class="invalid-feedback"></div>
              </div>
            </div>
            <div class="col">
              <div class="form-group"> 
                <input class="form-control" placeholder="Ciudad" />
                <div class="invalid-feedback"></div>
              </div>
            </div>
            <div class="col mr-0 pr-0">
              <div class="form-group">
                <input class="form-control" placeholder="Teléfono" type="number" />
                <div class="invalid-feedback"></div>
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-danger borrar p-1">
                <i class="fal fa-trash-alt"></i>
              </button>
            </div>`;
    document
      .getElementById("telefonosydirecciones")
      .appendChild(camposAdicionales);
  });

document
  .getElementById("telefonosydirecciones")
  .addEventListener("click", eliminarCamposAdicionales);

document
  .getElementById("anadirMascota")
  .addEventListener("click", verificarCampos);

let table = document.querySelector(".table tbody");
table.addEventListener("click", eliminarMascota);
let ventana = document.getElementById("exampleModalCenter");

let btnGuardar = document.getElementById("guardarDatos");

btnGuardar.addEventListener("click", guardarDatos);

let mascotasEnvio = [];
let direccionesYTelefonos = [];

function verificarCampos() {
  let nombreMascota = document.getElementById("nombreMascota");
  let razaMascota = document.getElementById("razaMascota");
  let edadMascota = document.getElementById("edadMascota");

  if (nombreMascota.value == "") {
    setErrorMessage(nombreMascota, "Debe ingresar un nombre.");
  } else {
    unsetErrorMessage(nombreMascota);
  }

  if (razaMascota.options[razaMascota.selectedIndex].value == "Raza") {
    setErrorMessage(razaMascota, "Debe de seleccionar una raza.");
  } else {
    razaMascota.className = "custom-select is-valid";
  }

  if (edadMascota.value != "") {
    if (edadMascota.value > 100) {
      setErrorMessage(edadMascota, "Debe de ingresar una raza menor a 100");
    } else {
      unsetErrorMessage(edadMascota);
    }
  } else {
    setErrorMessage(edadMascota, "Debe de ingresar la edad");
  }

  if (
    nombreMascota.value != "" &&
    razaMascota.options[razaMascota.selectedIndex].value != "Raza" &&
    edadMascota.value != "" &&
    edadMascota.value < 100
  ) {
    if (verificarMascotas() === true) {
      unsetErrorMessage(nombreMascota);
      anadirMascota();
      nombreMascota.value = "";
      razaMascota.value = "Raza";
      edadMascota.value = "";
      mostrarMensaje();
    } else {
      setErrorMessage(nombreMascota, "Esta mascota ya existe en la lista");
    }
  }
}

function verificarMascotas() {
  let c = 0;
  mascotasEnvio.forEach(mascota => {
    if (
      mascota.nombre == nombreMascota.value &&
      mascota.raza == razaMascota.options[razaMascota.selectedIndex].value
    ) {
      c++;
    }
  });

  if (c != 0) {
    return false;
  } else {
    return true;
  }
}

function anadirMascota() {
  let fila = document.createElement("tr");

  fila.innerHTML = ` <tr>
                    <th scope="row"></th>
                    <td>${nombreMascota.value}</td>
                    <td>${
                      razaMascota.options[razaMascota.selectedIndex].value
                    }</td>
                    <td>${edadMascota.value}</td>
                    <td class="d-flex justify-content-start">
                    <button class="btn btn-danger p-1">
                      <i class="fal fa-trash-alt"></i>
                    </button>
                  </td>
                    </tr>`;

  table.appendChild(fila);
  enumerarMascotas();
  let mascota = {
    nombre: nombreMascota.value,
    raza: razaMascota.options[razaMascota.selectedIndex].value,
    edad: edadMascota.value
  };
  mascotasEnvio.push(mascota);
}

function eliminarMascota(e) {
  let mascotaEliminada;
  if (e.target.parentElement.classList.contains("btn-danger")) {
    mascotaEliminada = e.target.parentElement.parentElement.parentElement;
    e.target.parentElement.parentElement.parentElement.remove();
    enumerarMascotas();
    eliminarMascotadelArreglo(mascotaEliminada);
  } else if (e.target.parentElement.classList.contains("d-flex")) {
    mascotaEliminada = e.target.parentElement.parentElement;
    e.target.parentElement.parentElement.remove();
    enumerarMascotas();
    eliminarMascotadelArreglo(mascotaEliminada);
  }
}

function eliminarMascotadelArreglo(mascotaEliminada) {
  mascotasEnvio.forEach((mascota, index) => {
    if (
      mascota.nombre == mascotaEliminada.children[1].textContent &&
      mascota.raza == mascotaEliminada.children[2].textContent &&
      mascota.edad == mascotaEliminada.children[3].textContent
    ) {
      mascotasEnvio.splice(index, 1);
    }
  });

  console.log(mascotasEnvio.length);
}

function enumerarMascotas() {
  let c = 1;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    tr.children[0].textContent = c;
    c++;
  });
}

function mostrarMensaje() {
  let alert = `<div class="col">
     <div class="alert alert-warning text-center" role="alert">
       <strong> Mascota añadida.</strong>
     </div>
   </div>`;

  alerta = document.querySelector(".alerta");
  alerta.innerHTML = alert;

  setTimeout(() => {
    alerta.innerHTML = "";
  }, 1500);
}

function guardarDatos() {
  let nombreCliente = document.getElementById("nombreCliente");
  let tipoDocumentoCliente = document.getElementById("tipoDocumentoCliente");
  let numeroDocumentoCliente = document.getElementById(
    "numeroDocumentoCliente"
  );

  if (nombreCliente.value == "") {
    setErrorMessage(nombreCliente, "Ingrese su nombre");
  } else {
    unsetErrorMessage(nombreCliente);
  }

  if (
    tipoDocumentoCliente.options[tipoDocumentoCliente.selectedIndex].value ==
    "Tipo de documento"
  ) {
    setErrorMessage(tipoDocumentoCliente, "Seleccione su tipo de documento");
  } else {
    unsetErrorMessage(tipoDocumentoCliente);
  }

  if (numeroDocumentoCliente.value == "") {
    setErrorMessage(numeroDocumentoCliente, "Ingrese su número de documento");
  } else {
    unsetErrorMessage(numeroDocumentoCliente);
  }

  if (
    nombreCliente.value != "" &&
    tipoDocumentoCliente.options[tipoDocumentoCliente.selectedIndex].value !=
      "Tipo de documento" &&
    numeroDocumentoCliente.value != ""
  ) {
    if (mascotasEnvio.length > 0) {
      let clienteDatos = [
        nombreCliente.value,
        tipoDocumentoCliente.options[tipoDocumentoCliente.selectedIndex].value,
        numeroDocumentoCliente.value
      ];

      guardarDireccionesYTelefonos();

      let datosEnvio = {
        cliente: clienteDatos,
        mascotas: mascotasEnvio,
        datosAdicionales: null
      };
      if (direccionesYTelefonos.length != 0) {
        datosEnvio.datosAdicionales = direccionesYTelefonos;
      }

      btnGuardar.disabled = true;
      const http = new EasyHTTP();

      http
        .post(
          "http://191.232.246.84/clientes/ingresarcliente",
          datosEnvio
        )
        .then(resp => {
          mostrarVentana(resp.resp, resp.msg);
          if (resp.resp == 1) {
            clienteDatos = [];
            mascotasEnvio = [];
            direccionesYTelefonos = [];
            registroExitoso();
          }
          btnGuardar.disabled = false;
        })
        .catch(() => {
          mostrarVentana(
            0,
            "Ha ocurrido un error durante el registro. Vuelve a intentarlo mas tarde"
          );
          btnGuardar.disabled = false;
        });
    } else {
      mostrarVentana(
        0,
        "Al cliente se le debe de ingresar almenos una mascota"
      );
    }
  }
}

function registroExitoso() {
  table.innerHTML = "";
  document.getElementById("nombreMascota").value = "";
  document.getElementById("razaMascota").value = "Raza";
  document.getElementById("edadMascota").value = "";
  document.getElementById("nombreCliente").value = "";
  document.getElementById("tipoDocumentoCliente").value = "Tipo de documento";
  document.getElementById("numeroDocumentoCliente").value = "";
  document.getElementById("direccion").value = "";
  document.getElementById("ciudad").value = "";
  document.getElementById("telefono").value = "";
  Array.from(document.getElementById("telefonosydirecciones").children).forEach(
    (item, index) => {
      if (index != 0) {
        item.remove();
      }
    }
  );
}

function mostrarVentana(resp, msg) {
  if (resp == 1) {
    ventana.innerHTML = `<div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex flex-row">
          <h3 class="modal-title text-success ml-auto">
            Guardado exitoso!
          </h3>
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
          class="modal-body text-success d-flex justify-content-center mt-0 pt-0"
        >
          ${msg}
        </div>
      </div>
    </div>`;
    $("#exampleModalCenter").modal("toggle");
  } else {
    ventana.innerHTML = `<div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex flex-row">
        <h3 class="modal-title text-danger ml-auto">
          Error de guardado
        </h3>
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
        ${msg}
      </div>
    </div>
  </div>`;
    $("#exampleModalCenter").modal("toggle");
  }
}

function eliminarCamposAdicionales(e) {
  if (e.target.parentElement.classList.contains("borrar")) {
    e.target.parentElement.parentElement.parentElement.remove();
  } else if (e.target.parentElement.classList.contains("col-auto")) {
    e.target.parentElement.parentElement.remove();
  }
}

function guardarDireccionesYTelefonos() {
  let campos = Array.from(
    document.getElementById("telefonosydirecciones").children
  );
  campos.forEach((campo, index) => {
    let objAux = { direccion: null, ciudad: null, telefono: null };
    if (index == 0) {
      if (
        comprobarDireccionesYTelefonos(
          campo.children[0].children[0].children[1].value,
          1
        ) == true
      ) {
        objAux.direccion = campo.children[0].children[0].children[1].value;
      }

      if (
        comprobarDireccionesYTelefonos(
          campo.children[1].children[0].children[1].value,
          2
        ) == true
      ) {
        objAux.ciudad = campo.children[1].children[0].children[1].value;
      }

      if (
        comprobarDireccionesYTelefonos(
          campo.children[2].children[0].children[1].value,
          3
        ) == true
      ) {
        objAux.telefono = campo.children[2].children[0].children[1].value;
      }
    } else {
      if (
        comprobarDireccionesYTelefonos(
          campo.children[0].children[0].children[0].value,
          1
        ) == true
      ) {
        objAux.direccion = campo.children[0].children[0].children[0].value;
      }

      if (
        comprobarDireccionesYTelefonos(
          campo.children[1].children[0].children[0].value,
          2
        ) == true
      ) {
        objAux.ciudad = campo.children[1].children[0].children[0].value;
      }

      if (
        comprobarDireccionesYTelefonos(
          campo.children[2].children[0].children[0].value,
          3
        ) == true
      ) {
        objAux.telefono = campo.children[2].children[0].children[0].value;
      }
    }
    if (
      objAux.direccion != null ||
      objAux.ciudad != null ||
      objAux.telefono != null
    ) {
      direccionesYTelefonos.push(objAux);
    }
  });
}

function comprobarDireccionesYTelefonos(valor, x) {
  let c = 0;

  if (valor == "") {
    c++;
  } else {
    if (direccionesYTelefonos.length != 0) {
      direccionesYTelefonos.forEach(datos => {
        if (x == 1) {
          if (datos.direccion == valor) {
            c++;
          }
        } else if (x == 2) {
          if (datos.ciudad == valor) {
            c++;
          }
        } else {
          if (datos.telefono == valor) {
            c++;
          }
        }
      });
    }
  }

  if (c == 0) {
    return true;
  } else {
    return false;
  }
}

function setErrorMessage(input, msg) {
  input.className = "form-control is-invalid";
  input.nextElementSibling.textContent = msg;
}

function unsetErrorMessage(input) {
  input.className = "form-control";
  input.nextElementSibling.textContent = "";
}

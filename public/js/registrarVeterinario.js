window.addEventListener("load", traerVeterinarios);
let nombreVeterinario = document.getElementById("nombreVeterinario");
let tipoDocumento = document.getElementById("seleccionTipoDocumento");
let idVeterinario = document.getElementById("idVeterinario");
let btnRegistrar = document.getElementById("registrarVeterinario");
let tablaVeterinarios = document.querySelector("#tablaVeterinarios tbody");
let btnEliminar = document.getElementById("btnEliminar");
btnRegistrar.addEventListener("click", verificarCampos);
tablaVeterinarios.addEventListener("click", obtenerVeterinario);
btnEliminar.addEventListener("click", eliminarVeterinario);

const peticiones = new EasyHTTP();
let veterinarioEliminar;
let datos = [];

function verificarCampos() {
  if (nombreVeterinario.value == "") {
    setErrorMessage(
      nombreVeterinario,
      "Debe de ingresar el nombre del veterinario"
    );
  } else {
    unsetErrorMessage(nombreVeterinario);
  }

  if (tipoDocumento.options[tipoDocumento.selectedIndex].value == "0") {
    setErrorMessage(tipoDocumento, "Debe de seleccionar el tipo de documento");
  } else {
    unsetErrorMessage(tipoDocumento);
  }

  if (idVeterinario.value == "") {
    setErrorMessage(idVeterinario, "Debe de ingresar el número de documento");
  } else {
    unsetErrorMessage(idVeterinario);
  }

  if (
    nombreVeterinario.value != "" &&
    tipoDocumento.options[tipoDocumento.selectedIndex].value != "0" &&
    idVeterinario.value != ""
  ) {
    let objAux = {
      id: idVeterinario.value,
      nombre: nombreVeterinario.value,
      tipoDocumento: tipoDocumento.options[tipoDocumento.selectedIndex].value
    };

    peticiones
      .post(
        "http://localhost/veterinaria_mvc/Veterinarios/registrarVeterinario",
        objAux
      )
      .then(resp => {
        if (resp.resp == 1) {
          traerVeterinarios();
          mostrarAlerta("success", "Veterinario registrado con éxito");
          nombreVeterinario.value = "";
          tipoDocumento.value = 0;
          idVeterinario.value = "";
        } else {
          mostrarAlerta(
            "danger",
            "Este veterinario ya ha sido registrado antes"
          );
        }
      })
      .catch(e => console.log(e));
  }
}

function traerVeterinarios() {
  peticiones
    .get("http://localhost/veterinaria_mvc/Veterinarios/obtenerVeterinarios")
    .then(resp => llenarTabla(resp))
    .catch(e => console.log(e));
}

function llenarTabla(veterinarios) {
  let output = "";
  veterinarios.forEach(veterinario => {
    output += ` <tr>
          <th scope="row"></th>
          <td>${veterinario.NOMBRE}</td>
          <td>${veterinario.TIPODOCUMENTO}</td>
          <td>${veterinario.ID}</td>
          <td class="d-flex justify-content-start">
          <button class="btn btn-danger p-1">
            <i class="fal fa-trash-alt"></i>
          </button>
        </td>
          </tr>`;
  });
  tablaVeterinarios.innerHTML = output;
  enumerarVeterinarios();
}

function mostrarAlerta(alerta, msg) {
  let alert = `<div class="col">
       <div class="alert alert-${alerta} text-center" role="alert">
         <strong class="text-${alerta}">${msg}</strong>
       </div>
     </div>`;

  alerta = document.querySelector(".alerta");
  alerta.innerHTML = alert;

  setTimeout(() => {
    alerta.innerHTML = "";
  }, 1500);
}

function obtenerVeterinario(e) {
  if (e.target.parentElement.classList.contains("btn-danger")) {
    veterinarioEliminar = e.target.parentElement.parentElement.parentElement;
    ventanaBorrarVeterinario();
  } else if (e.target.parentElement.classList.contains("d-flex")) {
    veterinarioEliminar = e.target.parentElement.parentElement;
    ventanaBorrarVeterinario();
  }
}

function ventanaBorrarVeterinario() {
  datos[0] = Array.from(veterinarioEliminar.children)[1].textContent;
  datos[1] = Array.from(veterinarioEliminar.children)[2].textContent;
  datos[2] = Array.from(veterinarioEliminar.children)[3].textContent;

  document.getElementById(
    "mensaje"
  ).innerHTML = `¿Estas seguro de eliminar el veterinario
  <strong>${datos[0]}</strong> con ${datos[1]} <strong>${datos[2]}</strong>?`;
  $("#exampleModalCenter").modal({ backdrop: "static", keyboard: false });
}

function enumerarVeterinarios() {
  let c = 1;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    tr.children[0].textContent = c;
    c++;
  });
}

function eliminarVeterinario() {
  peticiones
    .delete(
      `http://localhost/veterinaria_mvc/Veterinarios/eliminarVeterinario/${
        datos[2]
      }`
    )
    .then(resp => {
      if (resp.resp == 1) {
        traerVeterinarios();
        mostrarAlerta("warning", "Veterinario eliminado.");
      }
    })
    .catch(e => console.log(e));
}

function setErrorMessage(input, msg) {
  input.className = "form-control is-invalid";
  input.nextElementSibling.textContent = msg;
}

function unsetErrorMessage(input) {
  input.className = "form-control";
  input.nextElementSibling.textContent = "";
}

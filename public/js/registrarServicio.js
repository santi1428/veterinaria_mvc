window.addEventListener("load", traerServicios);

let nombreServicio = document.getElementById("nombreServicio");
let valorServicio = document.getElementById("valorServicio");
let anadirServicio = document.getElementById("anadirServicio");
let tablaServicios = document.querySelector("#tablaServicios tbody");
let btnEliminar = document.getElementById("btnEliminar");
anadirServicio.addEventListener("click", verificarCampos);
btnEliminar.addEventListener("click", eliminarServicio);
tablaServicios.addEventListener("click", obtenerServicio);

let servicioEliminar;
let datos = [];

const peticiones = new EasyHTTP();

function verificarCampos() {
  if (nombreServicio.value == "") {
    setErrorMessage(nombreServicio, "Debe de ingresar un nombre");
  } else {
    unsetErrorMessage(nombreServicio);
  }

  if (valorServicio.value == "") {
    setErrorMessage(valorServicio, "Debe de ingresar el costo del servicio");
  } else {
    unsetErrorMessage(valorServicio);
  }

  if (nombreServicio.value != "" && valorServicio.value != "") {
    let objServicio = {
      nombre: nombreServicio.value,
      valor: valorServicio.value
    };

    peticiones
      .post(
        "http://localhost/veterinaria_mvc/Servicios/anadirServicio",
        objServicio
      )
      .then(resp => {
        if (resp.resp == 1) {
          traerServicios();
          mostrarAlerta("success", "Servicio registrado con éxito.");
        } else {
          mostrarAlerta("danger", "El servicio ya se ha registrado antes.");
        }
      })
      .catch(e => console.log(e));
  }
}

function traerServicios() {
  peticiones
    .get("http://localhost/veterinaria_mvc/Servicios/servicios")
    .then(resp => llenarTabla(resp))
    .catch(e => console.log(e));
}

function llenarTabla(servicios) {
  let output = "";
  servicios.forEach(servicio => {
    output += ` <tr>
        <th scope="row"></th>
        <td>${servicio.CODIGO}</td>
        <td>${servicio.TIPO}</td>
        <td><i class="fal fa-dollar-sign"></i> ${servicio.VALOR}</td>
        <td class="d-flex justify-content-start">
        <button class="btn btn-danger p-1">
          <i class="fal fa-trash-alt"></i>
        </button>
      </td>
        </tr>`;
  });
  tablaServicios.innerHTML = output;
  enumerarMascotas();
}

function enumerarMascotas() {
  let c = 1;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    tr.children[0].textContent = c;
    c++;
  });
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

function ventanaBorrarMascota() {
  datos[0] = Array.from(servicioEliminar.children)[1].textContent;
  datos[1] = Array.from(servicioEliminar.children)[2].textContent;

  document.getElementById(
    "mensaje"
  ).innerHTML = `¿Estas seguro de eliminar el servicio de <strong>${
    datos[1]
  }</strong>?`;
  $("#exampleModalCenter").modal({ backdrop: "static", keyboard: false });
}

function obtenerServicio(e) {
  if (e.target.parentElement.classList.contains("btn-danger")) {
    servicioEliminar = e.target.parentElement.parentElement.parentElement;
    ventanaBorrarMascota();
  } else if (e.target.parentElement.classList.contains("d-flex")) {
    servicioEliminar = e.target.parentElement.parentElement;
    ventanaBorrarMascota();
  }
}

function eliminarServicio() {
  peticiones
    .delete(
      `http://localhost/veterinaria_mvc/Servicios/eliminarServicio/${datos[0]}`
    )
    .then(resp => {
      if (resp.resp == 1) {
        traerServicios();
        mostrarAlerta("warning", "Servicio eliminado.");
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

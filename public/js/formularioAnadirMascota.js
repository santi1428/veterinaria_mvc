let cliente = document.getElementById("seleccionClientes");
cliente.addEventListener("change", traerMascotas);

let tablaMascotas = document.querySelector("#tablaMascotas tbody");
tablaMascotas.addEventListener("click", obtenerMascota);

document
  .getElementById("btnEliminar")
  .addEventListener("click", eliminarMascota);

document
  .getElementById("anadirMascota")
  .addEventListener("click", agregarMascota);

document.getElementById("anadirMascota").disabled = true;

let nombreMascota = document.getElementById("nombreMascota");
let razaMascota = document.getElementById("razaMascota");
let edadMascota = document.getElementById("edadMascota");

let datos = [];
let mascotaEliminar;

const peticiones = new EasyHTTP();

function traerMascotas() {
  tablaMascotas.innerHTML = "";
  clienteId = cliente.options[cliente.selectedIndex].value;
  if (clienteId != 0) {
    peticiones
      .get(`http://191.232.246.84/clientes/mascotas/${clienteId}`)
      .then(mascotas => llenarTabla(mascotas))
      .catch(e => console.log(e));
    document.getElementById("anadirMascota").disabled = false;
  } else {
    tablaMascotas.innerHTML = "";
    document.getElementById("anadirMascota").disabled = true;
  }
}

function llenarTabla(mascotas) {
  let output = "";
  mascotas.forEach(mascota => {
    output += ` <tr>
        <th scope="row"></th>
        <td><input type="hidden" id="hidden" value="${mascota.ID}"><span>${
      mascota.NOMBRE
    }</span></td>
        <td>${mascota.RAZA}</td>
        <td>${mascota.EDAD}</td>
        <td class="d-flex justify-content-start">
        <button class="btn btn-danger p-1">
          <i class="fal fa-trash-alt"></i>
        </button>
      </td>
        </tr>`;
  });
  tablaMascotas.innerHTML = output;
  enumerarMascotas();
}

function obtenerMascota(e) {
  if (e.target.parentElement.classList.contains("btn-danger")) {
    mascotaEliminar = e.target.parentElement.parentElement.parentElement;
    ventanaBorrarMascota();
  } else if (e.target.parentElement.classList.contains("d-flex")) {
    mascotaEliminar = e.target.parentElement.parentElement;
    ventanaBorrarMascota();
  }
}

function ventanaBorrarMascota() {
  let objAux = { id: null, nombre: null };
  Array.from(mascotaEliminar.children).forEach((dato, index) => {
    if (index < 4) {
      if (index != 1) {
        datos[index] = dato.textContent;
      } else {
        objAux.id = Array.from(dato.children)[0].value;
        objAux.nombre = Array.from(dato.children)[1].textContent;
        datos[index] = objAux;
      }
    }
  });

  document.querySelector(
    ".text-justify"
  ).innerHTML = `¿Estas seguro de eliminar la mascota <strong>${
    datos[1].nombre
  }</strong> de
              raza <strong>${datos[2]}</strong> con <strong>${
    datos[3]
  }</strong> años del cliente ${cliente.options[cliente.selectedIndex].text}?
              `;

  $("#exampleModalCenter").modal({ backdrop: "static", keyboard: false });
}

function eliminarMascota() {
  peticiones
    .delete(`http://191.232.246.84/clientes/mascotas/${datos[1].id}`)
    .then(resp => {
      if (resp.resp == 1) {
        mascotaEliminar.remove();
        enumerarMascotas();
        mostrarAlerta("warning", "Mascota eliminada.");
      }
    })
    .catch(e => console.log(e));
}

function agregarMascota() {
  if (nombreMascota.value == "") {
    setErrorMessage(nombreMascota, "Debe de ingresar el nombre de la mascota");
  } else {
    unsetErrorMessage(nombreMascota);
  }

  if (
    razaMascota.options[razaMascota.selectedIndex].text == "Seleccione la raza"
  ) {
    setErrorMessage(razaMascota, "Debe de seleccionar la raza de la mascota");
  } else {
    unsetErrorMessage(razaMascota);
  }

  if (edadMascota.value == "") {
    setErrorMessage(edadMascota, "Debe de ingresar la edad de la mascota");
  } else if (edadMascota.value > 100) {
    setErrorMessage(edadMascota, "La edad debe ser menor a 100");
  } else {
    unsetErrorMessage(edadMascota);
  }

  if (
    nombreMascota.value != "" &&
    razaMascota.options[razaMascota.selectedIndex].value !=
      "Seleccione la raza" &&
    edadMascota.value != "" &&
    edadMascota.value < 100
  ) {
    let objMascota = {
      clienteId: cliente.options[cliente.selectedIndex].value,
      nombre: nombreMascota.value,
      raza: razaMascota.options[razaMascota.selectedIndex].value,
      edad: edadMascota.value
    };

    peticiones
      .post(
        "http://191.232.246.84/clientes/anadirMascota",
        objMascota
      )
      .then(resp => {
        if (resp.resp == 1) {
          traerMascotas();
          mostrarAlerta("success", "Mascota registrada.");
          nombreMascota.value = "";
          razaMascota.value = "Seleccione la raza";
          edadMascota.value = "";
        } else {
          mostrarAlerta(
            "danger",
            "La mascota ya esta registrada para este cliente. No se puede registrar."
          );
        }
      })
      .catch(e => console.log(e));
  }
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

function enumerarMascotas() {
  let c = 1;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    tr.children[0].textContent = c;
    c++;
  });
}

function setErrorMessage(input, msg) {
  input.className = "form-control is-invalid";
  input.nextElementSibling.textContent = msg;
}

function unsetErrorMessage(input) {
  input.className = "form-control";
  input.nextElementSibling.textContent = "";
}

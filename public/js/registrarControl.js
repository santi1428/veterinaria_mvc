const peticiones = new EasyHTTP();
let seleccionCliente = document.getElementById("seleccionCliente");
let seleccionMascota = document.getElementById("seleccionMascota");
let btnRegistrarControl = document.getElementById("registrarControl");
let rdProximaFechaSel = document.getElementById("fechaProxima");
let proximaFechaSel = document.getElementById("proximaFechaInput");
proximaFechaSel.setAttribute("min", sumarDias(1));
let rdProximaFechaDias = document.getElementById("dias");
let proximaFechaDias = document.getElementById("numeroDias");
let btnAnadirServicio = document.getElementById("anadirServicio");
let servicio = document.getElementById("seleccionServicio");
let veterinario = document.getElementById("seleccionVeterinario");
let metodoPago = document.getElementById("seleccionMetodoPago");
let tablaServicios = document.querySelector("#tablaServicios tbody");
let tablaContenidoInicial = `<tr id="vacio">
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
</tr>`;
let servicios = [];
let valorTotal = 0;
btnRegistrarControl.disabled = true;
rdProximaFechaSel.disabled = true;
proximaFechaSel.disabled = true;
rdProximaFechaDias.disabled = true;
proximaFechaDias.disabled = true;
btnAnadirServicio.disabled = true;
proximaFechaDias.disabled = true;
proximaFechaSel.disabled = true;
servicio.disabled = true;
veterinario.disabled = true;
metodoPago.disabled = true;
btnRegistrarControl.addEventListener("click", registrarControl);
seleccionCliente.addEventListener("change", () => {
  if (seleccionCliente.options[seleccionCliente.selectedIndex].value == 0) {
    seleccionMascota.disabled = true;
    seleccionMascota.value = 0;
    comprobarCampos();
  } else {
    seleccionMascota.disabled = false;
    traerMascotas(
      seleccionCliente.options[seleccionCliente.selectedIndex].value
    ).then(() => comprobarCampos());
  }
  borrarCampos();
});
seleccionMascota.addEventListener("change", () => {
  comprobarCampos();
  borrarCampos();
});

rdProximaFechaSel.addEventListener("click", comprobarCampos);
rdProximaFechaDias.addEventListener("click", comprobarCampos);
btnAnadirServicio.addEventListener("click", anadirServicio);
tablaServicios.addEventListener("click", eliminarServicio);

function comprobarCampos() {
  if (
    seleccionMascota.value != 0 &&
    seleccionCliente.options[seleccionCliente.selectedIndex].value != 0
  ) {
    rdProximaFechaSel.disabled = false;
    rdProximaFechaDias.disabled = false;
    btnAnadirServicio.disabled = false;
    servicio.disabled = false;
    veterinario.disabled = false;
    metodoPago.disabled = false;
  } else {
    btnRegistrarControl.disabled = true;
    rdProximaFechaSel.disabled = true;
    proximaFechaSel.disabled = true;
    rdProximaFechaDias.disabled = true;
    proximaFechaDias.disabled = true;
    btnAnadirServicio.disabled = true;
    servicio.disabled = true;
    veterinario.disabled = true;
    metodoPago.disabled = true;
  }

  if (
    rdProximaFechaSel.disabled == false &&
    rdProximaFechaDias.disabled == false
  ) {
    if (rdProximaFechaSel.checked == true) {
      proximaFechaSel.disabled = false;
      proximaFechaDias.disabled = true;
    } else if (rdProximaFechaDias.checked == true) {
      proximaFechaDias.disabled = false;
      proximaFechaSel.disabled = true;
    }
  }
}

function borrarCampos() {
  btnRegistrarControl.disabled = true;
  servicio.value = 0;
  veterinario.value = 0;
  metodoPago.value = 0;
  rdProximaFechaSel.checked = false;
  rdProximaFechaDias.checked = false;
  proximaFechaSel.value = "";
  proximaFechaDias.value = "";
  tablaServicios.innerHTML = tablaContenidoInicial;
  servicios = [];
}

function traerMascotas(id) {
  return new Promise(resolve => {
    peticiones
      .get(`http://localhost/veterinaria_mvc/clientes/mascotas/${id}`)
      .then(mascotas => resolve(llenarSeleccionMascota(mascotas)))
      .catch(e => console.log(e));
  });
}

function llenarSeleccionMascota(mascotas) {
  if (mascotas.length === 0) {
    let output = `<option value="0" selected
    >No hay mascotas
  </option>`;
    seleccionMascota.innerHTML = output;
    seleccionMascota.disabled = true;
  } else {
    let output = `<option value="0" selected
  >Seleccione la mascota del cliente
</option>`;
    mascotas.forEach(mascota => {
      output += `<option value = "${mascota.ID}">${mascota.NOMBRE} - ${
        mascota.RAZA
      } - ${mascota.EDAD} años`;
    });
    seleccionMascota.innerHTML = output;
  }
}

function anadirServicio() {
  if (servicio.value == 0) {
    setErrorMessage(servicio, "Debe de seleccionar el servicio prestado");
  } else {
    unsetErrorMessage(servicio);
  }

  if (veterinario.value == 0) {
    setErrorMessage(veterinario, "Debe de seleccionar el veterinario");
  } else {
    unsetErrorMessage(veterinario);
  }
  let objAux;
  if (servicio.value != 0 && veterinario.value != 0) {
    if (document.querySelector("table tbody #vacio") !== null) {
      objAux = {
        codigoServicio: servicio.options[servicio.selectedIndex].value,
        idVeterinario: veterinario.options[veterinario.selectedIndex].value
      };
      servicios.push(objAux);
      tablaServicios.innerHTML = ` <tr class="total bg-info">
      <td></td>
      <td><i class="fas fa-dollar-sign"></i> <strong>Total</strong></td>
      <td><strong>0</strong> <i class="fas fa-dollar-sign"></i></td>
      <td></td>
      <td></td>
    </tr>`;
      insertarServicio(
        servicio.options[servicio.selectedIndex].text.split(" - ")[0],
        servicio.options[servicio.selectedIndex].text.split(" - ")[1],
        veterinario.options[veterinario.selectedIndex].text.split(" - ")[0],
        veterinario.options[veterinario.selectedIndex].text.split(" - ")[2],
        servicio.options[servicio.selectedIndex].value
      );
      enumerarServicios();
      calcularTotal();
      borrarCamposServicio();
    } else {
      if (
        comprobarServicio(
          servicio.options[servicio.selectedIndex].text.split(" - ")[0]
        ) !== true
      ) {
        objAux = {
          codigoServicio: servicio.options[servicio.selectedIndex].value,
          idVeterinario: veterinario.options[veterinario.selectedIndex].value
        };
        servicios.push(objAux);
        insertarServicio(
          servicio.options[servicio.selectedIndex].text.split(" - ")[0],
          servicio.options[servicio.selectedIndex].text.split(" - ")[1],
          veterinario.options[veterinario.selectedIndex].text.split(" - ")[0],
          veterinario.options[veterinario.selectedIndex].text.split(" - ")[2],
          servicio.options[servicio.selectedIndex].value
        );
        enumerarServicios();
        calcularTotal();
        borrarCamposServicio();
      } else {
        mostrarAlerta("danger", "El servicio ya esta ingresado en la tabla");
      }
    }
  }
}

function borrarCamposServicio() {
  servicio.value = 0;
  veterinario.value = 0;
}

function comprobarServicio(servicioComprobar) {
  let c = 0;
  Array.from(tablaServicios.children).forEach(servicio => {
    if (Array.from(servicio.children)[1].textContent == servicioComprobar) {
      c++;
    }
  });
  return c > 0;
}

function insertarServicio(
  nombreServicio,
  valorServicio,
  nombreVeterinario,
  idVeterinario,
  idServicio
) {
  let row = document.createElement("tr");
  row.innerHTML = `<th scope="row"></th>
  <td><input type = "hidden" value = "${idServicio}" /><span>${nombreServicio}</span></td>
  <td><span>${valorServicio.replace("$", "")}</span><span>$</span></td>
  <td>${nombreVeterinario} - ${idVeterinario}</td>
  <td class="d-flex justify-content-start">
  <button class="btn btn-danger p-1">
    <i class="fal fa-trash-alt"></i>
  </button>
</td>`;
  let total = document.querySelector(".total");
  tablaServicios.insertBefore(row, total);
  mostrarAlerta("success", "Servicio añadido");
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

function enumerarServicios() {
  let c = 1;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    if (tr.classList.contains("total") == false) {
      tr.children[0].textContent = c;
    }
    c++;
  });
}

function calcularTotal() {
  let ac = 0;
  document.querySelectorAll(".table tbody tr").forEach(tr => {
    if (tr.classList.contains("total") == false) {
      ac = ac + parseInt(tr.children[2].children[0].textContent);
    } else {
      tr.children[2].children[0].textContent = ac;
      if (tr.children[2].children[0].textContent == 0) {
        btnRegistrarControl.disabled = true;
        tablaServicios.innerHTML = tablaContenidoInicial;
      } else {
        btnRegistrarControl.disabled = false;
        valorTotal = parseInt(tr.children[2].children[0].textContent);
      }
    }
  });
}

function eliminarServicio(e) {
  if (e.target.parentElement.classList.contains("btn-danger")) {
    let servicioEliminado =
      e.target.parentElement.parentElement.parentElement.children[1].children[0]
        .value;
    eliminarServicioDelArreglo(servicioEliminado);
    e.target.parentElement.parentElement.parentElement.remove();
    enumerarServicios();
    calcularTotal();
  } else if (e.target.parentElement.classList.contains("d-flex")) {
    let servicioEliminado =
      e.target.parentElement.parentElement.children[1].children[0].value;
    eliminarServicioDelArreglo(servicioEliminado);
    e.target.parentElement.parentElement.remove();
    enumerarServicios();
    calcularTotal();
  }
}

function eliminarServicioDelArreglo(servicioEliminado) {
  servicios.forEach((servicio, index) => {
    if (servicio.codigoServicio == servicioEliminado) {
      servicios.splice(index, 1);
    }
  });
}

function registrarControl() {
  if (metodoPago.value != 0) {
    unsetErrorMessage(metodoPago);
  } else {
    setErrorMessage(metodoPago, "Debe de seleccionar el metodo de pago.");
  }

  if (rdProximaFechaSel.checked == true) {
    if (proximaFechaSel.value !== "") {
      unsetErrorMessage(proximaFechaSel);
      recolectarDatos(proximaFechaSel.value);
    } else {
      setErrorMessage(proximaFechaSel, "Debe de seleccionar la fecha");
      mostrarAlertaError();
    }
  } else {
    unsetErrorMessage(proximaFechaSel);
    if (rdProximaFechaDias.checked == false) {
      mostrarAlertaError();
    }
  }
  if (rdProximaFechaDias.checked == true) {
    if (proximaFechaDias.value !== "" && proximaFechaDias.value > 0) {
      proximaFechaDias.className = "form-control text-center";
      recolectarDatos(parseInt(proximaFechaDias.value));
    } else {
      proximaFechaDias.className = "form-control text-center border-danger";
      mostrarAlertaError();
    }
  } else {
    proximaFechaDias.className = "form-control text-center";
    if (rdProximaFechaSel.checked == false) {
      mostrarAlertaError();
    }
  }
}

function recolectarDatos(fecha) {
  let objDatos = {
    idCliente: null,
    mascota: null,
    metodoPago: null,
    fechaActual: null,
    fechaProxima: null,
    serviciosEnvio: null,
    valorTotal: null
  };
  if (metodoPago.value != 0) {
    if (typeof fecha == "string") {
      objDatos.fechaProxima = fecha;
    } else {
      objDatos.fechaProxima = sumarDias(fecha);
    }
    objDatos.idCliente = seleccionCliente.value;
    objDatos.mascota = seleccionMascota.value;
    objDatos.metodoPago = metodoPago.options[metodoPago.selectedIndex].text;
    objDatos.fechaActual = sumarDias(0);
    objDatos.serviciosEnvio = servicios;
    objDatos.valorTotal = valorTotal;
    console.log(objDatos);
  }
}

function mostrarAlertaError() {
  let alert = `<div class="col">
       <div class="alert alert-danger text-center" role="alert">
         <strong class="text-danger">Debes de asignar la fecha del control y que sea válida.</strong>
       </div>
     </div>`;

  alerta = document.querySelector(".alertaError");
  alerta.innerHTML = alert;

  setTimeout(() => {
    alerta.innerHTML = "";
  }, 1500);
}

function sumarDias(dias) {
  var fecha = new Date();
  fecha.setDate(fecha.getDate() + dias);
  var dd = fecha.getDate();
  var mm = fecha.getMonth() + 1;
  var yyyy = fecha.getFullYear();
  if (dd < 10) {
    dd = "0" + dd;
  }
  if (mm < 10) {
    mm = "0" + mm;
  }
  var fecha = `${yyyy}-${mm}-${dd}`;
  return fecha;
}

function setErrorMessage(input, msg) {
  input.className = "form-control is-invalid";
  input.nextElementSibling.textContent = msg;
}

function unsetErrorMessage(input) {
  input.className = "form-control";
  input.nextElementSibling.textContent = "";
}

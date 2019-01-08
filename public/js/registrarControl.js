const peticiones = new EasyHTTP();
let seleccionCliente = document.getElementById("seleccionCliente");
let seleccionMascota = document.getElementById("seleccionMascota");
let btnRegistrarControl = document.getElementById("registrarControl");
let rdProximaFechaSel = document.getElementById("fechaProxima");
let proximaFechaSel = document.getElementById("proximaFechaInput");
let rdProximaFechaDias = document.getElementById("dias");
let proximaFechaDias = document.getElementById("numeroDias");
let btnAnadirServicio = document.getElementById("anadirServicio");
let servicio = document.getElementById("seleccionServicio");
let veterinario = document.getElementById("seleccionVeterinario");
let metodoPago = document.getElementById("seleccionMetodoPago");
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

function comprobarCampos() {
  if (
    seleccionMascota.value != 0 &&
    seleccionCliente.options[seleccionCliente.selectedIndex].value != 0
  ) {
    btnRegistrarControl.disabled = false;
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
  servicio.value = 0;
  veterinario.value = 0;
  metodoPago.value = 0;
  rdProximaFechaSel.checked = false;
  rdProximaFechaDias.checked = false;
  proximaFechaSel.value = "";
  proximaFechaDias.value = "";
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

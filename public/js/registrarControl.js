let seleccionCliente = document.getElementById("seleccionCliente");
let seleccionMascota = document.getElementById("seleccionMascota");
seleccionCliente.addEventListener("change", () => {
  if (seleccionCliente.options[seleccionCliente.selectedIndex].value == 0) {
    seleccionMascota.disabled = true;
    seleccionMascota.value = 0;
  } else {
    seleccionMascota.disabled = false;
    traerMascotas(
      seleccionCliente.options[seleccionCliente.selectedIndex].value
    );
  }
});

const peticiones = new EasyHTTP();

function traerMascotas(id) {
  peticiones
    .get(`http://localhost/veterinaria_mvc/clientes/mascotas/${id}`)
    .then(mascotas => llenarSeleccionMascota(mascotas))
    .catch(e => console.log(e));
}

function llenarSeleccionMascota(mascotas) {
  if (mascotas.length === 0) {
    seleccionMascota.options[seleccionMascota.selectedIndex].text =
      "No hay mascotas";
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

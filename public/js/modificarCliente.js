const peticiones = new EasyHTTP();
const table = document.querySelector("table tbody");
window.addEventListener("load", () => {
  traerClientes();
  obtenerNumeroMascotas();
});
let clientes = [];
let busqueda = document.getElementById("busqueda");
busqueda.addEventListener("keyup", buscar);
function traerClientes() {
  peticiones
    .get("http://191.232.246.84/clientes/obtenerClientesConMascotas")
    .then(resp => {
      clientes = resp;
      llenarTabla(resp);
    });
}

function obtenerNumeroMascotas() {
  peticiones
    .get("http://191.232.246.84/clientes/obtenerNumeroMascotas")
    .then(
      resp =>
        (document.querySelector(".badge-primary").innerHTML =
          resp.numero.NUMEROTOTALMASCOTAS)
    );
}

function llenarTabla(clientes) {
  let output = "";
  clientes.forEach(cliente => {
    output += `<tr>
    <td>${cliente.NOMBRE}</td>
    <td>${cliente.TIPODOCUMENTO}</td>
    <td>${cliente.ID}</td>
    <td><span class="badge badge-success p-1">${
      cliente.NUMEROMASCOTAS
    }</span></td>
    <td>
      <button class="btn btn-danger p-1 ml-2">
        <i class="fal fa-trash-alt"></i>
      </button>
    </td>
  </tr>`;
  });
  table.innerHTML = output;
}

function buscar() {
  let clientesLlenarTabla = [];
  if (clientes.length !== 0) {
    if (/\ *?[a-zA-Z]{1,}\ *?/.test(busqueda.value)) {
      let nombre = busqueda.value.toLowerCase();
      nombre = nombre.replace(/\ +/g, "");
      let reg = new RegExp(`${nombre}`, "i");
      clientes.forEach(cliente => {
        let nombreCliente = cliente.NOMBRE;
        nombreCliente = nombreCliente.replace(/\ +/g, "");
        if (reg.test(nombreCliente)) {
          clientesLlenarTabla.push(cliente);
        }
      });
      llenarTabla(clientesLlenarTabla);
    } else if (/\ *?[1-9]{1,}\ *?/.test(busqueda.value)) {
      let numero = busqueda.value;
      numero = numero.replace(/\ +/g, "");
      let reg = new RegExp(`${numero}`, "i");
      clientes.forEach(cliente => {
        let idCliente = cliente.ID;
        idCliente = idCliente.replace(/\ +/g, "");
        if (reg.test(idCliente)) {
          clientesLlenarTabla.push(cliente);
        }
      });
      llenarTabla(clientesLlenarTabla);
    } else {
      llenarTabla(clientes);
    }
  }
}

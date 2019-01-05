let nombreVeterinario = document.getElementById("nombreVeterinario");
let tipoDocumento = document.getElementById("seleccionTipoDocumento");
let idVeterinario = document.getElementById("idVeterinario");
let btnRegistrar = document.getElementById("registrarVeterinario");
let tablaVeterinarios = document.querySelector("#tablaVeterinarios tbody");
// let btnEliminar = document.getElementById("btnEliminar");
btnRegistrar.addEventListener("click", verificarCampos);

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
    console.log("fue un exito");
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

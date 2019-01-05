const formularioRegistro = document.getElementById("formularioRegistro");
const usuarioRegistro = document.getElementById("usuarioRegistro");
const nombreRegistro = document.getElementById("nombreRegistro");
const contrasenaRegistro = document.getElementById("contrasenaRegistro");
const concontrasenaRegistro = document.getElementById("concontrasenaRegistro");
const terminos = document.getElementById("terminos");

formularioRegistro.addEventListener("submit", verificarCamposRegistro);
function verificarCamposRegistro(e) {
  e.preventDefault();

  usuarioRegistro.addEventListener("keyup", verificarUsuario);
  nombreRegistro.addEventListener("keyup", verificarNombre);
  contrasenaRegistro.addEventListener("keyup", verificarContrasena);
  concontrasenaRegistro.addEventListener("keyup", verificarconContrasena);

  verificarUsuario();
  verificarNombre();
  verificarContrasena();
  verificarconContrasena();
  verificarTerminos();

  if (
    verificarUsuario() === true &&
    verificarNombre() === true &&
    verificarContrasena() === true &&
    verificarconContrasena() === true &&
    verificarTerminos() === true
  ) {
    formularioRegistro.submit();
  }
}

function verificarTerminos() {
  if (terminos.checked) {
    return true;
  } else {
    let alerta = document.createElement("div");
    alerta.className = "alert alert-danger text-center mt-0";
    alerta.setAttribute("role", "alert");
    alerta.textContent = "Debes de aceptar los términos y condiciones";
    document.querySelector(".col-xl-4").appendChild(alerta);
    setTimeout(() => {
      alerta.remove();
    }, 2250);
  }
}

function verificarUsuario() {
  if (usuarioRegistro.value === "") {
    mostrarMensajeError(usuarioRegistro, "Por favor escriba su usuario");
    return false;
  } else {
    quitarMensajeError(usuarioRegistro);
    return true;
  }
}

function verificarNombre() {
  if (nombreRegistro.value === "") {
    mostrarMensajeError(nombreRegistro, "Por favor escriba su nombre");
    return false;
  } else {
    quitarMensajeError(nombreRegistro);
    return true;
  }
}

function verificarContrasena() {
  if (contrasenaRegistro.value === "") {
    mostrarMensajeError(contrasenaRegistro, "Por favor escriba su contraseña");
    return false;
  } else if (contrasenaRegistro.value.length < 6) {
    mostrarMensajeError(
      contrasenaRegistro,
      "Su contraseña debe de tener minimo 6 carácteres"
    );
    return false;
  } else {
    quitarMensajeError(contrasenaRegistro);
    return true;
  }
}

function verificarconContrasena() {
  if (concontrasenaRegistro.value === "") {
    mostrarMensajeError(
      concontrasenaRegistro,
      "Por favor confirma tu contraseña"
    );
    return false;
  } else if (concontrasenaRegistro.value !== contrasenaRegistro.value) {
    mostrarMensajeError(concontrasenaRegistro, "Las contraseñas no coinciden");
    return false;
  } else {
    quitarMensajeError(concontrasenaRegistro);
    return true;
  }
}

function mostrarMensajeError(input, msg) {
  input.className = "form-control is-invalid border-danger";
  input.nextElementSibling.textContent = msg;
}

function quitarMensajeError(input) {
  input.className = " form-control border-primary";
  input.nextElementSibling.textContent = "";
}

if (document.getElementById("formularioRegistro") !== null) {
  document.querySelector("#link-registro").addEventListener("click", () => {
    document.getElementById("dropdownMenuButton").focus();
  });
}

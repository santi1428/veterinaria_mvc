const formularioLogin = document.getElementById("formularioLogin");
const usuarioLogin = document.getElementById("usuarioLogin");
const contrasenaLogin = document.getElementById("contrasenaLogin");
const botonLogin = document.getElementById("botonLogin");
if (formularioLogin !== null) {
  formularioLogin.addEventListener("keyup", verificarCamposLogin);
}
function verificarCamposLogin(e) {
  if (usuarioLogin.value !== "" && contrasenaLogin.value !== "") {
    botonLogin.disabled = false;
  } else {
    botonLogin.disabled = true;
  }
}

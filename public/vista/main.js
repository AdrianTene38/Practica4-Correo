var banCedula = false;
var banNombre = false;
var banApellido = false;
var banTelefono = false;
var banDir = false;

var banCorreo = false;
var banPasword = false;

function validarCamposObligatorios() {
  var bandera = true;
  
  banDir = false;
  for (var i = 0; i < document.forms[0].elements.length; i++) {
    var elemento = document.forms[0].elements[i];
    if (elemento.value == "" && elemento.type == "text") {
      if (elemento.id == "cedula") {
        document.getElementById("mensajeCedula").innerHTML =
          "<br>La cedula no esta bien ingresada";
      }
      if (elemento.id == "nombre") {
        document.getElementById("mensajeNombre").innerHTML =
          "<br>El nombre esta mal ingresado";
      }
      if (elemento.id == "apellido") {
        document.getElementById("mensajeApellido").innerHTML =
          "<br>El Apellido esta mal ingresado";
      }
      if (elemento.id == "direccion") {
        document.getElementById("mensajeDireccion").innerHTML =
          "<br>La direccion esta mal ingresado";
      }
      if (elemento.id == "telefono") {
        document.getElementById("mensajeTelefono").innerHTML =
          "<br>El telefono esta mal ingresadi=o";
      }
      elemento.style.border = "2px red solid";
      elemento.className = "error";
      bandera = false;
    } else {
      if (elemento.id == "direccion") {
        document.getElementById("mensajeDireccion").innerHTML = "";
        banDir = true;
      }
      if (elemento.id == "telefono") {
        document.getElementById("mensajeTelefono").innerHTML = "";
        banTelefono = true;
      }
    }
    if (elemento.value == "" && elemento.type == "password") {
      elemento.style.border = "2px red solid";
      elemento.className = "error";
      bandera = false;
    }
  }
  if (!bandera) {
    alert("Falta datos");
    return bandera;
  }
}

function validarCedula() {
  banCedula = false;
  var elemento = document.getElementById("cedula");
  var vect = [];
  if (elemento.value.length == 10) {
    for (var i = 0; i < elemento.value.length; i++) {
      vect[i] = parseInt(elemento.value.charAt(i));
    }
    if (vect[2] <= 6 && vect[2] >= 0) {
      var comprobar = [2, 1, 2, 1, 2, 1, 2, 1, 2];
      var suma = 0;
      for (i = 0; i < comprobar.length; i++) {
        vect[i] *= comprobar[i];
        if (vect[i] >= 10) {
          vect[i] -= 9;
        }
        suma += vect[i];
      }
      suma += vect[i];
      suma %= 10;
      if (suma == 0) {
        banCedula = true;
        document.getElementById("mensajeCedula").innerHTML = "";
        activarBtn();
        return true;
      } else {
        banCedula = false;
        activarBtn();
        document.getElementById("mensajeCedula").innerHTML =
          "<br>Numero erroneo";
      }
    }
  } else {
    banCedula = false;
    activarBtn();
    document.getElementById("mensajeCedula").innerHTML =
      "<br>Numero de cedula incorrecto";
  }
  return false;
}

function validarNumero(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (!(charCode >= 48 && charCode <= 57)) {
    alert("Solo se permiten numeros.");
    return false;
  }
  return true;
}

function validarTexto(evt) {
  evt = evt ? evt : event;
  var charCode = evt.charCode
    ? evt.charCode
    : evt.keyCode
    ? evt.keyCode
    : evt.which
    ? evt.which
    : 0;
  if (
    charCode > 32 &&
    (charCode < 65 || charCode > 90) &&
    (charCode < 97 || charCode > 122)
  ) {
    alert("Ingrese solo letras.");
    return false;
  }
  return true;
}

function validarNombre() {
  banNombre = false;
  var elemento = document.getElementById("nombre");
  if (elemento.value.length > 2) {
    banNombre = true;
    document.getElementById("mensajeNombre").innerHTML = "";
    activarBtn();
    return true;
  } else {
    activarBtn();
    document.getElementById("mensajeNombre").innerHTML =
      "<br>Ingrese Un Nombre Correcto";
  }
  return false;
}

function validarApellido() {
  banApellido = false;
  var elemento = document.getElementById("apellido");
  if (elemento.value.length > 2) {
    banApellido = true;
    document.getElementById("mensajeApellido").innerHTML = "";
    activarBtn();
    return true;
  } else {
    activarBtn();
    document.getElementById("mensajeApellido").innerHTML =
      "<br>Ingrese un Apellido Valido";
  }
  return false;
}

function checkDate(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (!(charCode >= 47 && charCode <= 57)) {
    alert("Ingrese solo numeros.");
    return false;
  }
}

function validarCorreo() {
  banCorreo = false;  var elemento = document.getElementById("email");
  var correo = elemento.value.split("@");
  if (correo.length == 2) {
    if (correo[0].length < 3) {
      document.getElementById("mensajeEmail").innerHTML =
        "<br>Direccion no valido ateneg1@ups.edu.ec <br>Direccion no valido ateng1@est.ups.edu.ec";
      return false;
    }
    if (
      correo[1].localeCompare("est.ups.edu.ec") == "0" ||
      correo[1].localeCompare("ups.edu.ec") == "0"
    ) {
      document.getElementById("mensajeEmail").innerHTML = "";
    } else {
      document.getElementById("mensajeEmail").innerHTML =
        "<br>@ups.edu.ec <br> @est.ups.edu.ec";
      return false;
    }
  } else {
    document.getElementById("mensajeEmail").innerHTML =
      "<br>Direccion no valido ateneg1@ups.edu.ec <br>Direccion no valido ateneg1@est.ups.edu.ec";
    return false;
  }
  banCorreo = true;
  activarBtn();
  return true;
}

function validarPassword() {
  banPasword = false;
  var elemento = document.getElementById("password");
  if (elemento.value.length >= 8) {
    document.getElementById("mensajePassword").innerHTML = "";
    var banCaracter = false;
    var banMayus = false;
    var banMinus = false;
    for (var i = 0; i < elemento.value.length; i++) {
      var codigo = elemento.value.charCodeAt(i);
      if ((codigo == 95 || codigo == 64 || codigo == 36) && !banCaracter)
        banCaracter = true;
      else if (codigo > 64 && codigo < 91 && !banMayus) banMayus = true;
      else if (codigo > 96 && codigo < 123 && !banMinus) banMinus = true;
    }
    if (!banCaracter)
      document.getElementById("mensajePassword").innerHTML =
        "<br>Debe contener un caracter especial @ _ $";
    if (!banMayus)
      document.getElementById("mensajePassword").innerHTML =
        "<br>Debe contener una Mayuscula";
    if (!banMinus)
      document.getElementById("mensajePassword").innerHTML =
        "<br>Debe contener una minuscula";
  } else {
    document.getElementById("mensajePassword").innerHTML =
      "<br>Contraseña debe tener minimo 8 caracteres";
    return false;
  }
  if (banCaracter && banMayus && banMinus) banPasword = true;
  activarBtn();
  return true;
}

function activarBtn() {
  if (
    banCedula &&
    banNombre &&
    banApellido &&
    banPasword &&
    banCorreo 
  ) {
    document.getElementById("btn").disabled = false;
    document.getElementById("btn").style.color = "rgb(255, 255, 255)";
    document.getElementById("btn").style.background = "#1883ba";
    document.getElementById("btn").style.border = "2px solid #0016b0";
    return false;
  } else {
    document.getElementById("btn").disabled = true;
    document.getElementById("btn").style.color = "rgb(83, 81, 81)";
    document.getElementById("btn").style.background = " rgb(170, 165, 165)";
    document.getElementById("btn").style.border = "2px solid #ffffff";
  }
}

function limpiar() {
  location.reload();
}

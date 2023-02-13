//para nombres y apellidos
function SoloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú";
    especiales = [8, 13];
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        alert("Ingrese su Numero Nombre");
        return false;
    }
}

//para ingresar solo numeros
function SoloNumeros(evt) {
    if (window.event) {
        keynum = evt.keyCode;
    }
    else {
        keynum = evt.which;
    }
    if ((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13) {
        return true;
    }
    else {
        alert("Ingrese su Numero Telefonico");
        return false;
    }
}
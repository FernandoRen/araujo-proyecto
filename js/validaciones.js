function validarEmail(email) {
    let emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (emailRegex.test(email)) {
        return true;
    } else {
        return false;
    }
}

function validarPassword(password) {
    let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    /*
        Minimo 8 caracteres
        Maximo 15
        Al menos una letra mayúscula
        Al menos una letra minucula
        Al menos un dígito
        No espacios en blanco
        Al menos 1 caracter especial
    */
    if (passRegex.test(password)) {
        return true;
    } else {
        return false;
    }
}

function validarFechas(fechaInicio, fechaFin) {
    let fechaStart_format = new Date(fechaInicio);
    let fechaEnd_format = new Date(fechaFin);
    if (fechaStart_format > fechaEnd_format) {
        return true;
    } else {
        return false;
    }
}

function validarFechasDiferentes(fechaInicio, fechaFin) {
    let fechaStart_format = new Date(fechaInicio);
    let fechaEnd_format = new Date(fechaFin);
    if (fechaStart_format.getTime() === fechaEnd_format.getTime()) {
        return true;
    } else {
        return false;
    }
}
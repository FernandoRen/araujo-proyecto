(() => {
    "use strict";
    //inputs
    let nombre = document.getElementById("nombre");
    let sueldo = document.getElementById("sueldo");
    let horasTrabajadas = document.getElementById("horasT");
    let rfc = document.getElementById("RFC");
    let numEmpleado = document.getElementById("No-Empleado");

    let formRegistro = $("#formulario-trabajador");

    //botones
    let botonEnviar = document.getElementById("boton-trabajador");

    document.addEventListener("DOMContentLoaded", function() {



        botonEnviar.addEventListener("click", registrarTrabajador);

        function registrarTrabajador(e) {
            e.preventDefault();
            if (nombre.value === "") {
                Swal.fire("Error", "Error, por favor ingrese un nombre", "error");
            } else if (validarNombre(nombre.value).resp === false) {
                Swal.fire("Error", validarNombre(nombre.value).error, "error");
            } else if (sueldo.value == "") {
                Swal.fire("Error", "Error, por favor ingrese un sueldo", "error");
            } else if (isNaN(sueldo.value)) {
                Swal.fire("Error", "Error, ingrese el salario en formato númerico por favor", "error");
            } else if (sueldo.value < 5186.10 || sueldo.value > 36302.70) {
                Swal.fire("Error", "Error, el sueldo ingresado no es válido, el sueldo debe de ser mayor a $5,186.10 y menor a $36,302.70", "error");
            } else if (horasTrabajadas.value == "") {
                Swal.fire("Error", "Error, por favor ingrese una cantidad de horas trabajadas", "error");
            } else if (horasTrabajadas.value < 8 || horasTrabajadas.value > 16) {
                Swal.fire("Error", "Error, las horas trabajadas deben ser mayores a 8 y menores a 16", "error");
            } else if (rfc.value === "") {
                Swal.fire("Error", "Error, por favor ingrese un RFC", "error");
            } else if (validarRFC(rfc.value) === false) {
                Swal.fire("Error", "RFC incorrecto, por favor ingrese un RFC en el formato correcto", "error");
            } else if (numEmpleado.value.length !== 8) {
                Swal.fire("Error", "Error, la longitud debe del número de empleado ser de 8 caracteres", "error");
            } else if (validarNumEmpleado(numEmpleado.value).resp === false) {
                Swal.fire("Error", alert(validarNumEmpleado(numEmpleado.value).error), "error");
            } else {
                $.post("controller/controlador-newCalculo.php", formRegistro.serialize(), function(resp) {
                    console.log(resp.respuesta)
                    if (resp.respuesta === "true") {
                        Swal.fire("¡Hecho!", "Registro realizado correctamente", "success");
                        formRegistro[0].reset();
                    } else {
                        Swal.fire("Error", resp.respuesta, "error");
                    }
                }, "json");
            }

        }

    }); //termina el DOMContentLoaded

})();

function validarRFC(RFC) {
    let rfc_upper = RFC.toUpperCase();
    let rfcRegex = /^([ A-ZÑ&]?[A-ZÑ&]{3}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
    if (rfc_upper.match(rfcRegex)) {
        return true;
    } else {
        return false;
    }
}

function validarNumEmpleado(NoEmpleado) {
    let arrayNoEmpleados = Array.from(NoEmpleado);
    let letras = [];
    let numeros = [];
    let jsonResp = {};
    //let arrayEmpleadoFinal = [];

    for (let i = 0; i < arrayNoEmpleados.length; i++) {

        if (i < 2) {
            letras.push(arrayNoEmpleados[i]);
        } else if (i > 1) {

            if (isNaN(arrayNoEmpleados[i])) { //verificar que a partir del tercer dígito sean sólo números
                return jsonResp = { resp: false, error: "Error, los seis últimos dígitos del número de empleado deben ser números" };
            }

        }
    }

    if (!validarLetras(letras)) {
        return jsonResp = { resp: false, error: "Error, los primeros dos dígitos del número de empleado deben ser letras" };
    } else {
        return jsonResp = { resp: true }; //"Formato de empleado correcto"
    }

}

function validarLetras(letrasEntrada) {
    let soloLetras = false;
    let letrasArray = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"
    ];

    for (let i = 0; i < letrasEntrada.length; i++) {

        if (letrasArray.includes(letrasEntrada[i])) {
            soloLetras = true;
        } else {
            soloLetras = false;
        }

    }

    return soloLetras;
}

function validarNombre(nombreEntrada) {
    let jsonResp = {};
    let letrasValidas = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;

    if (nombreEntrada.length < 3) {
        jsonResp = { resp: false, error: "Nombre demasiado corto" };
        return jsonResp;
    } else {

        if (nombreEntrada.match(letrasValidas)) {
            return jsonResp = { resp: true };
        } else {
            return jsonResp = { resp: false, error: "No se admiten caracteres especiales o números" };
        }

    }
}

/*function validarNumeros(numerosEntrada) {
    let soloNumeros = false;
    let numerosArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    for (let i = 0; i < numerosEntrada.length; i++) {

        if (numerosArray.includes(numerosEntrada[i])) {
            soloNumeros = true
        } else {
            soloNumeros = false;
        }

    }

    return soloNumeros;
} //funcion solo para validar números */
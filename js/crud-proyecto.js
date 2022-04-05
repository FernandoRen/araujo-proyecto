(() => {
    "use strict";
    let btn_agregarProyecto = document.getElementById("boton-agregar-proyecto");
    let btn_actualizarProyecto = document.getElementById("btn-actualizarProyecto");
    let id_cerrarSesion = document.getElementById("cerrarSesion");
    document.addEventListener("DOMContentLoaded", function() {
        noUser();
        noRol();
        validarPermisoAdministrador();
        cargarProyectos();
        btn_agregarProyecto.addEventListener("click", validarDatosProyecto);
        btn_actualizarProyecto.addEventListener("click", actualizarDatosProyecto);
        id_cerrarSesion.addEventListener("click", cerrarSesion);
    });


})();

let nombreProyecto = document.getElementById("nombre_proyecto");
let fechaInicio = document.getElementById("date_start");
let fechaFin = document.getElementById("date_end");

let idforUpdating = "";

function validarDatosProyecto(e) {
    e.preventDefault();
    if (nombreProyecto.value === "" || nombreProyecto.value === undefined) {
        Swal.fire("Error", "Debes de ingresar un nombre de proyecto", "error");
    } else if (nombreProyecto.value.length < 3) {
        Swal.fire("Error", "Nombre de proyecto muy corto", "error");
    } else if (fechaInicio.value === "" || fechaInicio.value === undefined || fechaInicio.value === null) {
        Swal.fire("Error", "Ingrese una fecha de inicio para el proyecto", "error");
    } else if (validarFechas(fechaInicio.value, fechaFin.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser mayor a la fecha de finalización del proyecto", "error");
    } else if (validarFechasDiferentes(fechaInicio.value, fechaFin.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser igual a la fecha de finalización", "error");
    } else {
        agregarProyecto();
    }
}

function cargarProyectos() {
    let tablaProyectos = document.querySelector("#tabla-proyectos-2 tbody");
    $.post("../controller/controlador-crud-proyectos.php", { peticion: "seleccionar-solo-proyectos" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        tablaProyectos.innerHTML = "";
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {

                tablaProyectos.innerHTML += `
                    <tr>
                        <td>${backEnd_resp[i].idproyecto}</td>
                        <td>${backEnd_resp[i].nombre}</td>
                        <td>${backEnd_resp[i].dateStart}</td>
                        <td>${backEnd_resp[i].dateEnd}</td>
                        <td>${backEnd_resp[i].estatus}</td>
                        <td>
                            <button class="btn btn-primary mb-1 click-actualizar" data-bs-toggle="modal" data-bs-target="#updateModal2" id="${backEnd_resp[i].idproyecto}U" onclick="cargarDatosAJAX()">Editar</button>
                            <button class="btn btn-warning mb-1 click-finalizar" id="${backEnd_resp[i].idproyecto}" onclick="finalizarProyecto()">Finalizar</button>
                            <button class="btn btn-danger click-eliminar" id="${backEnd_resp[i].idproyecto}E" onclick="eliminarProyecto()">Cancelar</button>
                        </td>
                    </tr>
                    `;
            }
        } else {
            tablaProyectos.innerHTML = "";
        }
    });
}


function finalizarProyecto() {
    document.querySelectorAll(".click-finalizar").forEach(el => {
        el.addEventListener("click", e => {
            const id = e.target.getAttribute("id");
            Swal.fire({
                title: 'Se finalizará este proyecto',
                text: "¿Estás seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../controller/controlador-crud-proyectos.php", { id: id, peticion: "finalizarProyecto" }, function(resp) {
                        if (resp == true) {
                            Swal.fire("Éxito", "Proyecto finalizado correctamente", "success");
                            cargarProyectos();
                        } else {
                            Swal.fire("Error", "No se pudo finalizar, intente otra vez", "error");
                        }
                    });
                }
            });
        });
    });
}

function eliminarProyecto() {
    document.querySelectorAll(".click-eliminar").forEach(el => {
        el.addEventListener("click", e => {
            const id_e = e.target.getAttribute("id");
            const id = id_e.replace("E", "");
            Swal.fire({
                title: 'Se eliminará este proyecto',
                text: "¿Estás seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../controller/controlador-crud-proyectos.php", { id: id, peticion: "eliminarProyecto" }, function(resp) {
                        if (resp == true) {
                            Swal.fire("Éxito", "Se eliminó correctamente", "success");
                            cargarProyectos();
                        } else {
                            Swal.fire("Error", "No se pudo eliminar el proyecto, intente otra vez", "error");
                        }
                    });
                }
            });
        });
    });
}

function agregarProyecto() {
    let formulario_nuevoProyecto = $("#formulario-nuevoProyecto");
    formulario_nuevoProyecto.append('<input type="hidden" name="peticion" id="peticion" value="insertar">');
    $.post("../controller/controlador-crud-proyectos.php", formulario_nuevoProyecto.serialize(), function(resp) {
        if (resp == true) {
            Swal.fire("Éxito", "El proyecto se agregó correctamente", "success");
            cargarProyectos();
        } else {
            Swal.fire("Error", "No se pudo dar de alta el proyecto", "error");
        }
    });
}

function cargarDatosAJAX() {
    let nombre_proyecto2 = document.getElementById("nombre_proyecto2");
    let date_start2 = document.getElementById("date_start2");
    let date_end2 = document.getElementById("date_end2");

    document.querySelectorAll(".click-actualizar").forEach(el => {
        el.addEventListener("click", e => {
            const id_e = e.target.getAttribute("id");
            const id = id_e.replace("U", "");
            $.post("../controller/controlador-crud-proyectos.php", { id: id, peticion: "seleccionar-id" }, function(resp) {
                let respJson = JSON.parse(resp);
                if (respJson.length > 0) {
                    nombre_proyecto2.value = respJson[0].nombre;
                    date_start2.value = respJson[0].dateStart;
                    date_end2.value = respJson[0].dateEnd;
                    idforUpdating = respJson[0].idproyecto;
                }
            });
        });
    });
}

function actualizarDatosProyecto(e) {
    e.preventDefault();
    let nombre_proyecto = document.getElementById("nombre_proyecto2");
    let date_start = document.getElementById("date_start2");
    let date_end = document.getElementById("date_end2");

    //variables DOM
    let formUpdateProject_DOM = $("#formulario-actualizarProyecto");

    if (nombre_proyecto.value === "" || nombreProyecto === undefined) {
        Swal.fire("Error", "Debe ingresar un nombre de proyecto", "error");
    } else if (nombre_proyecto.value.length < 3) {
        Swal.fire("Error", "El nombre del proyecto es demasiado corto", "error");
    } else if (date_start.value === "" || date_end === undefined) {
        Swal.fire("Error", "Debe ingresar una fecha de inicio del proyecto", "error");
    } else if (validarFechas(date_start.value, date_end.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser mayor a la fecha de finalización del proyecto", "error");
    } else if (validarFechasDiferentes(date_start.value, date_end.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser igual a la fecha de finalización", "error");
    } else {
        formUpdateProject_DOM.append(`<input type="hidden" name="peticion" class="peticion" value="actualizar">`);
        formUpdateProject_DOM.append(`<input type="hidden" name="id_u" class="peticion" value="${idforUpdating}">`);
        $.post("../controller/controlador-crud-proyectos.php", formUpdateProject_DOM.serialize(), function(resp) {
            console.log(resp)
            if (resp === "1") {
                $(".peticion").remove();
                Swal.fire("Éxito", "Proyecto actualizado correctamente", "success");
                cargarProyectos();
            } else {
                Swal.fire("Error", "No se pudieron actualizar los datos del proyecto", "error");
            }
        });
    }
}
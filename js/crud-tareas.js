(() => {
    "use strict";
    let btn_agregarTarea = document.getElementById("boton-agregar-tarea");
    let btn_actualizarTarea = document.getElementById("btn-actualizarTarea");
    let id_cerrarSesion = document.getElementById("cerrarSesion");
    document.addEventListener("DOMContentLoaded", function() {
        noUser();
        noRol();
        btn_agregarTarea.addEventListener("click", validarDatosTarea);
        cargarSelectProyecto("proyecto_user");
        cargarSelectProyecto("proyecto_user2");
        cargarSelectUsuario("tarea_user");
        cargarSelectUsuario("tarea_user2");
        cargarTareas();
        btn_actualizarTarea.addEventListener("click", validarDatosUpdate);
        id_cerrarSesion.addEventListener("click", cerrarSesion);
    });


})();

let nombre_tarea = document.getElementById("nombre_tarea");
let descripcion_tarea = document.getElementById("descripcion_tarea");
let fechaInicio = document.getElementById("date_start_tarea");
let fechaFin = document.getElementById("date_end_tarea");
let proyecto_user = document.getElementById("proyecto_user");
let tarea_user = document.getElementById("tarea_user");

let idforUpdating = "";

function validarDatosTarea(e) {
    e.preventDefault();
    if (nombre_tarea.value === "" || nombre_tarea.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un nombre de tarea", "error");
    } else if (nombre_tarea.value.length < 5) {
        Swal.fire("Error", "Ingrese un nombre más largo", "error");
    } else if (descripcion_tarea.value === "" || descripcion_tarea.value === undefined) {
        Swal.fire("Error", "Por favor ingrese una descripcion de la tarea", "error");
    } else if (descripcion_tarea.value.length < 10) {
        Swal.fire("Error", "Ingrese una descripción más larga", "error");
    } else if (fechaInicio.value === "" || fechaInicio.value === undefined || fechaInicio.value === null) {
        Swal.fire("Error", "Por favor ingrese una fecha de inicio", "error");
    } else if (fechaFin.value === "" || fechaFin.value === undefined || fechaFin.value === null) {
        Swal.fire("Error", "Por favor ingrese una fecha de finalización", "error");
    } else if (validarFechas(fechaInicio.value, fechaFin.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser posterior a la fecha de finalización", "error");
    } else if (proyecto_user.value === "0" || proyecto_user.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un proyecto", "error");
    } else if (tarea_user.value === "0" || tarea_user.value === undefined) {
        Swal.fire("Error", "Por favor asigne la tarea a un usuario", "error");
    } else {
        agregarTarea();
    }
}

function agregarTarea() {
    let formTareas_DOM = $("#formulario-nuevaTarea");
    formTareas_DOM.append(`<input type="hidden" name="peticion" class="peticion" value="insertar">`);
    $.post("../controller/controlador-crud-tareas.php", formTareas_DOM.serialize(), function(resp) {
        if (resp == 1) {
            Swal.fire("Éxito", "La tarea se registró correctamente", "success");
            let formAgregarTarea = document.getElementById("formulario-nuevaTarea");
            formAgregarTarea.reset();
            cargarTareas();
        } else {
            Swal.fire("Erros", "No se pudo registrar la tarea", "error");
        }
    });

}

function cargarSelectProyecto(proyecto) {
    let selectProyecto = document.getElementById(proyecto);
    $.post("../controller/controlador-crud-tareas.php", { peticion: "cargarSelectProyecto" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {

                selectProyecto.innerHTML += `
                <option value="${backEnd_resp[i].idproyecto}">
                    ${backEnd_resp[i].nombre}
                </option>
                `;

            }
        } else {
            selectProyecto.innerHTML = "";
        }
    });
}

function cargarSelectUsuario(tarea) {
    let tarea_user = document.getElementById(tarea);
    $.post("../controller/controlador-crud-tareas.php", { peticion: "cargarSelectUsuarios" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {

                tarea_user.innerHTML += `
                <option value="${backEnd_resp[i].idusuario}">
                    ${backEnd_resp[i].nombreUsuario}
                </option>
                `;

            }
        } else {
            tarea_user.innerHTML = "";
        }
    });
}

function cargarTareas() {
    let tabla_tareas = document.querySelector("#tabla-tareas tbody");
    $.post("../controller/controlador-crud-tareas.php", { peticion: "cargarTablaTareas" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        if (backEnd_resp.length > 0) {
            tabla_tareas.innerHTML = "";
            for (let i = 0; i < backEnd_resp.length; i++) {

                tabla_tareas.innerHTML += `
                <tr>
                    <td>${backEnd_resp[i].idtareas}</td>
                    <td>${backEnd_resp[i].nombreTarea}</td>
                    <td>${backEnd_resp[i].descripcion}</td>
                    <td>${backEnd_resp[i].datestart}</td>
                    <td>${backEnd_resp[i].dateend}</td>
                    <td>${backEnd_resp[i].estatus}</td>
                    <td>${backEnd_resp[i].nombre}</td>
                    <td>${backEnd_resp[i].nombreusuario}</td>
                    <td>
                        <button id="${backEnd_resp[i].idtareas}U" class="btn btn-primary click-actualizar" data-bs-toggle="modal" data-bs-target="#updateModalTarea" onclick="getDatosAjax()">Editar</button>
                        <button id="${backEnd_resp[i].idtareas}" class="btn btn-success mt-2 click-terminar" onclick="terminarTarea()">Terminar</button>
                    </td>
                </tr>
                `;

            }
        } else {
            tabla_tareas.innerHTML = "";
        }
    });
}

function terminarTarea() {
    document.querySelectorAll(".click-terminar").forEach(el => {
        el.addEventListener("click", e => {
            const id_e = e.target.getAttribute("id");
            const id = id_e.replace("E", "");
            Swal.fire({
                title: 'Terminar tarea',
                text: "¿Estás seguro de que deseas terminar esta tarea?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../controller/controlador-crud-tareas.php", { id: id, peticion: "terminarTarea" }, function(resp) {
                        if (resp == true) {
                            Swal.fire("Éxito", "Tarea terminada correctamente", "success");
                            cargarTareas();
                        } else {
                            Swal.fire("Error", "No se pudo terminar la tarea, intente otra vez", "error");
                        }
                    });
                }
            });
        });
    });
}

let nombre_tarea2 = document.getElementById("nombre_tarea2");
let descripcion_tarea2 = document.getElementById("descripcion_tarea2");
let date_start_tarea2 = document.getElementById("date_start_tarea2");
let date_end_tarea2 = document.getElementById("date_end_tarea2");
let proyecto_user2 = document.getElementById("proyecto_user2");
let tarea_user2 = document.getElementById("tarea_user2");

function getDatosAjax() {
    document.querySelectorAll(".click-actualizar").forEach(el => {
        el.addEventListener("click", e => {
            const id_e = e.target.getAttribute("id");
            const id = id_e.replace("U", "");
            $.post("../controller/controlador-crud-tareas.php", { id: id, peticion: "seleccionar-id" }, function(resp) {
                let respJson = JSON.parse(resp);
                if (respJson.length > 0) {

                    nombre_tarea2.value = respJson[0].nombreTarea;
                    descripcion_tarea2.value = respJson[0].descripcion;
                    date_start_tarea2.value = respJson[0].datestart;
                    date_end_tarea2.value = respJson[0].dateend;
                    proyecto_user2.value = respJson[0].idproyecto;
                    tarea_user2.value = respJson[0].idusuario;

                    idforUpdating = respJson[0].idtareas;
                }
            });
        });
    });
}

function validarDatosUpdate(e) {
    e.preventDefault();
    if (nombre_tarea2.value === "" || nombre_tarea2.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un nombre de tarea", "error");
    } else if (nombre_tarea2.value.length < 5) {
        Swal.fire("Error", "Ingrese un nombre más largo", "error");
    } else if (descripcion_tarea2.value === "" || descripcion_tarea2.value === undefined) {
        Swal.fire("Error", "Por favor ingrese una descripcion de la tarea", "error");
    } else if (descripcion_tarea2.value.length < 10) {
        Swal.fire("Error", "Ingrese una descripción más larga", "error");
    } else if (date_start_tarea2.value === "" || date_start_tarea2.value === undefined || date_start_tarea2.value === null) {
        Swal.fire("Error", "Por favor ingrese una fecha de inicio", "error");
    } else if (date_end_tarea2.value === "" || date_end_tarea2.value === undefined || date_end_tarea2.value === null) {
        Swal.fire("Error", "Por favor ingrese una fecha de finalización", "error");
    } else if (validarFechas(date_start_tarea2.value, date_end_tarea2.value)) {
        Swal.fire("Error", "La fecha de inicio no puede ser posterior a la fecha de finalización", "error");
    } else if (proyecto_user2.value === "0" || proyecto_user2.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un proyecto", "error");
    } else if (tarea_user2.value === "0" || tarea_user2.value === undefined) {
        Swal.fire("Error", "Por favor asigne la tarea a un usuario", "error");
    } else {
        actualizarDatosTarea();
    }

}

function actualizarDatosTarea() {
    let formUpdateTareas_DOM = $("#formulario-actualizarTarea");
    formUpdateTareas_DOM.append(`<input type="hidden" name="peticion" class="peticion" value="actualizar">`);
    formUpdateTareas_DOM.append(`<input type="hidden" name="id_u" class="peticion" value="${idforUpdating}">`);
    $.post("../controller/controlador-crud-tareas.php", formUpdateTareas_DOM.serialize(), function(resp) {
        if (resp === "1") {
            $(".peticion").remove();
            Swal.fire("Éxito", "Tarea actualizada correctamente", "success");
            cargarTareas();
        } else {
            Swal.fire("Error", "No se pudieron actualizar los datos de la tarea", "error");
        }
    });
}
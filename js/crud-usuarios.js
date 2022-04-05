(() => {
    "use strict";
    let btn_agregarUsuario = document.querySelector("#boton-agregar-usuario");
    let rolUser = document.querySelector("#rol_user");
    let proyectoUser = document.querySelector("#proyecto_user");
    let rolUser2 = document.querySelector("#rol_user2");
    let proyectoUser2 = document.querySelector("#proyecto_user2");
    let id_cerrarSesion = document.getElementById("cerrarSesion");

    let btn_ActualizarUser = document.querySelector("#btn-actualizarUser");

    document.addEventListener("DOMContentLoaded", function() {
        seleccionarRol(rolUser);
        seleccionarRol(rolUser2);
        seleccionarProyecto(proyectoUser);
        seleccionarProyecto(proyectoUser2);
        cargarUsuarios();
        validarPermisoAdministrador();
        id_cerrarSesion.addEventListener("click", cerrarSesion);
        noUser();
        noRol();
    });
    btn_agregarUsuario.addEventListener("click", agregarUsuario);
    btn_ActualizarUser.addEventListener("click", actualizarUsuario);

})();

let tablaProyectos = document.querySelector("#tabla-usuarios tbody");
let idforUpdating = "";

function cargarUsuarios() {
    $.post("../controller/controlador-crud-usuarios.php", { peticion: "seleccionar" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        tablaProyectos.innerHTML = "";
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {

                tablaProyectos.innerHTML += `
                <tr>
                    <td>${backEnd_resp[i].idusuario}</td>
                    <td>${backEnd_resp[i].nombreUsuario}</td>
                    <td>${backEnd_resp[i].usuario}</td>
                    <td>${backEnd_resp[i].tipoRol}</td>
                    <td>${backEnd_resp[i].nombreProyecto}</td>
                    <td><div class="text-primary"><ion-icon name="pencil" data-bs-toggle="modal" data-bs-target="#updateModal" id="u${backEnd_resp[i].idusuario}" class="pt-2 m-1 click-update" onclick="getDatosAJAX()"></ion-icon></div></td>
                    <td><div class="text-danger"><ion-icon name="close" id="${backEnd_resp[i].idusuario}" class="size-2-rem click-remove m-1" onclick="eliminarUsuario()"></ion-icon></div></td>
                </tr>
                `;
            }
        } else {
            tablaProyectos.innerHTML = "";
        }
    });
}

function seleccionarRol(rol) {
    $.post("../controller/controlador-crud-usuarios.php", { peticion: "seleccionarRol" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {
                rol.innerHTML += `
                <option value="${backEnd_resp[i].idroles}">
                    <td>${backEnd_resp[i].tipoRol}</td>
                </option>
                `;
            }
        } else {
            tablaProyectos.innerHTML = "";
        }
    });
}

function seleccionarProyecto(proyecto) {
    $.post("../controller/controlador-crud-usuarios.php", { peticion: "seleccionarProyecto" }, function(resp) {
        let backEnd_resp = JSON.parse(resp);
        if (backEnd_resp.length > 0) {
            for (let i = 0; i < backEnd_resp.length; i++) {

                proyecto.innerHTML += `
                <option value="${backEnd_resp[i].idproyecto}">
                    <td>${backEnd_resp[i].nombre}</td>
                </option>
                `;

            }
        } else {
            tablaProyectos.innerHTML = "";
        }
    });
}

function agregarUsuario(e) {
    e.preventDefault();
    //variables
    let nombre_user = document.getElementById("nombre_user");
    let email_user = document.getElementById("email_user");
    let pass_user = document.getElementById("pass_user");
    let rol_user = document.getElementById("rol_user");
    let proyecto_user = document.getElementById("proyecto_user");
    let salario_user = document.getElementById("salario_user");

    //variables DOM
    let formatoPassword_DOM = document.getElementById("formato-password");
    let formNuevoUser_DOM = $("#formulario-nuevoUsuario");

    if (nombre_user.value === "" || nombre_user.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un nombre", "error");
    } else if (nombre_user.value.length < 10) {
        Swal.fire("Error", "El nombre es demasiado corto", "error");
    } else if (email_user.value === "" || email_user.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un Email", "error");
    } else if (validarEmail(email_user.value) !== true) {
        Swal.fire("Error", "Email inválido, por favor ingrese un email válido", "error");
    } else if (pass_user.value === "" || pass_user.value === undefined) {
        Swal.fire("Error", "Por favor ingrese una contraseña", "error");
    } else if (!validarPassword(pass_user.value)) {
        Swal.fire("Error", "Contraseña inválida, por favor ingrese una contraseña válida", "error");
        formatoPassword_DOM.innerHTML = `
            <ul>
                <li>Mínimo 8 caracteres</li>
                <li>Máximo 15 caracteres</li>
                <li>Al menos una letra mayúscula</li>
                <li> Al menos una letra mínuscula</li>
                <li>Al menos un dígito</li>
                <li>No espacios en blanco</li>
                <li>Al menos 1 caracter especial</li>
            </ul>
        `;
        setTimeout(() => {
            formatoPassword_DOM.innerHTML = ``;
        }, "10000");
    } else if (rol_user.value === "0" || rol_user.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un rol", "error");
    } else if (proyecto_user.value === "0" || proyecto_user.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un proyecto", "error");
    } else {
        formNuevoUser_DOM.append(`<input type="hidden" name="peticion" class="peticion" value="insertar">`);
        $.post("../controller/controlador-crud-usuarios.php", formNuevoUser_DOM.serialize(), function(resp) {
            console.log(resp === "1");
            if (resp === "1") {
                $(".peticion").remove();
                Swal.fire("Éxito", "Usuario agregado correctamente", "success");
                cargarUsuarios();
                let formNuevoUser = document.getElementById("formulario-nuevoUsuario");
                formNuevoUser.reset();

            } else {
                Swal.fire("Error", "No se pudo agregar el usuario", "error");
            }

        });
    }

}

function eliminarUsuario() {
    document.querySelectorAll(".click-remove").forEach(el => {
        el.addEventListener("click", e => {
            const id = e.target.getAttribute("id");
            //console.log("Se ha clickeado el id " + id);

            Swal.fire({
                title: 'Se eliminará este usuario',
                text: "¿Estás seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../controller/controlador-crud-usuarios.php", { id: id, peticion: "eliminar" }, function(resp) {
                        console.log(resp);
                        if (resp === "1") {
                            Swal.fire("Éxito", "Usuario eliminado correctamente", "success");
                            cargarUsuarios();
                        } else {
                            Swal.fire("Error", "No se pudo agregar el usuarios", "error");
                        }
                    });
                }
            });


        });
    });
}

function actualizarUsuario(e) {
    e.preventDefault();
    let nombre_user = document.getElementById("nombre_user2");
    let email_user = document.getElementById("email_user2");
    let rol_user = document.getElementById("rol_user2");
    let proyecto_user = document.getElementById("proyecto_user2");

    //variables DOM
    let formUpdateUser_DOM = $("#formulario-actualizarUsuario");

    if (nombre_user.value === "" || nombre_user.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un nombre", "error");
    } else if (email_user.value === "" || email_user.value === undefined) {
        Swal.fire("Error", "Por favor ingrese un Email", "error");
    } else if (validarEmail(email_user.value) !== true) {
        Swal.fire("Error", "Email inválido, por favor ingrese un email válido", "error");
    } else if (rol_user.value === "0" || rol_user.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un rol", "error");
    } else if (proyecto_user.value === "0" || proyecto_user.value === undefined) {
        Swal.fire("Error", "Por favor seleccione un proyecto", "error");
    } else {
        formUpdateUser_DOM.append(`<input type="hidden" name="peticion" class="peticion" value="actualizar">`);
        formUpdateUser_DOM.append(`<input type="hidden" name="id_u" class="peticion" value="${idforUpdating}">`);
        $.post("../controller/controlador-crud-usuarios.php", formUpdateUser_DOM.serialize(), function(resp) {
            console.log(resp)
            if (resp === "1") {
                $(".peticion").remove();
                Swal.fire("Éxito", "Usuario actualizado correctamente", "success");
                cargarUsuarios();
            } else {
                Swal.fire("Error", "No se pudieron actualizar los datos del usuario", "error");
            }
        });
    }
}


function getDatosAJAX() {
    document.querySelectorAll(".click-update").forEach(el => {
        el.addEventListener("click", e => {
            const id_U = e.target.getAttribute("id");
            const id = id_U.replace("u", "");

            $.post("../controller/controlador-crud-usuarios.php", { id: id, peticion: "getUpdate" }, function(resp) {
                let respJson = JSON.parse(resp);
                if (respJson.length > 0) {
                    let nombre_user = document.getElementById("nombre_user2");
                    let email_user = document.getElementById("email_user2");
                    let rol_user = document.getElementById("rol_user2");
                    let proyecto_user = document.getElementById("proyecto_user2");

                    nombre_user.value = respJson[0].nombreUsuario;
                    email_user.value = respJson[0].usuario;
                    rol_user.value = respJson[0].idroles;
                    proyecto_user.value = respJson[0].idproyecto;
                    idforUpdating = respJson[0].idusuario;
                }
            });
        });
    });
}
(() => {
    "use strict";
    let tablaProyectos = document.querySelector("#tabla-proyectos tbody");
    let id_cerrarSesion = document.getElementById("cerrarSesion");
    document.addEventListener("DOMContentLoaded", function() {
        id_cerrarSesion.addEventListener("click", cerrarSesion);

        $.post("../controller/controlador-crud-tareas.php", { peticion: "cargarTablaTareas" }, function(resp) {
            let backEnd_resp = JSON.parse(resp);

            tablaProyectos.innerHTML = "";
            if (backEnd_resp.length > 0) {

                for (let i = 0; i < backEnd_resp.length; i++) {

                    tablaProyectos.innerHTML += `
                    <tr>
                        <td>${backEnd_resp[i].idtareas}</td>
                        <td>${backEnd_resp[i].nombreTarea}</td>
                        <td>${backEnd_resp[i].descripcion}</td>
                        <td>${backEnd_resp[i].datestart}</td>
                        <td>${backEnd_resp[i].dateend}</td>
                        <td>${backEnd_resp[i].estatus}</td>
                        <td>${backEnd_resp[i].nombre}</td>
                        <td>${backEnd_resp[i].nombreusuario}</td>
                    </tr>
                    `;

                }

            } else {
                tablaProyectos.innerHTML = "";
            }

        });

        noUser();
        noRol();

    });


})();
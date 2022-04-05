(() => {
    "use strict";
    let id_cerrarSesion = document.getElementById("cerrarSesion");
    document.addEventListener("DOMContentLoaded", function() {
        validarPermisoAdministrador();
        logsEjecutar();
        id_cerrarSesion.addEventListener("click", cerrarSesion);
        noUser();
        noRol();
    });

})();

function logsEjecutar() {
    let logs = document.querySelector("#logs");
    let date = new Date();
    let day = date.getDate(),
        mounth = date.getMonth() + 1,
        year = date.getFullYear();


    if (day < 10) {
        day = "0" + day;
    }

    if (mounth < 10) {
        mounth = "0" + mounth;
    }

    let dateToday = `${year}-${mounth}-${day}`;
    console.log(dateToday)

    logs.setAttribute("max", dateToday);
    logs.value = dateToday;
}
function noUser() {
    let getUser = localStorage.getItem("usuario");
    if (getUser === "" || getUser === undefined || getUser === null || getUser === "undefined") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "No puedes estar aquí",
            showConfirmButton: false
        }).then(document.addEventListener("click", () => window.location.replace("http://localhost:8012/front%20end%20-%20araujo/index.php")));
    }
}

function validarPermisoAdministrador() {
    let getRol = localStorage.getItem("rol");
    if (getRol != md5(4)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "No puedes estar aquí, no tienes los permisos correspondientes",
            showConfirmButton: false
        }).then(document.addEventListener("click", redireccionarHome));
    }
}

function noRol() {
    let getRol = localStorage.getItem("rol");
    const r = [1, 2, 3, 4];
    if (getRol == "" || getRol == undefined || getRol == null) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "No puedes estar aquí",
            showConfirmButton: false
        }).then(document.addEventListener("click", redireccionarOut));
    } else if (getRol != md5(r[0]) && getRol != md5(r[1]) && getRol != md5(r[2]) && getRol != md5(r[3])) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "No puedes estar aquí",
            showConfirmButton: false
        }).then(document.addEventListener("click", redireccionarOut));
    }
}

function redireccionarHome() {
    window.location.replace("http://localhost:8012/front%20end%20-%20araujo/vistas/inicio-vista.php")
}

function redireccionarOut() {
    window.location.replace("http://localhost:8012/front%20end%20-%20araujo/index.php")
}
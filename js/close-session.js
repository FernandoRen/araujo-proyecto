function cerrarSesion(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Cerrar Sesión',
        text: "¿Estás seguro de que quieres cerrar sesión?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../security/sesiones.php", { type: "cerrar_sesion" }, function(resp) {
                if (resp == 1) {
                    localStorage.removeItem("usuario");
                    localStorage.removeItem("rol");
                    window.location.replace("http://localhost:8012/front%20end%20-%20araujo/index.php");
                }
            });
        }
    });
}
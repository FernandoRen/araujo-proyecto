(() => {
    "use strict";

    let usuario = document.getElementById("user-login");
    let pass = document.getElementById("user-pass");
    let form = $("form-login");
    let btn_login = document.getElementById("login-btn");

    btn_login.addEventListener("click", login);


    function login(e) {
        e.preventDefault();
        if (usuario.value === "") {
            Swal.fire("Error", "Por favor ingrese un email", "error");
        } else if (validarEmail(usuario.value) !== true) {
            Swal.fire("Error", "Email inválido, por favor ingrese un email válido", "error");
        } else if (pass.value === "") {
            Swal.fire("Error", "Por favor ingrese una contraseña", "error");
        } else if (pass.value.length < 4) {
            Swal.fire("Error", "Contraseña muy corta", "error");
        } else {
            $.post("controller/controlador-login.php", { usuario: usuario.value, pass: pass.value }, function(resp) {

                const respAjax = JSON.parse(resp)
                console.log(respAjax.resultado);

                //guardar usuario y rol en local storage
                if (respAjax.resultado === true) {
                    let userStorage = JSON.stringify(respAjax.respuesta[0].usuario);
                    let rolStorage = parseInt(respAjax.respuesta[0].rol);
                    localStorage.setItem("usuario", md5(userStorage));
                    localStorage.setItem("rol", md5(rolStorage));

                    window.location.replace("vistas/inicio-vista.php");
                } else {
                    Swal.fire("Error", "Usuario o contraseña incorrecto", "error");
                }


            });
        }
    }

})();
<?php 
    include "./header-footer/header.php";
?>

<body>
    
    <div class="bg-secondary">
        <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Por favor ingresa tus credenciales</p>

                    <form action="#" id="form-login" method="POST" autocomplete="off">

                        <div class="form-outline form-white mb-4">
                            <input type="text" name="user-login" id="user-login" class="form-control form-control-lg" />
                            <label class="form-label">Email</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" maxlength="15" name="user-pass" id="user-pass" class="form-control form-control-lg" />
                            <label class="form-label">Contraseña</label>
                        </div>

                        <button id="login-btn" class="btn btn-outline-light btn-lg px-5" type="submit">Iniciar Sesión</button>
                    </form>

                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>
    <script src="js/jQuery.js"></script>
    <script src="js/validaciones.js"></script>
    <script src="js/login-ajax.js"></script>

</body>
</html>
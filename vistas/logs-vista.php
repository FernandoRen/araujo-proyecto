<?php 
    include "./../header-footer/header.php";
    include "./../navbar.php";
    include "./../security/sesiones.php";
?>

        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center m-5 h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background-color: #B299B7">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-5 text-uppercase">Modulo de logs</h2>
                    <p class="text-white-50 mb-5">Ingresa una fecha:</p>

                    <form action="../logGenerator/descargarLog.php" id="form-login" method="POST" autocomplete="off">

                        <div class="form-outline form-white mb-4">
                            <input type="date" name="logs" id="logs" class="form-control form-control-lg"/>
                            <button type="submit" class="btn btn-outline-dark mt-4">Ver logs</button>
                        </div>

                    </form>

                    <div class="mb-4"></div>

                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php
        include "../header-footer/footer-copy.php";
    ?>
<script src="../js/jQuery.js"></script>
<script src="../js/logs.js"></script>
<script src="../js/validar-rol.js"></script>
</body>
</html>
<?php 
    include "./../header-footer/header.php";
    include "./../navbar.php";
    include "./../security/sesiones.php";
?>

    <h2 class="m-3">Bienvenido <span class="text-primary"><?php echo $nombreUsuario_session = $array_sesiones->{'nombreUsuario'}; ?></span></h2>
    <div class="container min-vh-100">
        <div class="row mt-4">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h3>Tus tareas son:</h3>
                <table class="table table-striped text-center" id="tabla-proyectos">
                    <thead>
                        <tr class="bg-secondary">
                            <td class="text-light">ID</td>
                            <td class="text-light">Nombre de la tarea</td>
                            <td class="text-light">Descripción</td>
                            <td class="text-light">Fecha de inicio</td>
                            <td class="text-light">Fecha de finalización</td>
                            <td class="text-light">Estatus</td>
                            <td class="text-light">Proyecto</td>
                            <td class="text-light">Asigando a</td>
                        </tr>
                    </thead>
                    
                    <tbody></tbody>
                    
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <?php
        include "../header-footer/footer-copy.php";
    ?>

<script src="../js/jQuery.js"></script>
<script src="../js/inicio.js"></script>
<script src="../js/validar-rol.js"></script>
</body>
</html>
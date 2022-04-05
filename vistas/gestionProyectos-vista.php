<?php 
    include "./../header-footer/header.php";
    include "./../navbar.php";
    include "./../security/sesiones.php";
?>

    <div class="container">
        <div class="row my-4">
            <div class="col-md-4">

                <form action="#" id="formulario-nuevoProyecto" autocomplete="off">
                    <h2>Alta nuevo proyecto</h2>
                    <label class="form-label" for="nombre_proyecto">Nombre del proyecto</label>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-control mb-3">

                    <label class="form-label" for="date_start">Fecha de inicio</label>
                    <input type="date" class="form-control mb-3" name="date_start" id="date_start">

                    <label for="date_end">Fecha de finalización</label>
                    <input type="date" class="form-control mb-3" name="date_end" id="date_end">

                    <div class="mt-4"></div>
                    <div class="p-2"></div>

                    <button id="boton-agregar-proyecto" class="btn btn-success fw-bold px-4 py-2 float-end">Agregar proyecto</button>
                </form>
                    
            </div>
            <div class="col-md-8">
            <table class="table table-striped text-center" id="tabla-proyectos-2">
                    <thead>
                        <tr class="bg-secondary">
                            <td class="text-light">ID</td>
                            <td class="text-light">Nombre del proyecto</td>
                            <td class="text-light">Fecha de inicio</td>
                            <td class="text-light">Fecha de finalización</td>
                            <td class="text-light">Estatus</td>
                            <td></td>
                        </tr>
                    </thead>
                    
                    <tbody class="text-center"></tbody>
                    
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Editar datos del proyecto</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="formulario-actualizarProyecto" autocomplete="off">
                        
                    <label class="form-label" for="nombre_proyecto2">Nombre del proyecto</label>
                    <input type="text" id="nombre_proyecto2" name="nombre_proyecto2" class="form-control mb-3">

                    <label class="form-label" for="date_start2">Fecha de inicio</label>
                    <input type="date" class="form-control mb-3" name="date_start2" id="date_start2">

                    <label for="date_end2">Fecha de finalización</label>
                    <input type="date" class="form-control mb-3" name="date_end2" id="date_end2">

                     <div class="mt-4"></div>
                    <div class="p-2"></div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrarModalProyectos" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button id="btn-actualizarProyecto" type="button" class="btn btn-success">Actualizar</button>
            </div>
            </div>
        </div>
        </div>
    </div>

    <?php
        include "../header-footer/footer-copy.php";
    ?>

<script src="../js/jQuery.js"></script>
<script src="../js/validaciones.js"></script>
<script src="../js/crud-proyecto.js"></script>
<script src="../js/validar-rol.js"></script>
</body>
</html>
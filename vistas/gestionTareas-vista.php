<?php 
    include "./../header-footer/header.php";
    include "./../navbar.php";
    include "./../security/sesiones.php";
?>

    <div class="container">
        <div class="row my-4">
            <div class="col-md-4">

                <form action="#" id="formulario-nuevaTarea" autocomplete="off">
                    <h2>Crear nueva tarea</h2>
                    <label class="form-label" for="nombre_tarea">Nombre de la tarea</label>
                    <input type="text" id="nombre_tarea" name="nombre_tarea" class="form-control mb-3">

                    <label class="form-label" for="descripcion_tarea">Descripcion</label>
                    <input type="email" id="descripcion_tarea" name="descripcion_tarea" class="form-control mb-3">
                    
                    <label class="form-label" for="date_start_tarea">Fecha de inicio</label>
                    <input type="date" class="form-control mb-3" name="date_start_tarea" id="date_start_tarea">

                    <label for="date_end_tarea">Fecha de finalización</label>
                    <input type="date" class="form-control mb-3" name="date_end_tarea" id="date_end_tarea">

                    <label for="proyecto_user">Proyecto</label>
                    <select name="proyecto_user" id="proyecto_user" class="form-select mb-3">
                        <option value="0" selected> -- </option>
                    </select>

                    <label for="tarea_user">Asignar a</label>
                    <select name="tarea_user" id="tarea_user" class="form-select">
                        <option value="0" selected> -- </option>
                    </select>

                    <div class="mt-2"></div>
                    <div class="p-2"></div>

                    <button id="boton-agregar-tarea" class="btn btn-success fw-bold px-4 py-2 float-end">Agregar tarea</button>
                </form>
                    
            </div>
            <div class="col-md-8">
                <table class="table table-striped text-center" id="tabla-tareas">
                    <thead>
                        <tr class="bg-secondary">
                            <td class="text-light">ID</td>
                            <td class="text-light">Nombre de tarea</td>
                            <td class="text-light">Descripción</td>
                            <td class="text-light">Fecha de inicio</td>
                            <td class="text-light">Fecha de finalización</td>
                            <td class="text-light">Estatus</td>
                            <td class="text-light">Proyecto</td>
                            <td class="text-light">Usuario</td>
                            <td class="text-light">Acciones</td>
                        </tr>
                    </thead>
                    
                    <tbody></tbody>
                    
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModalTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Editar tarea</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="formulario-actualizarTarea" autocomplete="off">
                        
                    <label class="form-label" for="nombre_tarea2">Nombre de la tarea</label>
                    <input type="text" id="nombre_tarea2" name="nombre_tarea2" class="form-control mb-3">

                    <label class="form-label" for="descripcion_tarea2">Descripcion</label>
                    <input type="email" id="descripcion_tarea2" name="descripcion_tarea2" class="form-control mb-3">
                    
                    <label class="form-label" for="date_start_tarea2">Fecha de inicio</label>
                    <input type="date" class="form-control mb-3" name="date_start_tarea2" id="date_start_tarea2">

                    <label for="date_end_tarea2">Fecha de finalización</label>
                    <input type="date" class="form-control mb-3" name="date_end_tarea2" id="date_end_tarea2">

                    <label for="proyecto_user2">Proyecto</label>
                    <select name="proyecto_user2" id="proyecto_user2" class="form-select mb-3">
                        <option value="0" selected> -- </option>
                    </select>

                    <label for="tarea_user2">Asignar a</label>
                    <select name="tarea_user2" id="tarea_user2" class="form-select">
                        <option value="0" selected> -- </option>
                    </select>
                        
                    <div class="mt-4"></div>
                    <div class="p-2"></div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button id="btn-actualizarTarea" type="button" class="btn btn-success">Actualizar</button>
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
<script src="../js/crud-tareas.js"></script>
<script src="../js/validar-rol.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>
</html>
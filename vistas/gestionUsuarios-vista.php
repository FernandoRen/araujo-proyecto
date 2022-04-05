<?php 
    include "./../header-footer/header.php";
    include "./../navbar.php";
    include "./../security/sesiones.php";
?>

    <div class="container">
        <div class="row my-4">
            <div class="col-md-4">

                <form action="#" id="formulario-nuevoUsuario" autocomplete="off">
                    <h2>Agregar un nuevo usuario</h2>
                    <label class="form-label" for="nombre_user">Nombre</label>
                    <input type="text" id="nombre_user" name="nombre_user" class="form-control">
                    <br>

                    <label class="form-label" for="email_user">Email</label>
                    <input type="email" id="email_user" name="email_user" class="form-control">
                    <br>

                    <label class="form-label" for="pass_user">Contraseña</label>
                    <input type="password" id="pass_user" name="pass_user" class="form-control">
                    <div class="pt-2 text-center text-danger" id="formato-password"></div>
                    <br>

                    <label for="rol_user">Rol</label>
                    <select name="rol_user" id="rol_user" class="form-select mt-1">
                        <option value="0" selected> -- </option>
                    </select>
                    <br>

                    <label for="proyecto_user">Proyecto</label>
                    <select name="proyecto_user" id="proyecto_user" class="form-select mt-1">
                        <option value="0" selected> -- </option>
                    </select>
                    <br>

                    <div class="mt-4"></div>
                    <div class="p-2"></div>

                    <button id="boton-agregar-usuario" class="btn btn-success fw-bold px-4 py-2 float-end">Agregar usuario</button>
                </form>
                    
            </div>
            <div class="col-md-8">
                <table class="table table-striped text-center" id="tabla-usuarios">
                    <thead>
                        <tr class="bg-secondary">
                            <td class="text-light">ID</td>
                            <td class="text-light">Nombre</td>
                            <td class="text-light">Email</td>
                            <td class="text-light">Rol</td>
                            <td class="text-light">Proyecto asignado</td>
                            <td class="text-light">Editar</td>
                            <td class="text-light">Eliminar</td>
                        </tr>
                    </thead>
                    
                    <tbody></tbody>
                    
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Editar datos del usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="#" id="formulario-actualizarUsuario" autocomplete="off">
                    
                    <label class="form-label" for="nombre_user2">Nombre</label>
                    <input type="text" id="nombre_user2" name="nombre_user2" class="form-control">

                    <label class="form-label" for="email_user2">Email</label>
                    <input type="email" id="email_user2" name="email_user2" class="form-control">

                    <label for="rol_user2">Rol</label>
                    <select name="rol_user2" id="rol_user2" class="form-select mt-1">
                        <option value="0" selected> -- </option>
                    </select>

                    <label for="proyecto_user2">Proyecto</label>
                    <select name="proyecto_user2" id="proyecto_user2" class="form-select mt-1">
                        <option value="0" selected> -- </option>
                    </select>

                    <div class="mt-4"></div>
                    <div class="p-2"></div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button id="btn-actualizarUser" type="button" class="btn btn-success">Actualizar</button>
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
<script src="../js/crud-usuarios.js"></script>
<script src="../js/validar-rol.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>
</html>
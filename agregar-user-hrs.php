<?php 
    include "./header-footer/header.php";
    include "./navbar.php";
?>
    <div class="container mt-4">

    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">

        <form action="#" id="formulario-trabajador" autocomplete="off">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
                <br><br>

                <label class="form-label" for="sueldo">Sueldo</label>
                <input type="number" id="sueldo" name="sueldo" class="form-control">
                <br><br>

                <label class="form-label" for="horasT">Horas trabajadas</label>
                <input type="number" id="horasT" name="horasT" class="form-control">
                <br><br>

                <label class="form-label" for="RFC">RFC</label>
                <input type="text" id="RFC" name="RFC" class="form-control">
                <br><br>

                <label class="form-label" for="No-Empleado">No. Empleado</label>
                <input type="text" id="No-Empleado" name="No-Empleado" maxlength="8" class="form-control">
                <div class="mt-4"></div>
                <div class="p-2"></div>

                <button id="boton-trabajador" class="btn btn-success fw-bold px-4 py-2 float-end">Enviar</button>
            </form>

            <form action="./logGenerator/descargarLog.php" method="POST" id="form-logs">
                <label for="dia-Log">Ingrese la fecha para buscar los logs</label>
                <input id="dia-Log" name="dia-Log" type="date" required class="d-block">
                <button id="get-logs-button" class="btn btn-primary mt-2">Descargar Logs</button>
            </form>

        </div>
        <div class="m-4"></div>
        <div class="col-md-2"></div>

        

    </div>

    <script src="js/jQuery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/validar-rol.js"></script>
    <script>
        window.addEventListener('load', function() {
            var strHash = md5('tutsplus');
            alert('The MD5 hash of the tutsplus string is:' + strHash);
        });
    </script>

</html>
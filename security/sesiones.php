<?php

    session_start();
    $array_sesiones = $_SESSION["session_usuarios_array"];
    $nombreUsuario_session = $array_sesiones->{'nombreUsuario'};
    $emailUsuario_session = $array_sesiones->{'usuario'};
    $id_rol = $array_sesiones->{'rol'};


    if ($emailUsuario_session == "" || $emailUsuario_session == null) {
        header('Location: http://localhost:8012/front%20end%20-%20araujo/index.php');
    }

    if ($_POST) {
        $cerrar_sesion = $_POST["type"];
        if ($cerrar_sesion == "cerrar_sesion") {
            session_destroy();
            echo 1;
        }
    }

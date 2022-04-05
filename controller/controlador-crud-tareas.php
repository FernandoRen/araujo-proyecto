<?php

    if (!$_POST) {
        header('Location: http://localhost:8012/front%20end%20-%20araujo/index.php');
    }

    include_once "./../model/crud-tareas-model.php";

    $metodos_controlador = new metodos_sql();

    $peticion = "";
    if (isset($_POST["peticion"])) {
        $peticion = $_POST["peticion"];
    }

    session_start(); 

   $metodos_controlador->procesarPeticionSQL($peticion);

    class metodos_sql{
        protected $modelo;
        
        public function __construct()
        {
            $this->modelo = new crud_tareas_model();
        }

        public function procesarPeticionSQL($peticionSQL){
            $array_sesiones = $_SESSION["session_usuarios_array"];
            $id_session = $array_sesiones->{'idusuario'};
            $usuario_session = $array_sesiones->{'usuario'};
            $id_rol = $array_sesiones->{'rol'};
            $id_proyecto = $array_sesiones->{'idproyecto'};
            switch ($peticionSQL) {
                case 'cargarSelectProyecto':
                   $jsonResp = $this->modelo->cargarProyectosModel($id_session, $id_rol);
                    echo json_decode(json_encode($jsonResp));
                break;

                case 'cargarSelectUsuarios':
                    $jsonResp = $this->modelo->cargarUsuariosModel($id_rol, $id_proyecto);
                    echo json_decode(json_encode($jsonResp));
                break;

                case 'insertar':
                    $nombre_tarea_post = htmlspecialchars($_POST['nombre_tarea'], ENT_QUOTES, 'UTF-8' );
                    $descripcion_tarea_post = htmlspecialchars($_POST['descripcion_tarea'], ENT_QUOTES, 'UTF-8' );
                    $date_start_tarea_post = htmlspecialchars($_POST['date_start_tarea'], ENT_QUOTES, 'UTF-8' );
                    $date_end_tarea_post = htmlspecialchars($_POST['date_end_tarea'], ENT_QUOTES, 'UTF-8' );
                    $proyecto_user_post = htmlspecialchars($_POST['proyecto_user'], ENT_QUOTES, 'UTF-8' );
                    $tarea_user_post = htmlspecialchars($_POST['tarea_user'], ENT_QUOTES, 'UTF-8' );


                    $jsonResp = $this->modelo->insertarTareaModelo($nombre_tarea_post, $descripcion_tarea_post, $date_start_tarea_post, $date_end_tarea_post, $proyecto_user_post, $tarea_user_post);
                    echo json_decode($jsonResp);
                break;

                case 'cargarTablaTareas':
                    $jsonResp = $this->modelo->consultarTareasModel($id_rol, $id_proyecto);
                    echo json_decode(json_encode($jsonResp));
                break;
                
                case 'terminarTarea':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->modelo->terminarTareaModel($id_post);
                    echo json_decode($jsonResp);
                break;

                case 'seleccionar-id':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->modelo->seleccionarTareaIdModel($id_post);
                    echo json_decode(json_encode($jsonResp));
                break;

                case 'actualizar':
                    $nombre_tarea_post = htmlspecialchars($_POST['nombre_tarea2'], ENT_QUOTES, 'UTF-8' );
                    $descripcion_tarea_post = htmlspecialchars($_POST['descripcion_tarea2'], ENT_QUOTES, 'UTF-8' );
                    $date_start_tarea_post = htmlspecialchars($_POST['date_start_tarea2'], ENT_QUOTES, 'UTF-8' );
                    $date_end_tarea_post = htmlspecialchars($_POST['date_end_tarea2'], ENT_QUOTES, 'UTF-8' );
                    $proyecto_user_post = htmlspecialchars($_POST['proyecto_user2'], ENT_QUOTES, 'UTF-8' );
                    $tarea_user_post = htmlspecialchars($_POST['tarea_user2'], ENT_QUOTES, 'UTF-8' );
                    $id_post = htmlspecialchars($_POST['id_u'], ENT_QUOTES, 'UTF-8' );

                    $jsonResp = $this->modelo->actualizarDatosTareaModel($id_post, $nombre_tarea_post, $descripcion_tarea_post, $date_start_tarea_post,  $date_end_tarea_post, $proyecto_user_post, $tarea_user_post);
                    echo json_decode($jsonResp);
                break;

                default:
                    # code...
                    break;
            }
        }
    }

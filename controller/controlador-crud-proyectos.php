<?php
    if (!$_POST) {
        header('Location: http://localhost:8012/front%20end%20-%20araujo/index.php');
    }

    include_once "./../model/crud-proyectos-model.php";

    $metodos_controlador = new metodos_sql();

    //$RESP = $metodos_controlador->mostrarVistaProyectos_controlador();
    $peticion = "";
    if (isset($_POST["peticion"])) {
        $peticion = $_POST["peticion"];
    }

    $metodos_controlador->procesarPeticionSQL($peticion);

    class metodos_sql{

        protected $modelo;
        
        public function __construct()
        {
            $this->modelo = new crud_proyectos_model();
        }

        public function procesarPeticionSQL($peticionSQL){
            switch ($peticionSQL) {
                case 'seleccionar':
                    $jsonResp = $this->modelo->mostrarProyectos_y_UsuariosModelo();
                    echo json_decode(json_encode($jsonResp));
                break;

                case 'seleccionar-solo-proyectos':
                    $jsonResp = $this->modelo->mostrarProyectosModelo();
                    echo json_decode(json_encode($jsonResp));
                break;

                case 'finalizarProyecto':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->modelo->finalizarProyectoModelo($id_post);
                    echo json_decode($jsonResp);
                break;

                case 'insertar':
                    $nombre_proyecto_post = htmlspecialchars($_POST['nombre_proyecto'], ENT_QUOTES, 'UTF-8' );
                    $date_start_post = htmlspecialchars($_POST['date_start'], ENT_QUOTES, 'UTF-8' );
                    $date_end_post = htmlspecialchars($_POST['date_end'], ENT_QUOTES, 'UTF-8' );

                    $jsonResp = $this->modelo->agregarProyectoModelo($nombre_proyecto_post, $date_start_post, $date_end_post);
                    echo json_decode($jsonResp);
                break;

                case 'eliminarProyecto':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->modelo->eliminarProyectoModelo($id_post);
                    echo json_decode($jsonResp);
                break;

                case 'seleccionar-id':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->modelo->mostrarProyectosIdModelo($id_post);
                    echo json_encode(json_decode($jsonResp));
                break;

                case 'actualizar':
                    $id_post = htmlspecialchars($_POST['id_u'], ENT_QUOTES, 'UTF-8' );
                    $nombre_proyecto_post = htmlspecialchars($_POST['nombre_proyecto2'], ENT_QUOTES, 'UTF-8' );
                    $date_start_post = htmlspecialchars($_POST['date_start2'], ENT_QUOTES, 'UTF-8' );
                    $date_end_post = htmlspecialchars($_POST['date_end2'], ENT_QUOTES, 'UTF-8' );

                    $jsonResp = $this->modelo->actualizarDatosProyectoModelo($id_post, $nombre_proyecto_post, $date_start_post, $date_end_post);
                    echo json_decode($jsonResp);
                break;
                
                default:
                    $jsonResp = $this->modelo->mostrarProyectos_y_UsuariosModelo();
                    echo json_encode(json_decode($jsonResp));
                break;
            }
        }

    }
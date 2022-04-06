<?php

    if (!$_POST) {
        header('Location: http://localhost:8012/front%20end%20-%20araujo/index.php');
    }

    include_once "./../model/crud-usuarios-model.php";

    $metodos_controlador = new metodos_sql();

    //$RESP = $metodos_controlador->mostrarVistaUsuarios_controlador();

    $peticion = "";
    if (isset($_POST["peticion"])) {
        $peticion = $_POST["peticion"];
    }

    //$jsonResp = array("respuesta" => $RESP);
    //echo json_decode($RESP);

    $metodos_controlador->procesarPeticionSQL($peticion);

    class metodos_sql{

        protected $modelo;
        
        public function __construct()
        {
            $this->modelo = new crud_usuarios_model;
        }

        public function mostrarVistaUsuarios_controlador(){
            $mostrar_usuarios = $this->modelo->mostrarUsuariosModelo();
            return json_encode($mostrar_usuarios);
        }

        public function mostrarRoles_controlador(){
            $mostrar_roles = $this->modelo->mostrarRolesModelo();
            return json_encode($mostrar_roles);
        }

        public function mostrarProyecto_controlador(){
            $mostrar_proyectos = $this->modelo->mostrarProyectosModelo();
            return json_encode($mostrar_proyectos);
        }

        public function insertarUsuario_controlador($nombre_user, $email_user, $sueldo_user, $password_encriptada, $rol_user, $proyecto_user){
            $insertarUsuario = $this->modelo->agregarUsuarioModelo($nombre_user, $email_user, $sueldo_user, $password_encriptada, $rol_user, $proyecto_user);
            return json_encode($insertarUsuario);
        }

        public function eliminarUsuario_controlador($id){
            $eliminar_usuario = $this->modelo->eliminarUsuario_modelo($id);
            return json_encode($eliminar_usuario );
        }

        public function getUserForUpdate_controlador($id){
            $consulta = $this->modelo->getUpdate_modelo($id);
            return json_encode($consulta);
        }

        public function actualizarUsuario_controlador($id, $nombre_user, $email_user, $sueldo_user, $rol_user, $proyecto_user){
            $update_query =  $this->modelo->actualizarUsuario_modelo($id, $nombre_user, $email_user, $sueldo_user, $rol_user, $proyecto_user);
            return json_encode($update_query);
        }

        public function procesarPeticionSQL($peticionSQL){
            switch($peticionSQL){
                case 'seleccionar':
                    $jsonResp = $this->mostrarVistaUsuarios_controlador();
                    echo json_decode($jsonResp);
                break;

                case 'seleccionarRol':
                    $jsonResp = $this->mostrarRoles_controlador();
                    echo json_decode($jsonResp);
                break;

                case 'seleccionarProyecto':
                    $jsonResp = $this->mostrarProyecto_controlador();
                    echo json_decode($jsonResp);
                break;

                case 'insertar':
                    $nombre_user_Post = htmlspecialchars($_POST['nombre_user'], ENT_QUOTES, 'UTF-8' );
                    $email_user_Post = htmlspecialchars($_POST['email_user'], ENT_QUOTES, 'UTF-8' );
                    $pass_user_Post = htmlspecialchars($_POST['pass_user'], ENT_QUOTES, 'UTF-8' );
                    $rol_user_Post = htmlspecialchars($_POST['rol_user'], ENT_QUOTES, 'UTF-8' );
                    $proyecto_user_Post = htmlspecialchars($_POST['proyecto_user'], ENT_QUOTES, 'UTF-8' );
                    $sueldo_user_Post = htmlspecialchars($_POST['sueldo_user'], ENT_QUOTES, 'UTF-8' );

                    $jsonResp = $this->insertarUsuario_controlador($nombre_user_Post, $email_user_Post, $sueldo_user_Post, $pass_user_Post, $rol_user_Post, $proyecto_user_Post);
                    echo json_decode($jsonResp);
                break;

                case "eliminar":
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->eliminarUsuario_controlador($id_post);
                    echo json_decode($jsonResp);
                break;

                case 'getUpdate':
                    $id_post = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8' );
                    $jsonResp = $this->getUserForUpdate_controlador($id_post);
                    echo json_decode($jsonResp);
                break;

                case 'actualizar':
                    $id_Post = htmlspecialchars($_POST['id_u'], ENT_QUOTES, 'UTF-8' );
                    $nombre_user_Post = htmlspecialchars($_POST['nombre_user2'], ENT_QUOTES, 'UTF-8' );
                    $email_user_Post = htmlspecialchars($_POST['email_user2'], ENT_QUOTES, 'UTF-8' );
                    $rol_user_Post = htmlspecialchars($_POST['rol_user2'], ENT_QUOTES, 'UTF-8' );
                    $proyecto_user_Post = htmlspecialchars($_POST['proyecto_user2'], ENT_QUOTES, 'UTF-8' );
                    $sueldo_user_Post = htmlspecialchars($_POST['sueldo_user2'], ENT_QUOTES, 'UTF-8' );

                    $jsonResp = $this->actualizarUsuario_controlador($id_Post, $nombre_user_Post, $email_user_Post, $sueldo_user_Post, $rol_user_Post, $proyecto_user_Post);
                    echo json_decode($jsonResp);
                break;

                default:
                    $jsonResp = $this->mostrarVistaUsuarios_controlador();
                    echo json_decode($jsonResp);
                break;
            }
        }

    }
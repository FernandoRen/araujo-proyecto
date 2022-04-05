<?php

    if (!$_POST) {
        header('Location: http://localhost:8012/front%20end%20-%20araujo/index.php');
    }

    include_once "../model/login-model.php";
    
    $metodos_controlador = new Metodos_Sql();

    $user_post = "";
    $pass_post = "";

    if (isset($_POST)) {
        $user_post = htmlentities($_POST['usuario']);
        $pass_post = htmlentities($_POST['pass']);
    }

    $RESP = $metodos_controlador->seleccionar_usuarios_id_controlador($user_post, $pass_post);

    //$jsonResp = array("respuesta" => $RESP);
    echo json_decode($RESP);

    class Metodos_Sql{
        protected $modelo;
        
        public function __construct()
        {
            $this->modelo = new modelo_login();
        }

        public function seleccionar_usuarios_id_controlador($user, $pass){
            $seleccionar_usuarios_id = $this->modelo->selecionar_usuarios_id($user, $pass);
            return json_encode($seleccionar_usuarios_id);
        }
    }    
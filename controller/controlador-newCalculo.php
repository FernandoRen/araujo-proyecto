<?php

    include_once "../model/newCalculo-model.php";
    $metodos_controlador = new Metodos_Sql();

    $nombre_post = "";
    $sueldo_post = "";
    $horasT_post = "";
    $rfc_post = "";
    $No_Empleado = "";

    if (isset($_POST)) {
        $nombre_post = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8' );//htmlentities($_POST['nombre'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
        $sueldo_post = htmlentities($_POST['sueldo']);
        $horasT_post = htmlentities($_POST['horasT']);
        $rfc_post = htmlentities($_POST['RFC']);
        $No_Empleado_post= htmlentities($_POST['No-Empleado']);
    }

    $RESP = $metodos_controlador->insertar_registros_horas($nombre_post, $sueldo_post, $horasT_post, $rfc_post, $No_Empleado_post);

    $jsonResp = array("respuesta" => $RESP);
    echo json_encode($jsonResp);

    class Metodos_Sql{
        protected $modelo;
        
        public function __construct()
        {
            $this->modelo = new modelo_insert_horas();
        }

        public function insertar_registros_horas($nombre, $sueldo, $horasT, $rfc, $numEmpleado){
            $insertar_registro_hrs = $this->modelo->insertarRegistro($nombre, $sueldo, $horasT, $rfc, $numEmpleado);
            return json_encode($insertar_registro_hrs);
        }
    }
    
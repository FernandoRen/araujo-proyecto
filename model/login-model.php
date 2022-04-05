<?php

    include "../conexion/conexion.php";
    include "../cifrar.php";
    include "../logGenerator/Logger.php";

    class modelo_login{

        protected $conexion;
        protected $newConexion;
        protected $cifrar;

        public function __construct()
        {
            /** Manera uno de hacerlo **/
            $this->conexion = new Conexion();
            $this->newConexion = $this->conexion->conectarBD();
             
            $this->cifrar = new Cifrar(); 
             /** Manera dos de hacerlo 
             *  $this->conexion = (new Conexion())->conectarBD();
             * 
             * queda en una sola linea y requiere una variable menos
             **/
        }

        public function selecionar_usuarios_id($user, $pass){
            $password_encriptada = $this->cifrar->cifrarTexto($pass);

            try{
                $respuesta_consulta = $this->newConexion->prepare("SELECT idusuario, nombreUsuario, usuario, rol, idproyecto FROM usuarios WHERE usuario = ? AND pass = ? AND estatus = 1");
                //evitamos inyeccion sql

                //Ejecutamos la consulta
                $respuesta_consulta->execute([$user, $password_encriptada]);

                //esta es otra manera de ordenar los datos en formato json
                $usuarios_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                //se cuentan los registros obtenidos
                $sql_result = count($usuarios_consulta);
                if ($sql_result  > 0) {

                    //guardamos el id, email y el rol en una sesion
                    session_start();            
                    $_SESSION["session_usuarios_array"] =$usuarios_consulta[0];

                    Logger::info("El usuario con el email: " . $user . " inició sesión en la aplicación");

                    //retornamos que sí se encontraron registros
                    $jsonResp = array("respuesta" => $usuarios_consulta, "resultado" => true);

                    //Hacemos una impresion del array en formato JSON.
                    $consulta_usuarios = json_encode($jsonResp);
                } else {
                    //retornamos que no se encontraron registros
                    $jsonResp = array("respuesta" => $usuarios_consulta, "resultado" => false);

                    //Hacemos una impresion del array en formato JSON.
                    $consulta_usuarios = json_encode($jsonResp);

                }

                return $consulta_usuarios;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    }
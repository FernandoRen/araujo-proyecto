<?php

    include "../conexion/conexion.php";

    class modelo_insert_horas{

        protected $conexion;
        protected $newConexion;

        public function __construct()
        {
            /** Manera uno de hacerlo **/
            $this->conexion = new Conexion();
            $this->newConexion = $this->conexion->conectarBD();
           
        }

        public function insertarRegistro($nombre, $sueldo, $horas, $rfc, $matricula){

            try{
                $respuesta_insert = $this->newConexion->prepare("INSERT INTO registro_horas (nombre, sueldo, horasTrabajadas, rfc, matriculaTrabajador) VALUES (?, ?, ?, ?, ?)");
                //evitamos inyeccion sql

                //Ejecutamos la consulta
                $respuesta_insert->execute([$nombre, $sueldo, $horas, $rfc, $matricula]);

                //esta es otra manera de ordenar los datos en formato json
                //$insert_final = $respuesta_insert->fetchAll(PDO::FETCH_OBJ);

                if ($respuesta_insert == true) {
                    //Hacemos una impresion del array en formato JSON.
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    }
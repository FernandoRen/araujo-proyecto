<?php

    include "../conexion/conexion.php";

    class crud_proyectos_model{

        public function __construct()
        {
            /** Manera uno de hacerlo **/
            $this->conexion = new Conexion();
            $this->newConexion = $this->conexion->conectarBD();
             
        }


        public function mostrarProyectos_y_UsuariosModelo(){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT * FROM vista_consultaProyectos_Usuarios;");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute();
                
                 //esta es otra manera de ordenar los datos en formato json
                 $usuarios_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_usuarios = json_encode($usuarios_consulta);

                 return $consulta_usuarios;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function mostrarProyectosModelo(){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT * FROM proyecto WHERE estatus = 1;");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute();
                
                 //esta es otra manera de ordenar los datos en formato json
                 $usuarios_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_usuarios = json_encode($usuarios_consulta);

                 return $consulta_usuarios;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function finalizarProyectoModelo($id){
            try {
                $update_query = $this->newConexion->prepare("call sp_finalizarProyecto(?);");
                 //Ejecutamos la query
                 $update_query->execute([$id]);
                
                if ($update_query == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function agregarProyectoModelo($nombre_proyecto, $date_start, $date_end){
            try {
                $insert_query = $this->newConexion->prepare("INSERT INTO proyecto (nombre, dateStart, dateEnd, estatus) VALUES (?,?,?,?)");
                 if ($date_end == "") {
                     $date_end = null;
                 }
                 //Ejecutamos la inserción
                $insert_query->execute([$nombre_proyecto, $date_start, $date_end, "1"]);

                if ($insert_query == true) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function eliminarProyectoModelo($id){
            try {
                $query_eliminar = $this->newConexion->prepare("call sp_eliminarProyecto(?);");
                 //Ejecutamos la query
                 $query_eliminar->execute([$id]);
                
                if ($query_eliminar == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function mostrarProyectosIdModelo($id){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT * FROM proyecto where idproyecto = ?;");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute([$id]);
                
                 //esta es otra manera de ordenar los datos en formato json
                 $proyecto_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_final = json_encode($proyecto_consulta);

                 return $consulta_final;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function actualizarDatosProyectoModelo($id, $nombre_proyecto, $fechaInicio, $fechaFin){
            try {
                if ($fechaFin == "") {
                    $fechaFin = null;
                }
                //ejecutamos el query para actualizar los datos del proyecto
                $query_update = $this->newConexion->prepare("UPDATE proyecto SET nombre = ?, dateStart = ?, dateEnd = ? WHERE idproyecto  = ?");
                $query_update->execute([$nombre_proyecto, $fechaInicio, $fechaFin, $id]);

                if ($query_update == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    }
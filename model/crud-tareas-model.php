<?php

    include "../conexion/conexion.php";

    class crud_tareas_model{
    
        public function __construct()
        {
            /** Manera uno de hacerlo **/
            $this->conexion = new Conexion();
            $this->newConexion = $this->conexion->conectarBD();
             
        }

        public function cargarProyectosModel($id, $rol){
            try {
                
                $respuesta_consulta = $this->newConexion->prepare("call sp_mostrarProyectosPorUser(?, ?);");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute([$rol, $id]);
                
                 //esta es otra manera de ordenar los datos en formato json
                 $proyectos_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_proyectos = json_encode($proyectos_consulta);

                 return $consulta_proyectos;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function cargarUsuariosModel($rol, $idProyecto){
            try {
                
                $respuesta_consulta = $this->newConexion->prepare("call sp_mostrarUsuariosPorRol(?, ?);");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute([$rol, $idProyecto]);
                
                 //esta es otra manera de ordenar los datos en formato json
                 $usuarios_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_usuarios = json_encode($usuarios_consulta);

                 return $consulta_usuarios;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function insertarTareaModelo($nombreTarea, $descripcion, $dateStart, $dateEnd, $idproyecto, $idusuario){
            try {
                $insert_query = $this->newConexion->prepare("INSERT INTO tareas (nombreTarea, descripcion, dateStart,
                 dateEnd, estatus, idproyecto, idusuario) VALUES (?,?,?,?,?,?,?);");

                $insert_query->execute([$nombreTarea, $descripcion, $dateStart, $dateEnd, "1", $idproyecto, $idusuario]);

                if ($insert_query == true) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function consultarTareasModel($rol, $idproyecto){
            try {
                $tareas_consulta = $this->newConexion->prepare("call sp_mostrarProyectosPorRol(?, ?);");
                //Ejecutamos la consulta
                $tareas_consulta->execute([$rol, $idproyecto]);
                
                //esta es otra manera de ordenar los datos en formato json
                $consulta_tareas = $tareas_consulta->fetchAll(PDO::FETCH_OBJ);

                $consulta_final = json_encode($consulta_tareas);

                return $consulta_final;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function terminarTareaModel($id){
            try {
                $terminarTarea_query = $this->newConexion->prepare("UPDATE tareas SET estatus = 0 WHERE idtareas = ?");
                //Ejecutamos la query
                $terminarTarea_query->execute([$id]);
                
                if ($terminarTarea_query == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function seleccionarTareaIdModel($id){
            try {
                $respuesta_consulta = $this->newConexion->prepare("call sp_mostrarTareasPorId(?);");
                 //Ejecutamos la consulta
                $respuesta_consulta->execute([$id]);
                
                 //esta es otra manera de ordenar los datos en formato json
                $tareas_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                $consulta_final = json_encode($tareas_consulta);

                return $consulta_final;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function actualizarDatosTareaModel($id, $nombreTarea, $descripcion, $dateStart, $dateEnd, $idproyecto, $idusuario){
            try {
                //preparamos el query para hacer el update
                $query_updateTarea = $this->newConexion->prepare("UPDATE tareas SET nombreTarea = ?, descripcion = ?, dateStart = ?, dateEnd = ?, idproyecto = ?, idusuario = ?
                                                                            WHERE idtareas = ?");
                //ejecutamos el query
                $query_updateTarea->execute([$nombreTarea, $descripcion, $dateStart, $dateEnd, $idproyecto, $idusuario, $id]);

                if ($query_updateTarea == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }          
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
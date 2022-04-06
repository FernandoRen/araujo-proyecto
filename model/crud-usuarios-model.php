<?php

    include "../conexion/conexion.php";
    include "../cifrar.php";

    class crud_usuarios_model{
        protected $cifrar;

        public function __construct()
        {
            /** Manera uno de hacerlo **/
            $this->conexion = new Conexion();
            $this->newConexion = $this->conexion->conectarBD();

            /* se inicializa el método de cifrar*/
            $this->cifrar = new Cifrar(); 
             
        }


        public function mostrarUsuariosModelo(){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT * FROM vista_seleccionarUsuariosActivos;");
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

        public function mostrarRolesModelo(){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT * FROM roles;");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute();
                
                 //esta es otra manera de ordenar los datos en formato json
                 $roles_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_final = json_encode($roles_consulta);

                 return $consulta_final;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function mostrarProyectosModelo(){
            try {
                $respuesta_consulta = $this->newConexion->prepare("SELECT idproyecto, nombre FROM proyecto WHERE estatus = 1;");
                 //Ejecutamos la consulta
                 $respuesta_consulta->execute();
                
                 //esta es otra manera de ordenar los datos en formato json
                 $proyecto_consulta = $respuesta_consulta->fetchAll(PDO::FETCH_OBJ);

                 $consulta_final = json_encode($proyecto_consulta);

                 return $consulta_final;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function agregarUsuarioModelo($nombre_user, $email_user, $sueldo, $pass_user, $rol_user, $proyecto_user){
            try {
                $password_encriptada = $this->cifrar->cifrarTexto($pass_user);
                $insert_query = $this->newConexion->prepare("INSERT INTO usuarios (nombreUsuario, usuario, sueldo, pass, rol, idproyecto, estatus) VALUES (?,?,?,?,?,?,?)");
                 //Ejecutamos la inserción
                 $insert_query->execute([$nombre_user, $email_user, $sueldo, $password_encriptada, $rol_user, $proyecto_user, "1"]);
                
                 //esta es otra manera de ordenar los datos en formato json
                 //$resultado_insert = $insert_query->fetchAll(PDO::FETCH_OBJ);

                 //$consulta_final = json_encode($resultado_insert);

                if ($insert_query == true) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function eliminarUsuario_modelo($id){
            try {
                //preparamos la instrucion
                $delete_query = $this->newConexion->prepare("UPDATE usuarios SET estatus = 0 WHERE idusuario = ?");
                //Ejecutamos la inserción
                $delete_query->execute([$id]);

                if ($delete_query == true) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function getUpdate_modelo($id){
            try {
                //preparamos la instruccion
                $select_query = $this->newConexion->prepare("call ObetenerDatosUpdate(?);");
                //Ejecutamos la inserción
                $select_query->execute([$id]);

                $consulta = $select_query->fetchAll(PDO::FETCH_OBJ);

                $consulta_final = json_encode($consulta);

                return $consulta_final;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function actualizarUsuario_modelo($id, $nombre_user, $email_user, $sueldo_user, $rol_user, $proyecto_user){
            try {
                //preparamos la instruccion
                $update_query = $this->newConexion->prepare("call actualizarDatos_procedure(?, ?, ?, ?, ?, ?);");
                //Ejecutamos la inserción
                $update_query->execute([$id, $nombre_user, $email_user, $sueldo_user, $rol_user, $proyecto_user]);

                if ($update_query == true ) {
                    return true;
                } else {
                    return json_encode("error, algo salio mal");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
            

        }

    }
<?php 

    class Conexion{

        private $host = "localhost:3308";
        private $userBD = "root";
        private $passwordBD = "";
        private $database = "seeda";
        
        public function __construct()
        {
            
        }

        public function conectarBD(){
            try {
                # Conexión a MySQL
                $cn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->userBD, $this->passwordBD);
                return $cn;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
    
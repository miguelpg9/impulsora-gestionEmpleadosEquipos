<?php
    class Conexion {
        private $server = "DESKTOP-FP0S9OA";
        private $database = "GestionEquipos";

        public function conectar() {
            $dsn = "odbc:Driver={ODBC Driver 17 for SQL Server};Server={$this->server};Database={$this->database};Trusted_Connection=yes;";
            
            try {
                $conexion = new PDO($dsn);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    }
?>
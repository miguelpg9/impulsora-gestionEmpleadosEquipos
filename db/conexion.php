<?php
    class Conexion {
        private $server = "DESKTOP-FP0S9OA"; // Nombre del servidor SQL Server
        private $database = "GestionEquipos"; // Nombre de tu base de datos

        public function conectar() {
            $dsn = "odbc:Driver={ODBC Driver 17 for SQL Server};Server={$this->server};Database={$this->database};Trusted_Connection=yes;";
            
            try {
                $conexion = new PDO($dsn);
                // Opcional: Establecer el modo de error
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    }
?>
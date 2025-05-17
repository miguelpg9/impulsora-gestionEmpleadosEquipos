<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $stmt = $conexion->query("SELECT idDepartamento, nombreDepartamento FROM departamentos");
    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($departamentos as &$departamento) {
        $departamento['nombreDepartamento'] = mb_convert_encoding($departamento['nombreDepartamento'], 'UTF-8', 'ISO-8859-1');
    }
    echo json_encode($departamentos);
?>

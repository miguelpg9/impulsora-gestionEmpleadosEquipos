<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $stmt = $conexion->query("SELECT idTipo, nombreTipo FROM tipoEquipo");
    $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tipos as &$tipo) {
        $tipo['nombreTipo'] = mb_convert_encoding($tipo['nombreTipo'], 'UTF-8', 'ISO-8859-1');
    }
    echo json_encode($tipos);
?>

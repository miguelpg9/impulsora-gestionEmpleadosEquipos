<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $nombre = $_POST['nombreEquipo'] ?? '';
    $serie = $_POST['serie'] ?? '';
    $idTipo = $_POST['idTipo'] ?? '';
    $responsableId = $_POST['responsableId'] ?? '';

    $sql = "INSERT INTO equipos (nombreEquipo, serie, idTipo, responsableId) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $exito = $stmt->execute([$nombre, $serie, $idTipo, $responsableId]);

    echo json_encode(['exito' => $exito, 'mensaje' => $exito ? 'Equipo creado correctamente' : 'Error al guardar']);
?>
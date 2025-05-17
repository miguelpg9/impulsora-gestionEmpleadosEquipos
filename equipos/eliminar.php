<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $idEquipo = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($idEquipo <= 0) {
        echo json_encode(['success' => false, 'mensaje' => 'ID inválido']);
        exit;
    }

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM equipos WHERE idEquipo = ?");
    $stmt->execute([$idEquipo]);
    if ($stmt->fetchColumn() == 0) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'El equipo no existe.'
        ]);
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM equipos WHERE idEquipo = ?");
    if ($stmt->execute([$idEquipo])) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Equipo eliminado correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'mensaje' => 'Error al eliminar el equipo.'
        ]);
    }
?>
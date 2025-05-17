<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $nombre = trim($_POST['nombreEquipo'] ?? '');
    $serie = trim($_POST['serie'] ?? '');
    $idTipo = $_POST['idTipo'] ?? '';
    $responsableId = $_POST['responsableId'] ?? '';

    if (empty($nombre) || empty($serie) || empty($idTipo) || empty($responsableId)) {
        echo json_encode(['success' => false, 'mensaje' => 'Todos los campos son obligatorios']);
        exit;
    }

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM tipoEquipo WHERE idTipo = ?");
    $stmt->execute([$idTipo]);
    if ($stmt->fetchColumn() == 0) {
        echo json_encode(['success' => false, 'mensaje' => 'El tipo de equipo no existe']);
        exit;
    }

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM empleados WHERE idEmpleado = ?");
    $stmt->execute([$responsableId]);
    if ($stmt->fetchColumn() == 0) {
        echo json_encode(['success' => false, 'mensaje' => 'El responsable no existe']);
        exit;
    }

    $sql = "INSERT INTO equipos (nombreEquipo, serie, idTipo, responsableId) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $exito = $stmt->execute([$nombre, $serie, $idTipo, $responsableId]);

    echo json_encode([
        'success' => $exito,
        'mensaje' => $exito ? 'Equipo creado correctamente' : 'Error al guardar'
    ]);

?>
<?php
    require_once '../db/conexion.php';
    header('Content-Type: application/json');

    $conexion = (new Conexion())->conectar();


    if (!isset($_POST['idEquipo'], $_POST['nombreEquipo'], $_POST['serie'], $_POST['idTipo'], $_POST['responsableId'] )) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Faltan datos requeridos.'
        ]);
        exit;
    }

    $idEquipo = $_POST['idEquipo'];
    $nombreEquipo = $_POST['nombreEquipo'];
    $serie = $_POST['serie'];
    $idTipo = $_POST['idTipo'];
    $responsableId = $_POST['responsableId'];

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM empleados WHERE idEmpleado = ?");
    $stmt->execute([$responsableId]);
    if ($stmt->fetchColumn() == 0) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'El empleado no existe.'
        ]);
        exit;
    }

    $stmt = $conexion->prepare("UPDATE equipos SET nombreEquipo=?, serie=?, idTipo=?, responsableId=? WHERE idEquipo=?");
    if ($stmt->execute([$nombreEquipo, $serie, $idTipo, $responsableId, $idEquipo])) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Equipo editado correctamente.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Error al actualizar el equipo.'
        ]);
    }
?>
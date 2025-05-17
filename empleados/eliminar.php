<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $idEmpleado = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($idEmpleado <= 0) {
        echo json_encode(['success' => false, 'mensaje' => 'ID inválido.']);
        exit;
    }

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM empleados WHERE idEmpleado = ?");
    $stmt->execute([$idEmpleado]);
    if ($stmt->fetchColumn() == 0) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'El empleado no existe.'
        ]);
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM empleados WHERE idEmpleado = ?");
    if ($stmt->execute([$idEmpleado])) {
        echo json_encode(['success' => true, 'mensaje' => 'Empleado eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar el empleado.']);
    }
   
?>
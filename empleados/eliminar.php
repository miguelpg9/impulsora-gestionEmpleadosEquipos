<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        echo json_encode(['success' => false, 'mensaje' => 'ID inválido']);
        exit;
    }

    try {
        $stmt = $conexion->prepare("DELETE FROM empleados WHERE idEmpleado = ?");
        $stmt->execute([$id]);

        echo json_encode([
            'success' => true,
            'mensaje' => 'Empleado eliminado correctamente'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Error al eliminar: ' . $e->getMessage()
        ]);
    }
?>
<?php
    require_once '../db/conexion.php';
    header('Content-Type: application/json');

    $conexion = (new Conexion())->conectar();

    if (!isset($_POST['idEmpleado'], $_POST['idDepartamento'], $_POST['correo'])) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Faltan datos requeridos.'
        ]);
        exit;
    }

    $idEmpleado = $_POST['idEmpleado'];
    $idDepartamento = $_POST['idDepartamento'];
    $correo = $_POST['correo'];

    if (!is_numeric($idEmpleado) || !is_numeric($idDepartamento)) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'ID de empleado o departamento inválido.'
        ]);
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

    $stmt = $conexion->prepare("UPDATE empleados SET idDepartamento = ?, correo = ? WHERE idEmpleado = ?");
    if ($stmt->execute([$idDepartamento, $correo, $idEmpleado])) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Empleado editado correctamente.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Error al actualizar el empleado.'
        ]);
    }
?>
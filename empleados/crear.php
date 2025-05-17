<?php
        header('Content-Type: application/json');
        require_once '../db/conexion.php';

        $conexion = (new Conexion())->conectar();

        $nombre = trim($_POST['nombreEmpleado'] ?? '');
        $apellidoP = trim($_POST['apellidoPaterno'] ?? '');
        $apellidoM = trim($_POST['apellidoMaterno'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $idDepartamento = $_POST['idDepartamento'] ?? '';

        if (empty($nombre) || empty($apellidoP) || empty($correo) || empty($idDepartamento)) {
        echo json_encode(['success' => false, 'mensaje' => 'Faltan campos obligatorios']);
        exit;
        }

        $sql = "INSERT INTO empleados (nombreEmpleado, apellidoPaterno, apellidoMaterno, correo, idDepartamento)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $exito = $stmt->execute([$nombre, $apellidoP, $apellidoM, $correo, $idDepartamento]);

        echo json_encode([
                'success' => $exito,
                'mensaje' => $exito ? 'Empleado creado correctamente' : 'Error al guardar'
        ]);
?>
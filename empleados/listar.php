<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $sql = "SELECT 
                e.idEmpleado,
                (ISNULL(e.nombreEmpleado, '') + ' ' + ISNULL(e.apellidoPaterno, '') + ' ' + ISNULL(e.apellidoMaterno, '')) AS nombreEmpleado,
                e.correo,
                d.nombreDepartamento
            FROM empleados e
            INNER JOIN departamentos d ON e.idDepartamento = d.idDepartamento;";

    $stmt = $conexion->query($sql);

    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($empleados as &$empleado) {
        $empleado['nombreEmpleado'] = mb_convert_encoding($empleado['nombreEmpleado'], 'UTF-8', 'ISO-8859-1');
        $empleado['nombreDepartamento'] = mb_convert_encoding($empleado['nombreDepartamento'], 'UTF-8', 'ISO-8859-1');
    }
    echo json_encode($empleados);
?>
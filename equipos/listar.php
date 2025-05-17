<?php
    header('Content-Type: application/json');
    require_once '../db/conexion.php';

    $conexion = (new Conexion())->conectar();

    $sql = "SELECT 
                e.idEquipo,
                e.nombreEquipo,
                t.nombreTipo,
                e.serie,
                (ISNULL(emp.nombreEmpleado, '') + ' ' + ISNULL(emp.apellidoPaterno, '') + ' ' + ISNULL(emp.apellidoMaterno, '')) AS responsable
            FROM equipos e
            INNER JOIN tipoEquipo t ON e.idTipo = t.idTipo
            INNER JOIN empleados emp ON e.responsableId = emp.idEmpleado;";

    $stmt = $conexion->query($sql);

    $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($equipos as &$equipo) {
        $equipo['nombreEquipo'] = mb_convert_encoding($equipo['nombreEquipo'], 'UTF-8', 'ISO-8859-1');
        $equipo['serie'] = mb_convert_encoding($equipo['serie'], 'UTF-8', 'ISO-8859-1');
        $equipo['responsable'] = mb_convert_encoding($equipo['responsable'], 'UTF-8', 'ISO-8859-1');
        $equipo['nombreTipo'] = mb_convert_encoding($equipo['nombreTipo'], 'UTF-8', 'ISO-8859-1');
    }   
    echo json_encode($equipos);
?>
<?php
    require 'conexion.php';

    $idEquipo = $_POST['idEquipo'];
    $nombreEquipo = $_POST['nombreEquipo'];
    $serie = $_POST['serie'];
    $idTipo = $_POST['idTipo'];
    $responsableId = $_POST['responsableId'];

    $stmt = $pdo->prepare("UPDATE equipos SET nombreEquipo=?, serie=?, idTipo=?, responsableId=? WHERE idEquipo=?");
    $success = $stmt->execute([$nombreEquipo, $serie, $idTipo, $responsableId, $idEquipo]);

    echo json_encode([
    "success" => $success,
    "message" => $success ? "Equipo actualizado correctamente" : "Error al actualizar"
    ]);
?>
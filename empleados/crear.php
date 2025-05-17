<?php
header('Content-Type: application/json');
require_once '../db/conexion.php';

$conexion = (new Conexion())->conectar();

$nombre = $_POST['nombreEmpleado'] ?? '';
$apellidoP = $_POST['apellidoPaterno'] ?? '';
$apellidoM = $_POST['apellidoMaterno'] ?? '';
$correo = $_POST['correo'] ?? '';
$idDepartamento = $_POST['idDepartamento'] ?? '';

$sql = "INSERT INTO empleados (nombreEmpleado, apellidoPaterno, apellidoMaterno, correo, idDepartamento)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$exito = $stmt->execute([$nombre, $apellidoP, $apellidoM, $correo, $idDepartamento]);

echo json_encode(['exito' => $exito, 'mensaje' => $exito ? 'Empleado creado correctamente' : 'Error al guardar']);
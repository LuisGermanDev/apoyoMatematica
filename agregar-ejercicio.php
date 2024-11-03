<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ejercicio = $_POST['ejercicio'];
    $respuesta = $_POST['respuesta'];
    $materia_id = $_POST['materia_id'];

    $sql = "INSERT INTO ejercicios (ejercicio, respuesta, materia_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $ejercicio, $respuesta, $materia_id);

    if ($stmt->execute()) {
        header("Location: gestionar_ejercicios.php?mensaje=ejercicio_agregado");
    } else {
        echo "Error al agregar el ejercicio: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
    $materia_id = $_POST['materia_id'];

    $sql = "INSERT INTO material_apoyo (titulo, enlace, materia_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $enlace, $materia_id);

    if ($stmt->execute()) {
        header("Location: gestionar_material.php?mensaje=material_agregado");
    } else {
        echo "Error al agregar el material: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

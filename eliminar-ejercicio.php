<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM ejercicios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: gestionar_ejercicios.php?mensaje=ejercicio_eliminado");
    } else {
        echo "Error al eliminar el ejercicio: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

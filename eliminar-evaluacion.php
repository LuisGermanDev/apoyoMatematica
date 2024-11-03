<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM evaluaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: evaluaciones.php?mensaje=Evaluación eliminada correctamente");
    } else {
        header("Location: evaluaciones.php?error=Error al eliminar la evaluación");
    }
    $stmt->close();
} else {
    header("Location: evaluaciones.php?error=Evaluación no encontrada");
}

$conn->close();
exit;
?>

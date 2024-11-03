<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM temas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: gestionar_temas.php?mensaje=tema_eliminado");
    } else {
        echo "Error al eliminar el tema: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

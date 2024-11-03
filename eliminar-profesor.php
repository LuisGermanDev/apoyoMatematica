<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

// Verificar que el id esté presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // SQL para eliminar el profesor
    $sql = "DELETE FROM profesores WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Profesor eliminado correctamente";
    } else {
        echo "Error al eliminar el profesor: " . $conn->error;
    }
} else {
    echo "ID no especificado";
}

$conn->close();

// Redirigir de nuevo a la lista de profesores
header("Location: profesores.php");
exit;
?>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM materias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    try {
        $stmt->execute();
        // Redirigir con un mensaje de éxito
        header("Location: materias.php?mensaje=Materia eliminada correctamente");
    } catch (mysqli_sql_exception $e) {
        // Si ocurre un error (por ejemplo, restricción de clave foránea)
        header("Location: materias.php?error=No se puede eliminar esta materia porque tiene registros asociados.");
    }
}

$stmt->close();
$conn->close();
exit;
?>

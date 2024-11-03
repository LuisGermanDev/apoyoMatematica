<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el alumno tiene evaluaciones asociadas
    $sql_check = "SELECT * FROM evaluaciones WHERE id_alumno = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Si hay evaluaciones asociadas, mostrar un mensaje y no eliminar el alumno
        header("Location: alumno.php?error=No se puede eliminar. El alumno tiene evaluaciones registradas.");
    } else {
        // Si no hay evaluaciones, proceder con la eliminación
        $sql_delete = "DELETE FROM alumnos WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            header("Location: alumno.php?mensaje=Alumno eliminado correctamente");
        } else {
            echo "Error al eliminar el alumno.";
        }
        $stmt_delete->close();
    }
    $stmt_check->close();
} else {
    header("Location: alumno.php?error=Alumno no encontrado");
}

$conn->close();
exit;
?>

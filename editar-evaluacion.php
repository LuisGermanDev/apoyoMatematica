<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM evaluaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $evaluacion = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_alumno = $_POST['id_alumno'];
    $id_materia = $_POST['id_materia'];
    $nota = $_POST['nota'];
    $fecha = $_POST['fecha'];

    $sql = "UPDATE evaluaciones SET id_alumno = ?, id_materia = ?, nota = ?, fecha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisdi", $id_alumno, $id_materia, $nota, $fecha, $id);

    if ($stmt->execute()) {
        header("Location: evaluaciones.php?mensaje=Evaluación actualizada correctamente");
    } else {
        header("Location: evaluaciones.php?error=Error al actualizar la evaluación");
    }
    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: evaluaciones.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evaluación</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Evaluación</h2>
        <form action="editar-evaluacion.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $evaluacion['id']; ?>">
            
            <label for="id_alumno">ID del Alumno:</label>
            <input type="number" id="id_alumno" name="id_alumno" value="<?php echo $evaluacion['id_alumno']; ?>" required>

            <label for="id_materia">ID de la Materia:</label>
            <input type="number" id="id_materia" name="id_materia" value="<?php echo $evaluacion['id_materia']; ?>" required>

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" id="nota" name="nota" value="<?php echo $evaluacion['nota']; ?>" required>

            <label for="fecha">Fecha de la Evaluación:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $evaluacion['fecha']; ?>" required>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

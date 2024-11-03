<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos actuales del ejercicio
    $sql = "SELECT * FROM ejercicios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ejercicio = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar los cambios en la base de datos
    $id = $_POST['id'];
    $ejercicio_text = $_POST['ejercicio'];
    $respuesta = $_POST['respuesta'];
    $materia_id = $_POST['materia_id'];

    $sql = "UPDATE ejercicios SET ejercicio = ?, respuesta = ?, materia_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $ejercicio_text, $respuesta, $materia_id, $id);

    if ($stmt->execute()) {
        header("Location: gestionar_ejercicios.php?mensaje=ejercicio_editado");
    } else {
        echo "Error al actualizar el ejercicio: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: gestionar_ejercicios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ejercicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Ejercicio</h2>
        <form action="editar-ejercicio.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $ejercicio['id']; ?>">

            <label for="ejercicio">Ejercicio:</label>
            <textarea id="ejercicio" name="ejercicio" required><?php echo $ejercicio['ejercicio']; ?></textarea>

            <label for="respuesta">Respuesta:</label>
            <textarea id="respuesta" name="respuesta" required><?php echo $ejercicio['respuesta']; ?></textarea>

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $ejercicio['materia_id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

// Obtener los datos del material cuando se accede con el método GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM material_apoyo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $material = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar los datos del material cuando se envía el formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
    $materia_id = $_POST['materia_id'];

    $sql = "UPDATE material_apoyo SET titulo = ?, enlace = ?, materia_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $titulo, $enlace, $materia_id, $id);

    if ($stmt->execute()) {
        header("Location: gestionar_material.php?mensaje=material_editado");
    } else {
        echo "Error al actualizar el material: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: gestionar_material.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Material de Apoyo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Material de Apoyo</h2>
        <form action="editar-material.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $material['id']; ?>">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $material['titulo']; ?>" required>

            <label for="enlace">Enlace:</label>
            <input type="url" id="enlace" name="enlace" value="<?php echo $material['enlace']; ?>" required>

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $material['materia_id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

<?php
$conn->close();
?>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos actuales del tema
    $sql = "SELECT * FROM temas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tema = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar los cambios en la base de datos
    $id = $_POST['id'];
    $titulo_tema = $_POST['titulo_tema'];
    $contenido = $_POST['contenido'];
    $imagen_url = $_POST['imagen_url'];
    $materia_id = $_POST['materia_id'];

    $sql = "UPDATE temas SET titulo_tema = ?, contenido = ?, imagen_url = ?, materia_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $titulo_tema, $contenido, $imagen_url, $materia_id, $id);

    if ($stmt->execute()) {
        header("Location: gestionar_temas.php?mensaje=tema_editado");
    } else {
        echo "Error al actualizar el tema: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: gestionar_temas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tema</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Tema</h2>
        <form action="editar-tema.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $tema['id']; ?>">

            <label for="titulo_tema">Título del Tema:</label>
            <input type="text" id="titulo_tema" name="titulo_tema" value="<?php echo $tema['titulo_tema']; ?>" required>

            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" required><?php echo $tema['contenido']; ?></textarea>

            <label for="imagen_url">URL de la Imagen:</label>
            <input type="text" id="imagen_url" name="imagen_url" value="<?php echo $tema['imagen_url']; ?>">

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $tema['materia_id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

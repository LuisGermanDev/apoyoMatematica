<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM materias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $materia = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre_materia = $_POST['nombre_materia'];
    $descripcion = $_POST['descripcion'];
    
    $sql = "UPDATE materias SET nombre_materia = ?, descripcion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre_materia, $descripcion, $id);
    $stmt->execute();

    header("Location: gestionar-materias.php");
    exit;
} else {
    header("Location: gestionar-materias.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Materia</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Materia</h2>
        <form action="editar-materia.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">
            <label for="nombre_materia">Nombre de la Materia:</label>
            <input type="text" id="nombre_materia" name="nombre_materia" value="<?php echo $materia['nombre_materia']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $materia['descripcion']; ?></textarea>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

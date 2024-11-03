<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

// Verificar si se recibe el parámetro 'id' para cargar los datos de la materia
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM materias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $materia = $result->fetch_assoc();

    // Si no se encuentra la materia, redirige a la lista de materias con un mensaje de error
    if (!$materia) {
        header("Location: materias.php?error=Materia no encontrada");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar la materia si se recibe una solicitud POST
    $id = $_POST['id'];
    $nombre_materia = $_POST['nombre_materia'];
    $descripcion = $_POST['descripcion'];
    
    $sql = "UPDATE materias SET nombre_materia = ?, descripcion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre_materia, $descripcion, $id);

    if ($stmt->execute()) {
        header("Location: materias.php?mensaje=Materia actualizada correctamente");
    } else {
        header("Location: materias.php?error=Error al actualizar la materia");
    }
    exit;
} else {
    // Si no se cumplen las condiciones, redirigir a la lista de materias
    header("Location: materias.php");
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
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="ejercicios.php">Ejercicios</a></li>
                <li><a href="notas.php">Notas</a></li>
                <li><a href="materialDeApoyo.php">Material de apoyo</a></li>
                <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Editar Materia</h2>
        <form action="editar-materia.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($materia['id']); ?>">
            <label for="nombre_materia">Nombre de la Materia:</label>
            <input type="text" id="nombre_materia" name="nombre_materia" value="<?php echo htmlspecialchars($materia['nombre_materia']); ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($materia['descripcion']); ?></textarea>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>

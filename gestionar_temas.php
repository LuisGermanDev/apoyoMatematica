<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Temas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="contact.php">Contacto</a></li>
                <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Gestionar Temas</h1>
        <h2>Agregar Nuevo Tema</h2>
        <form action="agregar-tema.php" method="POST">
            <label for="titulo_tema">Título del Tema:</label>
            <input type="text" id="titulo_tema" name="titulo_tema" required>

            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" required></textarea>

            <label for="imagen_url">URL de la Imagen:</label>
            <input type="text" id="imagen_url" name="imagen_url">

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                // Obtener todas las materias para el select
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Agregar Tema">
        </form>
    </main>

    <?php $conn->close(); ?>
</body>
</html>

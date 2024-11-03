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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Materias</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="about.php">Acerca de</a></li>
            <li><a href="contact.php">Contacto</a></li>
            <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
        </ul>
    </nav>
</header>
<main>
        <h1>Gestionar Materias</h1>
        <h2>Agregar Nueva Materia</h2>
        <form action="agregar-materia.php" method="POST">
            <label for="nombre_materia">Nombre de la Materia:</label>
            <input type="text" id="nombre_materia" name="nombre_materia" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <input type="submit" value="Agregar Materia">
        </form>

        <h2>Lista de Materias</h2>
        <?php
        $sql = "SELECT * FROM materias";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre_materia"] . "</td><td>" . $row["descripcion"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No hay materias registradas.";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>

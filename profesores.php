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
    <title>Gestionar Profesores</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="clases.php">Clases</a></li>
            <li><a href="ejercicios.php">Ejecicios</a></li>
            <li><a href="notas.php">Notas</a></li>
            <li><a href="contact.php">Material de apoyo</a></li>


            <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
        </ul>
    </nav>
        </header>
        <main>
        <h1>Gestionar Profesores</h1>
        <h2>Agregar Nuevo Profesor</h2>
        <form action="agregar-profesor.php" method="POST">
            <label for="nombre">Nombre del Profesor:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido del Profesor:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" required>

            <input type="submit" value="Agregar Profesor">
        </form>

        <h2>Lista de Profesores</h2>
        <?php
        $sql = "SELECT * FROM profesores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Especialidad</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["apellido"] . "</td><td>" . $row["especialidad"] . "</td>";
                echo "<td><a href='editar-profesor.php?id=" . $row["id"] . "'>Editar</a> | <a href='eliminar-profesor.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este profesor?\");'>Eliminar</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No hay profesores registrados.";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>

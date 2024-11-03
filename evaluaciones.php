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
    <title>Gestionar Evaluaciones</title>
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
        <h1>Gestionar Evaluaciones</h1>
        <h2>Registrar Nueva Evaluación</h2>
        <form action="agregar-evaluacion.php" method="POST">
            <label for="id_alumno">ID del Alumno:</label>
            <input type="number" id="id_alumno" name="id_alumno" required>

            <label for="id_materia">ID de la Materia:</label>
            <input type="number" id="id_materia" name="id_materia" required>

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" id="nota" name="nota" required>

            <label for="fecha">Fecha de la Evaluación:</label>
            <input type="date" id="fecha" name="fecha" required>

            <input type="submit" value="Registrar Evaluación">
        </form>

        <h2>Lista de Evaluaciones</h2>
        <?php
        $sql = "SELECT e.id, a.nombre, a.apellido, m.nombre_materia, e.nota, e.fecha
                FROM evaluaciones e
                JOIN alumnos a ON e.id_alumno = a.id
                JOIN materias m ON e.id_materia = m.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Alumno</th><th>Materia</th><th>Nota</th><th>Fecha</th><th>Opciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre"] . " " . $row["apellido"] . "</td>
                        <td>" . $row["nombre_materia"] . "</td>
                        <td>" . $row["nota"] . "</td>
                        <td>" . $row["fecha"] . "</td>
                        <td>
                            <a href='editar-evaluacion.php?id=" . $row["id"] . "'>Editar</a> | 
                            <a href='eliminar-evaluacion.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta evaluación?\");'>Eliminar</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay evaluaciones registradas.";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>

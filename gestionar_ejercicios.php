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
    <title>Gestionar Ejercicios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h1>Gestionar Ejercicios</h1>
        <h2>Agregar Nuevo Ejercicio</h2>
        <form action="agregar-ejercicio.php" method="POST">
            <label for="ejercicio">Ejercicio:</label>
            <textarea id="ejercicio" name="ejercicio" required></textarea>

            <label for="respuesta">Respuesta:</label>
            <textarea id="respuesta" name="respuesta" required></textarea>

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Agregar Ejercicio">
        </form>

        <h2>Lista de Ejercicios</h2>
        <?php
        $sql = "SELECT ejercicios.id, ejercicios.ejercicio, materias.nombre_materia FROM ejercicios 
                JOIN materias ON ejercicios.materia_id = materias.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Ejercicio</th><th>Materia</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . substr($row['ejercicio'], 0, 50) . "...</td>";
                echo "<td>" . $row['nombre_materia'] . "</td>";
                echo "<td>
                        <a href='editar-ejercicio.php?id=" . $row['id'] . "'>Editar</a> | 
                        <a href='eliminar-ejercicio.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este ejercicio?\");'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay ejercicios registrados.</p>";
        }

        $conn->close();
        ?>
    </main>
</body>
</html>
